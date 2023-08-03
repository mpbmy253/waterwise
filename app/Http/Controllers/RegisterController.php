<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\AddressModel; // AddressModel
use App\Models\ChemicalModel; // ChemicalModel
use App\Models\CommentModel;  // CommentModel
use App\Models\CompanyModel; // CompanyModel
use App\Models\CustomerBillModel; // CustomerBillModel
use App\Models\CustomerModel; // CustomerModel
use App\Models\EmployeeModel; // EmployeeModel
use App\Models\EquipmentModel; // EquipmentModel
use App\Models\FeedbackModel; // FeedbackModel
use App\Models\JobModel; // JobModel
use App\Models\JobReportModel; // JobReportModel
use App\Models\NotificationModel; // NotificationModel
use App\Models\PaymentModel; // PaymentModel
use App\Models\PipeModel; // PipeModel
use App\Models\PlatformAdminModel; // PlatformAdminModel
use App\Models\ProductModel; // ProductModel
use App\Models\ReplyFeedbackModel;  // ReplyFeedbackModel
use App\Models\RoleModel; // RoleModel
use App\Models\SellerModel;// SellerModel
use App\Models\ServiceModel; // ServiceModel
use App\Models\SystemAdminModel; // SystemAdminModel
use App\Models\User; // User
use App\Models\WaterSupplyEquipmentModel;// WaterSupplyEquipmentModel
use App\Models\WaterUsageModel;// WaterUsageModel

class RegisterController extends Controller
{
    public function registerAccount(Request $request)
    {
       /*  dd($request->all()); */
        // Validating the input data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'max:15|min:8',
            'gender' => 'required',
            'company_uen' => 'required',
            'company_name' => 'required',
            'registration_type' => 'required',
        ]);

        // Storing the registration data in the session
        $registrationData = [
            'fname' => trim($request->firstname),
            'lname' => trim($request->lastname),
            'email' => trim($request->email),
            'mobile' => trim($request->mobile),
            'gender' => trim($request->gender),
            'company_uen' => trim($request->company_uen),
            'company_name' => trim($request->company_name),
            'registration_type' => $request->registration_type,
        ];

        session(['registrationData' => $registrationData]);

        return redirect('payment');
    }

    public function payment()
    {
        return view('marketing_website.Payment');
    }

    public function paymentSuccessful(Request $request)
    {
        if ($registrationData = session('registrationData')) {
            // Store the registration data in the database
            $newRegister = new CompanyModel;
            $newRegister->fname = $registrationData['fname'];
            $newRegister->lname = $registrationData['lname'];
            $newRegister->email = $registrationData['email'];
            $newRegister->mobile = $registrationData['mobile'];
            $newRegister->gender = $registrationData['gender'];
            $newRegister->company_uen = $registrationData['company_uen'];
            $newRegister->company_name = $registrationData['company_name'];
            $newRegister->registration_type = $registrationData['registration_type'];
            $newRegister->save();

            // Clear the registration data from the session
            $request->session()->forget('registrationData');

            return redirect('login')->with('success', 'Payment successful. Please wait for the Platform Admin to Approve !');
        }

        // Redirect to an error page or handle the case when registration data is not found in the session
        return redirect('error')->with('error', 'Registration data not found.');
    }
}
