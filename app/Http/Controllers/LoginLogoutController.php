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

class LoginLogoutController extends Controller
{
    public function login()
    {
        // dd(Hash::make('1234')); // Default Password: Pa$$w0rd!
        return view('marketing_website.Login');
    }

    // Normal Auth Login
    public function AuthLogin(Request $request)
    {
        /* dd($request->all()); */
        $remember = ! empty($request->remember) ? true : false;

        $credentials = [];

        // Check if the input is an email address
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->username;
        } else {
            $credentials['uname'] = $request->username;
        }

        $credentials['password'] = $request->password;

        if (Auth::attempt($credentials, $remember))
        {
            $user = Auth::user();
            // Status: 1: Active, 2: Delete, 3: Suspend
            if ($user->user_status == 1)
            {
                // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,

                // Platform Admin
                if (Auth::user()->user_type == 1)
                {
                    return redirect('platformadmin/dashboard');
                }
                // Seller
                if (Auth::user()->user_type == 2)
                {
                    return redirect('seller/dashboard');
                }
                // System Admin
                if (Auth::user()->user_type == 4)
                {
                    return redirect('systemadmin/dashboard');
                }
                // HR & Customer Service
                if (Auth::user()->user_type == 5)
                {
                    return redirect('hr_customer_service/dashboard');
                }
                // Supervisors
                if (Auth::user()->user_type == 6)
                {
                    return redirect('supervisor/dashboard');
                }
                // Technicians
                if (Auth::user()->user_type == 7)
                {
                    return redirect('technician/dashboard');
                }
                // Others
                if (Auth::user()->user_type == 8)
                {
                    return redirect('commingsoon');
                }
            }
            if ($user->user_status == 0)
            {
                // System Admin
                if (Auth::user()->user_type == 4)
                {
                    return redirect('systemadmin/dashboard');
                }
            }
            else
            {
                Auth::logout();
                return redirect()->back()->with('error', 'Your account is suspended or deleted. Please contact the administrator.');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Please enter correct credentials to login');
        }
    }

    public function logout()
    {
        // Clear the session
        Session::flush();
        Auth::logout();
        return redirect(url(''));
    }
}
