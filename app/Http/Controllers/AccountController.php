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

class AccountController extends Controller
{
    // PLATFORM ADMIN
    public function platformAdminAccount()
    {
        $id = Auth::user()->id;
        $data['ToKnowPlatformAdminDetails'] = User::ToKnowPlatformAdminDetails($id);
        return view('platformadmin.settings.my_account', $data);
    }

    public function updatePlatformAdminAccount(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            request()->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users,uname,' . $id,
                'email' => 'required|unique:users,email,' . $id,
                'mobile' => 'max:15|min:8',
            ]);

            $users = User::ToGetSingleUserDetails($id);

            $users->fname = trim($request->firstname);
            $users->lname = trim($request->lastname);
            $users->uname = trim($request->username);
            $users->email = trim($request->email);
            $users->mobile = trim($request->mobile);
            $users->photo = "";
            $users->save();

            return redirect()->back()->with('success', "Your Account successfully updated !");
        }
    }

    public function platformAdminChangePassword()
    {
        return view('platformadmin.settings.change_password');
    }

    public function updatePlatformAdminPassword(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            $users = User::ToGetSingleUserDetails($id);

            if (Hash::check($request->old_password, $users->password))
            {
                $users->password = Hash::make($request->new_password);
                $users->save();
                return redirect()->back()->with('success', 'Password successfully updated!');
            }
            else
            {
                return redirect()->back()->with('error', 'Old Password is not correct!');
            }
        }

    }

    // SYSTEM ADMIN
    public function systemAdminAccount()
    {
        $id = Auth::user()->id;
        $data['ToKnowSystemAdminDetails'] = User::ToKnowSystemAdminDetails($id);
        return view('systemadmin.settings.my_account', $data);
    }

    public function updateSystemAdminAccount(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            request()->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users,uname,' . $id,
                'email' => 'required|unique:users,email,' . $id,
                'mobile' => 'max:15|min:8',
            ]);

            $users = User::ToGetSingleUserDetails($id);

            $users->fname = trim($request->firstname);
            $users->lname = trim($request->lastname);
            $users->uname = trim($request->username);
            $users->email = trim($request->email);
            $users->mobile = trim($request->mobile);
            $users->photo = "";
            $users->save();

            return redirect()->back()->with('success', "Your Account successfully updated !");
        }
    }

    public function systemAdminChangePassword()
    {
        return view('systemadmin.settings.change_password');
    }

    public function updateSystemAdminPassword(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            $users = User::ToGetSingleUserDetails($id);

            if (Hash::check($request->old_password, $users->password))
            {
                $users->password = Hash::make($request->new_password);
                $users->save();
                return redirect()->back()->with('success', 'Password successfully updated!');
            }
            else
            {
                return redirect()->back()->with('error', 'Old Password is not correct!');
            }
        }
    }

    // HR & CUSTOMER SERVICE
    public function HrCustomerServiceAccount()
    {
        $id = Auth::user()->id;
        $data['ToKnowHRCustomerServiceDetails'] = User::ToKnowHRCustomerServiceDetails($id);
        return view('hr_customer_service.settings.my_account', $data);
    }

    public function updateHrCustomerServiceAccount(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            request()->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users,uname,' . $id,
                'email' => 'required|unique:users,email,' . $id,
                'mobile' => 'max:15|min:8',
            ]);

            $users = User::ToGetSingleUserDetails($id);

            $users->fname = trim($request->firstname);
            $users->lname = trim($request->lastname);
            $users->uname = trim($request->username);
            $users->email = trim($request->email);
            $users->mobile = trim($request->mobile);
            $users->photo = "";
            $users->save();

            return redirect()->back()->with('success', "Your Account successfully updated !");
        }
    }

    public function HrCustomerServiceChangePassword()
    {
        return view('hr_customer_service.settings.change_password');
    }

    public function updateHrCustomerServicePassword(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            $users = User::ToGetSingleUserDetails($id);

            if (Hash::check($request->old_password, $users->password))
            {
                $users->password = Hash::make($request->new_password);
                $users->save();
                return redirect()->back()->with('success', 'Password successfully updated!');
            }
            else
            {
                return redirect()->back()->with('error', 'Old Password is not correct!');
            }
        }
    }

    //  SUPERVISOR
    public function supervisorAccount()
    {
        $id = Auth::user()->id;
        $data['ToKnowSupervisorDetails'] = User::ToKnowSupervisorDetails($id);
        return view('supervisor.settings.my_account', $data);
    }

    public function updateSupervisorAccount(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            request()->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users,uname,' . $id,
                'email' => 'required|unique:users,email,' . $id,
                'mobile' => 'max:15|min:8',
            ]);

            $users = User::ToGetSingleUserDetails($id);

            $users->fname = trim($request->firstname);
            $users->lname = trim($request->lastname);
            $users->uname = trim($request->username);
            $users->email = trim($request->email);
            $users->mobile = trim($request->mobile);
            $users->photo = "";
            $users->save();

            return redirect()->back()->with('success', "Your Account successfully updated !");
        }
    }

    public function supervisorChangePassword()
    {
        return view('supervisor.settings.change_password');
    }

    public function updateSupervisorPassword(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            $users = User::ToGetSingleUserDetails($id);

            if (Hash::check($request->old_password, $users->password))
            {
                $users->password = Hash::make($request->new_password);
                $users->save();
                return redirect()->back()->with('success', 'Password successfully updated!');
            }
            else
            {
                return redirect()->back()->with('error', 'Old Password is not correct!');
            }
        }
    }

    //  TECHNICANS
    public function technicianAccount()
    {
        $id = Auth::user()->id;
        $data['ToKnowTechnicianDetails'] = User::ToKnowTechnicianDetails($id);
        return view('technician.settings.my_account', $data);
    }

    public function updateTechnicianAccount(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            request()->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users,uname,' . $id,
                'email' => 'required|unique:users,email,' . $id,
                'mobile' => 'max:15|min:8',
            ]);

            $users = User::ToGetSingleUserDetails($id);

            $users->fname = trim($request->firstname);
            $users->lname = trim($request->lastname);
            $users->uname = trim($request->username);
            $users->email = trim($request->email);
            $users->mobile = trim($request->mobile);
            $users->photo = "";
            $users->save();

            return redirect()->back()->with('success', "Your Account successfully updated !");
        }
    }

    public function technicianChangePassword()
    {
        return view('technician.settings.change_password');
    }

    public function updateTechnicianPassword(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            $users = User::ToGetSingleUserDetails($id);

            if (Hash::check($request->old_password, $users->password)) {
                $users->password = Hash::make($request->new_password);
                $users->save();
                return redirect()->back()->with('success', 'Password successfully updated!');
            } else {
                return redirect()->back()->with('error', 'Old Password is not correct!');
            }
        }
    }

    //  SELLER
    public function sellerAccount()
    {
        $id = Auth::user()->id;
        $data['ToKnowSellerDetails'] = User::ToKnowSellerDetails($id);
        return view('seller.settings.my_account', $data);
    }

    public function updateSellerAccount(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            request()->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users,uname,' . $id,
                'email' => 'required|unique:users,email,' . $id,
                'mobile' => 'max:15|min:8',
            ]);

            $users = User::ToGetSingleUserDetails($id);

            $users->fname = trim($request->firstname);
            $users->lname = trim($request->lastname);
            $users->uname = trim($request->username);
            $users->email = trim($request->email);
            $users->mobile = trim($request->mobile);
            $users->photo = "";
            $users->save();

            return redirect()->back()->with('success', "Your Account successfully updated !");
        }
    }

    public function sellerChangePassword()
    {
        return view('seller.settings.change_password');
    }

    public function updateSellerPassword(Request $request)
    {
        /* dd($request->all()); */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            $users = User::ToGetSingleUserDetails($id);

            if (Hash::check($request->old_password, $users->password)) {
                $users->password = Hash::make($request->new_password);
                $users->save();
                return redirect()->back()->with('success', 'Password successfully updated!');
            } else {
                return redirect()->back()->with('error', 'Old Password is not correct!');
            }
        }
    }
}
