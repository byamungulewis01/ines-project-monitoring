<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Project;
use EdwardMuss\Rave\Facades\Rave as Flutterwave;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $departments = Department::all();
        $projects = Project::where('visible', 'publish')->where('status', 'approved')->get();
        return view('welcome', compact('departments', 'projects'));
    }

    public function showProject(Project $project)
    {

        return view('show-project', compact('project'));
    }
    public function category()
    {
        // dd('here');
        return view('category-project');
    }
    public function buyProject($id)
    {
        $project = Project::find($id);

        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $project->price,
            'email' => 'byamungulewis@gmail.com',
            'tx_ref' => $reference,
            'currency' => "RWF",
            'type' => "mobile_money_rwanda",
            'redirect_url' => route('paymentCallback'),
            'customer' => [
                'email' => 'byamungulewis@gmail.com',
                "phone_number" => '0785436135',
                "name" => 'BYAMUNGU Lewis'
            ],

            "customizations" => [
                "title" => "Sponsering Student project",
                "description" => "Sponsering student project"
            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            dd('fail');
        }

        return redirect($payment['data']['link']);
    }
    public function paymentCallback()
    {
        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

        $transactionID = Flutterwave::getTransactionIDFromCallback();
        $data = Flutterwave::verifyTransaction($transactionID);

        dd($data);
        }
        elseif ($status ==  'cancelled'){
            //Put desired action/code after transaction has been cancelled here
        }
        else{
            //Put desired action/code after transaction has failed here
        }
    
        return view('payment-callback');
    }
}
