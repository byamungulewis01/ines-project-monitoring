<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Order;
use App\Models\Project;
use EdwardMuss\Rave\Facades\Rave as Flutterwave;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $departments = Department::all();
        $projects = Project::where('visible', 'publish')->where('status', 'approved')->where('isSponsered', false)->get();
        return view('welcome', compact('departments', 'projects'));
    }

    public function showProject(Project $project)
    {

        return view('show-project', compact('project'));
    }
    public function category(Department $department)
    {
        // dd('here');
        $projects = Project::where('department_id', $department->id)->where('visible', 'publish')->where('status', 'approved')->where('isSponsered', false)->get();

        return view('category-project', compact('projects', 'department'));
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
            'email' => auth()->guard('sponser')->user()->email,
            'tx_ref' => $reference,
            'currency' => "RWF",
            'type' => "mobile_money_rwanda",
            'redirect_url' => route('paymentCallback'),
            'customer' => [
                'email' => auth()->guard('sponser')->user()->email,
                "phone_number" => '',
                "name" => auth()->guard('sponser')->user()->name,
            ],
            'meta' => [
                "sponser_id" => auth()->guard('sponser')->id(),
                "project_id" => $project->id,
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

            $info = $data['data']['meta'];

            Order::create([
                'sponser_id' => $info['sponser_id'],
                'project_id' => $info['project_id'],
            ]);
            Project::find($info['project_id'])->update(['isSponsered' => true]);
        } elseif ($status ==  'cancelled') {
            //Put desired action/code after transaction has been cancelled here
        } else {
            //Put desired action/code after transaction has failed here
        }

        return to_route('sponser.showProject', $data['data']['meta']['project_id']);
    }
}
