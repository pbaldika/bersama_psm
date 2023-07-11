<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;

class FundingController extends Controller
{
    public function create()
    {
        return view('frontend.company.request');
    }

    public function createFunding(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fund_required' => 'required',
            'fundName' => 'required',
            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->lessThan(Carbon::today())) {
                        $fail('Kolom Tanggal Mulai harus setelah atau sama dengan hari ini.');
                    }
                },
            ],
            'end_date' => 'required|date',
            'user_id' => 'required',
            'customerName' => 'required',
            'customerOrder' => 'required',
            'description' => 'required',
            'status' => 'required',
            'company_registration_number' => 'nullable',
            'order_photo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'additional_info' => 'nullable',
            'profit_margin_user' => 'required',
            'profit_margin_investor' => 'required',
        ], [
            'fund_required.required' => 'Kolom Jumlah Dana dibutuhkan wajib diisi.',
            'fundName.required' => 'Kolom Nama Dana wajib diisi.',
            'start_date.required' => 'Kolom Tanggal Mulai wajib diisi.',
            'start_date.date' => 'Kolom Tanggal Mulai harus berupa tanggal yang valid.',
            'start_date.after' => 'Kolom Tanggal Mulai harus setelah atau sama dengan hari ini.',
            'end_date.required' => 'Kolom Tanggal Selesai wajib diisi.',
            'end_date.date' => 'Kolom Tanggal Selesai harus berupa tanggal yang valid.',
            'user_id.required' => 'Kolom ID Pengguna wajib diisi.',
            'customerName.required' => 'Kolom Nama Pelanggan wajib diisi.',
            'customerOrder.required' => 'Kolom Pesanan Pelanggan wajib diisi.',
            'description.required' => 'Kolom Deskripsi wajib diisi.',
            'status.required' => 'Kolom Status wajib diisi.',
            'company_registration_number.nullable' => 'Kolom Nomor Registrasi Perusahaan harus berupa nomor yang valid.',
            'order_photo.nullable' => 'Kolom Foto Pesanan harus berupa file gambar (format: PNG, JPG, atau JPEG) dengan ukuran maksimal 2048 KB.',
            'order_photo.image' => 'Kolom Foto Pesanan harus berupa file gambar (format: PNG, JPG, atau JPEG).',
            'order_photo.mimes' => 'Kolom Foto Pesanan harus berupa file gambar dengan format PNG, JPG, atau JPEG.',
            'order_photo.max' => 'Ukuran file Foto Pesanan tidak boleh melebihi 2048 KB (2 MB).',
            'additional_info.nullable' => 'Kolom Informasi Tambahan harus berupa teks.',
            'profit_margin_user.required' => 'Kolom Margin Profit Pengguna wajib diisi.',
            'profit_margin_investor.required' => 'Kolom Margin Profit Investor wajib diisi.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        if ($request->hasFile('order_photo')) {
            $order_photo = $request->file('order_photo');
            $filename = date('YmdHi') . '_' . $order_photo->getClientOriginalName();
            // Store the new images
            $order_photo->storeAs('private/order', $filename);
        }
    
        Funding::create([
            'fund_required' => $request['fund_required'],
            'fundName' => $request['fundName'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'user_id' => $request['user_id'],
            'customerName' => $request['customerName'],
            'customerOrder' => $request['customerOrder'],
            'description' => $request['description'],
            'status' => $request['status'],
            'company_registration_number' => $request['company_registration_number'],
            'order_photo' => $filename,
            'additional_info' => $request['information'],
            'profit_margin_user' => $request['profit_margin_user'],
            'profit_margin_investor' => $request['profit_margin_investor'],
        ]);
    
        return redirect()->back()->with('message', "Pemesanan Barang Telah Terbuat!");
    }
    

    public function fundingList()
    {
        $user = Auth::user(); // Get the currently authenticated user
        $userId = $user->id; // Get the user's ID

        // Retrieve investments made by the user
        $fundings = funding::where('user_id', $userId)->get();

        // Retrieve project IDs associated with the fundings
        $projectIds = $fundings->pluck('project_id');

        // // Retrieve projects associated with the fundings
        // $projects = Project::whereIn('id', $projectIds)->get()->keyBy('id');

        // $fundingCount = funding::count();
        // $totalfunding = funding::sum('total');
        // $activefundingCount = funding::where('status', 'active')->count();
        // $totalProfit = funding::sum('profit');

        return view('frontend.company.funding-made', ['fundings' => $fundings]);
    }
}