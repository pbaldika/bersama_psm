<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use App\Models\User;
use Illuminate\Http\Request;

class FundingController extends Controller
{
    public function create()
    {
        return view('frontend.company.request');
    }

    public function createFunding(Request $input)
    {
        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique(Project::class),
        //     ],
        //     'telephone'=> ['required', 'string', 'max:30', 'unique:projects'],
        //     'gender'=> ['required', 'string', 'max:20'],
        //     'address'=> ['required', 'string', 'max:300'],
        //     'dob'=> ['required', 'date'],
        //     'password' => $this->passwordRules(),
        //     'role'=> ['required', 'string', 'max:20'],
        // ])->validate();

        if ($input->hasFile('image')) {
            $order_photo = $input->file('image');
            $filename = date('YmdHi') . '_' . $order_photo->getClientOriginalName();
            // Store the new images
            $order_photo->storeAs('private/order', $filename);
        }

        Funding::create([
            'fund_required' => $input['fund_required'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'customer_id' => $input['customer_id'],
            'customerName' => $input['customerName'],
            'customerOrder' => $input['customerOrder'],
            'description' => $input['description'],
            'status' => $input['status'],
            'company_registration_number' => $input['company_registration_number'],
            'identity_photo' => $filename,
            'additional_info' => $input['information'],
        ]);

        return redirect()->back()->with('message', "Pemesanan Barang Telah Terbuat!");
    }
}