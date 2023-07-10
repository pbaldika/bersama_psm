<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Project;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create(Request $input)
    {
        $validator = Validator::make($input->all(), [
            'total' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($input) {
                    $project = Project::findOrFail($input['project_id']);
                    $availableAmount = $project->required_capital - $project->current_capital;

                    if ($value > $availableAmount) {
                        $fail('Jumlah investasi melebihi maksimum ajuan!');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $investment = Investment::create([
            'total' => $input['total'],
            'profit' => $input['profit'],
            'status' => $input['status'],
            'payment_proof' => $input['payment_proof'],
            'user_id' => $input['user_id'],
            'project_id' => $input['project_id'],
        ]);

        Invoice::create([
            'investment_id' => $investment->id,
        ]);

        return back()->with('message', 'Permintaan Investasi Kalian Berhasil Terbuat, Mohon Buat Pembayaran Agar Investasi Disetujui!');
    }

    public function addPhoto(Investment $investment)
    {
        try {
            // Retrieve the investment by ID and ensure the authenticated user is the owner
            $investment = Investment::where('id', $investment->id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            return view('frontend.user.upload-image', ['investment' => $investment]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Investment not found or user is not the owner
            return redirect()->route('landing')->with('error', 'Kamu tidak bisa mengakses Investasi .');
        }
    }

    public function uploadPhoto(Investment $investment, Request $request)
    {
        // $request->validate([
        //     'identity_photo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        //     'identity_selfie' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        //     'identity_number' => 'required',
        //     'identity_type' => 'required',
        // ]);

        if ($request->hasFile('image')) {
            $IDPhoto = $request->file('image');

            $filename = date('YmdHi') . '_' . $IDPhoto->getClientOriginalName();

            // Store the new images
            $IDPhoto->storeAs('private/payment/', $filename);

            $data = [
                'payment_proof' => $filename,
            ];

            $investment = Investment::where('id', $investment->id)->first();

            if ($investment) {
                // Delete old images
                $oldImage = $investment->image;

                if ($oldImage && Storage::exists('private/payment/' . $oldImage)) {
                    Storage::delete('private/payment/' . $oldImage);
                }

                $investment->update($data);
            } else {
                $investment->update($data);
            }
        }

        return back()->with('message', "Verifikasi Sedang Dalam Proses!");
    }

    public function investmentList()
    {
        $user = Auth::user(); // Get the currently authenticated user
        $userId = $user->id; // Get the user's ID

        // Retrieve investments made by the user
        $investments = Investment::where('user_id', $userId)->get();

        // Retrieve project IDs associated with the investments
        $projectIds = $investments->pluck('project_id');

        // Retrieve projects associated with the investments
        $projects = Project::whereIn('id', $projectIds)->get()->keyBy('id');

        $investmentCount = Investment::count();
        $totalInvestment = Investment::sum('total');
        $activeInvestmentCount = Investment::where('status', 'active')->count();
        $totalProfit = Investment::sum('profit');

        return view('frontend.user.investment-made', ['investments' => $investments, 'projects' => $projects], compact('investmentCount', 'totalInvestment', 'activeInvestmentCount', 'totalProfit'));
    }

    public function invoice(Investment $investment)
    {
        // Check if the authenticated user has the matching user_id
        if (Auth::id() !== $investment->user_id) {
            abort(403, 'Unauthorized');
        }

        try {
            $investment = Investment::findOrFail($investment->id);
            $project = Project::findOrFail($investment->project_id);
            $invoice = Invoice::where('investment_id', $investment->id)->firstOrFail();
            $filePath = storage_path('app/private/payment/' . $investment->payment_proof);

            // Check if the file exists
            if (file_exists($filePath)) {
                // Get the file contents
                $fileContents = file_get_contents($filePath);

                // Return the view with the necessary data
                return view('frontend.user.investment-invoice', compact('investment', 'invoice', 'project'))->with('imageData', base64_encode($fileContents));
            } elseif ($investment->payment_proof == null) {
                // File not found
                $errorMessage = 'User Belum Mengupload Bukti Gambar';
                return view('frontend.user.investment-invoice', compact('investment', 'project'))->with('errorMessage', $errorMessage);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            $errorMessage = 'Bukti Pembayaran Belum Ada';
            return view('frontend.user.investment-invoice', compact('investment', 'project', 'invoice'))->with('errorMessage', $errorMessage);
        }
    }

    public function generate(Investment $investment)
    {
        $investment = Investment::findOrFail($investment->id);
        $project = Project::findOrFail($investment->project_id);
        $invoice = Invoice::where('investment_id', $investment->id)->firstOrFail();
        $filePath = storage_path('app/private/payment/' . $investment->payment_proof);
        $fileContents = file_get_contents($filePath);
        $imageData = base64_encode($fileContents);

        $pdf = PDF::loadView('frontend.user.invoice-generate', compact('investment', 'invoice', 'project', 'imageData'))->setPaper('A3', 'landscape');
        $fileName = 'Invoice_' . $investment->id . '_nomor:' . $invoice->id . '_' . now()->format('Ymd') . '.pdf';
        return $pdf->download($fileName);
    }

    public function print(Investment $investment)
    {
        $investment = Investment::findOrFail($investment->id);
        $project = Project::findOrFail($investment->project_id);
        $invoice = Invoice::where('investment_id', $investment->id)->firstOrFail();
        $filePath = storage_path('app/private/payment/' . $investment->payment_proof);
        $fileContents = file_get_contents($filePath);
        $imageData = base64_encode($fileContents);

        $pdf = PDF::loadView('frontend.user.invoice-generate', compact('investment', 'invoice', 'project', 'imageData'))->setPaper('A3', 'landscape');
        $fileName = 'Invoice_' . $investment->id . '_nomor:' . $invoice->id . '_' . now()->format('Ymd') . '.pdf';
        return $pdf->stream($fileName);
    }
}