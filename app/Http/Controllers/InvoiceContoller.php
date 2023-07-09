<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Investment;
use App\Models\Project;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;

class InvoiceController extends Controller
{
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


        $pdf = PDF::loadView('frontend.user.invoice-generate', compact('investment', 'invoice', 'project'))->setPaper('A3', 'landscape');
        $fileName = 'Invoice_' . $investment->id . '_nomor:' . $invoice->id . '_' . now()->format('Ymd') . '.pdf';
        return $pdf->download($fileName);
    }
}
