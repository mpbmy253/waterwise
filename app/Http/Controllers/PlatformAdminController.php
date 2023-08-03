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


class PlatformAdminController extends Controller
{
    // SETTINGS
    public function platformAdminAccount()
    {
        $id = Auth::user()->id;
        $data['ToKnowPlatformAdminDetails'] = User::ToKnowPlatformAdminDetails($id);
        return view('platformadmin.settings.my_account', $data);
    }

    public function updatePlatformAdminAccount(Request $request)
    {
        /* dd($request->all()); */
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
        $users->save();

        return redirect()->back()->with('success', "Your Account successfully updated !");
    }

    public function platformAdminChangePassword()
    {
        return view('platformadmin.settings.change_password');
    }

    public function updatePlatformAdminPassword(Request $request)
    {
        /* dd($request->all()); */
        $id = Auth::user()->id;
        $users = User::ToGetSingleUserDetails($id);
        if (Hash::check($request->old_password, $users->password))
        {
            $users->password = Hash::make($request->new_password);
            $users->save();
            return redirect()->back()->with('success', 'Password successfully updated !');
        }
        else
        {
            return redirect()->back()->with('error', 'Old Password is not correct !');
        }
    }

    // COMPANY
    public function autoSearchCompany(Request $request)
    {
        $data = CompanyModel::select('*')
            ->where('company_status', 1)
            ->where('registration_type', 'company')
            ->where(function ($query) use ($request) {
                $query->where('company_uen', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('company_name', 'LIKE', '%' . $request->search . '%');
            })
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function btnViewAllCompany()
    {
        $data['activeCompany'] = CompanyModel::ToGetActiveCompany();
        if ($data['activeCompany']->isEmpty())
        {
            $data['noActiveCompany'] = true;
        }
        else
        {
            $data['noActiveCompany'] = false;
        }
        return view('platformadmin.company.view_all_company', $data);
    }

    public function btnViewPendingCompany()
    {
        $data['pendingCompany'] = CompanyModel::ToGetPendingCompany();
        return view('platformadmin.company.view_pending_company', $data);
    }

    public function approvedCompany($company_id)
    {
        $company = CompanyModel::ToSingleCompany($company_id);
        $company->company_status = 1; //Status: 0: Pending, 1: Approved, 2: Suspend
        $company->save();

        return redirect('platformadmin/account/create_new_sys_admin_account_for_company')->with('success', "Company Successfully Approved !");
    }

    public function btnViewSuspendCompany()
    {
        $data['suspendCompany'] = CompanyModel::ToGetSuspendCompany();
        return view('platformadmin.company.view_suspend_company', $data);
    }

    public function suspendCompany($company_id)
    {
        $company = CompanyModel::ToSingleCompany($company_id);
        $company->payment = 2;  // Status: 1: Paid, 2: Not Paid
        $company->company_status = 2; //Status: 0: Pending, 1: Approved, 2: Suspend
        $company->save();

        return redirect('platformadmin/company/view_all_company')->with('success', "Company Suspended !");
    }

    // CREATING SYSTEM ADMIN ACCOUNT FOR COMPAMY
    public function btnCreateNewSystemAdminForCompany()
    {
        $data['sysAdminNotYetCreatedCompany'] = CompanyModel::ToGetSysAdminNotYetCreatedForCompany();
        return view('platformadmin.account.create_new_account_company', $data);
    }

    public function findUserDetailsBaasedOnCompanySelection(Request $request)
    {
        $data = CompanyModel::select('*',)
                    ->where('company_id', $request->id)
                    ->where('registration_type', 'company')
                    ->first();
        // Return the data as a JSON response
        return response()->json($data);
    }

    public function createNewSystemAdminForCompany(Request $request)
    {
        /* dd($request->all()); */
        $user = Auth::user();
        if($user)
        {
            $id = $user->id;
            request()->validate([
                'username' => 'required|unique:users,uname,' . $id,
                'password' => 'required',
            ]);

            // USER TABLE
            $newUser = new User;
            $newUser->fname = trim($request->firstname);
            $newUser->lname = trim($request->lastname);
            $newUser->uname = trim($request->username);
            $newUser->password = Hash::make($request->password);
            $newUser->email = trim($request->email);
            $newUser->mobile = trim($request->mobile);
            $newUser->gender = trim($request->gender);
            $newUser->user_type = 4;  // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
            $newUser->user_status = 1; // Status: 1: Active, 2: Delete, 3: Suspend
            $newUser->photo = "";
            $newUser->save();

            // ROLES TABLE [3 default]
            $newRole_1 = new RoleModel;
            $newRole_1->role_name = 'HR & Customer Service';
            $newRole_1->role_description = 'To handle enquiry / issue of customers';
            $newRole_1->role_status = 1; // Status: 1: Active, 2: Delete, 3: Suspend
            $newRole_1->company_id = $request->company;
            $newRole_1->save();

            $newRole_2 = new RoleModel;
            $newRole_2->role_name = 'Supervisor';
            $newRole_2->role_description = 'Monitoring employee productivity and providing constructive feedback and coaching';
            $newRole_2->role_status = 1; // Status: 1: Active, 2: Delete, 3: Suspend
            $newRole_2->company_id = $request->company;
            $newRole_2->save();

            $newRole_3 = new RoleModel;
            $newRole_3->role_name = 'Technicians';
            $newRole_3->role_description = 'Inspecting, analyzing, and troubleshooting systems and equipment';
            $newRole_3->role_status = 1; // Status: 1: Active, 2: Delete, 3: Suspend
            $newRole_3->company_id = $request->company;
            $newRole_3->save();

            // SYSTEM ADMIN TABLE
            $newSysAdmin = new SystemAdminModel;
            $newSysAdmin->user_id = $newUser->id;
            $newSysAdmin->company_id = $request->company;
            $newSysAdmin->save();

            // COMPANY TABLE
            $updateCompany = CompanyModel::ToSingleCompany($request->company);
            $updateCompany->sys_admin_account_created = 1;
            $updateCompany->save();

            return redirect('platformadmin/company/view_all_company')->with('success', "System Admin Account  Successfully Created !");
        }
    }

    public function btnToSendEmailToCompany()
    {
        return redirect('platformadmin/company/view_all_company')->with('success', "Email has been send !");
    }

    // SELLER
    public function autoSearchSeller(Request $request)
    {
        $data = CompanyModel::select('*')
            ->where('company_status', 1)
            ->where('registration_type', 'seller')
            ->where(function ($query) use ($request) {
                $searchTerm = '%' . $request->search . '%';
                $query->whereRaw("CONCAT(fname, ' ', lname) LIKE ?", [$searchTerm])
                    ->orWhere('company_uen', 'LIKE', $searchTerm)
                    ->orWhere('company_name', 'LIKE', $searchTerm);
            })
            ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function btnViewAllSeller()
    {
        $data['activeSeller'] = CompanyModel::ToGetActiveSeller();
        return view('platformadmin.seller.view_all_seller', $data);
    }

    public function btnViewPendingSeller()
    {
        $data['pendingSeller'] = CompanyModel::ToGetPendingSeller();
        return view('platformadmin.seller.view_pending_seller', $data);
    }

    public function approvedSeller($company_id)
    {
        $company = CompanyModel::ToSingleCompany($company_id);
        $company->company_status = 1; //Status: 0: Pending, 1: Approved, 2: Suspend
        $company->save();

        return redirect('platformadmin/account/create_new_sys_admin_account_for_seller')->with('success', "Seller Successfully Approved !");
    }

    // CREATING SYSTEM ADMIN ACCOUNT FOR SELLER
    public function btnCreateNewSystemAdminForSeller()
    {
        $data['sysAdminNotYetCreatedSeller'] = CompanyModel::ToGetSysAdminNotYetCreatedForSeller();
        return view('platformadmin.account.create_new_account_seller', $data);
    }

    public function findUserDetailsBaasedOnSellerSelection(Request $request)
    {
        $data = CompanyModel::select('*',)
                ->where('company_id', $request->id)
                ->where('registration_type', 'seller')
                ->first();
        // Return the data as a JSON response
        return response()->json($data);
    }

    public function createNewSystemAdminForSeller(Request $request)
    {
       /*  dd($request->all()); */
        $user = Auth::user();
        if($user)
        {
            $id = $user->id;
            request()->validate([
                'username' => 'required|unique:users,uname,' . $id,
                'password' => 'required',
            ]);

            // USER TABLE
            $newUser = new User;
            $newUser->fname = trim($request->firstname);
            $newUser->lname = trim($request->lastname);
            $newUser->uname = trim($request->username);
            $newUser->password = Hash::make($request->password);
            $newUser->email = trim($request->email);
            $newUser->mobile = trim($request->mobile);
            $newUser->gender = trim($request->gender);
            $newUser->user_type = 2;  // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
            $newUser->user_status = 1; // Status: 1: Active, 2: Delete, 3: Suspend
            $newUser->photo = "";
            $newUser->save();

            // SELER MODEL
            $newSeller = new SellerModel;
            $newSeller->user_id = $newUser->id;
            $newSeller->save();

            // COMPANY TABLE
            $updateCompany = CompanyModel::ToSingleCompany($request->company);
            $updateCompany->sys_admin_account_created = 1;
            $updateCompany->save();

            return redirect('platformadmin/seller/view_all_seller')->with('success', "System Admin Acccount Successfully Created !");
        }
    }

    public function btnToSendEmailToSeller()
    {
        return redirect('platformadmin/seller/view_all_seller')->with('success', "Email has been send !");
    }
}
