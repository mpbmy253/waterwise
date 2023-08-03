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

class SystemAdminController extends Controller
{
    // ROLES
    public function btnCreateNewUserProfile()
    {
        return view('systemadmin.roles.create_new_roles');
    }

    public function autoSearchUserProfile(Request $request)
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data = RoleModel::select('*')
                ->where('role_status', 1)
                ->where('company_id', $company_ID)
                ->where(function ($query) use ($request) {
                    $query->where('role_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('role_description', 'LIKE', '%' . $request->search . '%');
                })
                ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function btnViewAllUserProfile()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['activeRole'] = RoleModel::ToGetActiveRole($company_ID);
        if ($data['activeRole']->isEmpty())
        {
            $data['noActiveRole'] = true;
        }
        else
        {
            $data['noActiveRole'] = false;
        }

        return view('systemadmin.roles.view_all_roles', $data);
    }

    public function btnViewDeletedUserProfile()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['deletedRole'] = RoleModel::ToGetDeletedRole($company_ID);
        return view('systemadmin.roles.view_deleted_roles', $data);
    }

    public function btnViewSuspendUserProfile()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['suspendRole'] = RoleModel::ToGetSuspendRole($company_ID);
        return view('systemadmin.roles.view_suspend_roles', $data);
    }

    public function btnViewIndividialRole($role_id)
    {
        $data['singleRole'] = RoleModel::ToGetSingleRole($role_id);
        if(!empty($data['singleRole']))
        {
            return view('systemadmin.roles.view_indivdual_role', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnEditUserProfile($role_id)
    {
        $data['singleRole'] = RoleModel::ToGetSingleRole($role_id);
        if(!empty($data['singleRole']))
        {
            return view('systemadmin.roles.edit_roles', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function deleteUserProfile($role_id)
    {
        $role = RoleModel::ToGetSingleRole($role_id);
        $role->role_status = 2; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $role->save();

        return redirect('systemadmin/roles/view_all_roles')->with('success', "Roles Successfully Delete !");
    }

    public function suspendUserProfile($role_id)
    {
        $role = RoleModel::ToGetSingleRole($role_id);
        $role->role_status = 3; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $role->save();

        return redirect('systemadmin/roles/view_all_roles')->with('success', "Roles Successfully Suspend !");
    }

    public function restoreUserProfile($role_id)
    {
        $role = RoleModel::ToGetSingleRole($role_id);
        $role->role_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $role->save();

        return redirect('systemadmin/roles/view_all_roles')->with('success', "Roles Successfully Restore !");
    }

    public function activateUserProfile($role_id)
    {
        $role = RoleModel::ToGetSingleRole($role_id);
        $role->role_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $role->save();

        return redirect('systemadmin/roles/view_all_roles')->with('success', "Roles Successfully Activate !");
    }

    public function createUserProfile(Request $request)
    {
        /* dd($request->all()); */

        request()->validate([
            'role_name' => 'required|max:255',
            'role_description' => 'required|max:255'
        ]);

        $user = Auth::user();
        if ($user)
        {
            $id = $user->id;
            $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
            $collection = collect($userDetails);
            $company_ID = $collection->pluck('company_id')->first();

            $role = new RoleModel;
            $role->role_name = trim($request->role_name);
            $role->role_description = trim($request->role_description);
            $role->company_id = $company_ID;
            $role->role_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend

            $role->save();

            return redirect('systemadmin/roles/view_all_roles')->with('success', "New Roles Successfully Create !");
        }
        return redirect()->back()->with('error', 'User not found.');
    }

    public function editUserProfile($role_id, Request $request)
    {
        /* dd($request->all()); */
        request()->validate([
            'role_name' => 'required|max:255',
            'role_description' => 'required|max:255'
        ]);

        $role = RoleModel::ToGetSingleRole($role_id);
        if ($role) {
            $role->role_name = trim($request->role_name);
            $role->role_description = trim($request->role_description);
            $role->save();

            return redirect('systemadmin/roles/view_all_roles')->with('success', "Roles Successfully Update !");
        }
        return redirect()->back()->with('error', 'Role not found.');
    }

    // USER ACCOUNT
    public function btnCreateNewAccount()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['activeRole'] = RoleModel::ToGetActiveRole($company_ID);
        return view('systemadmin.account.create_new_account', $data);
    }

    public function autoSearchAccount(Request $request)
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data = User::select('*')
                ->join('employee', 'employee.user_id', '=', 'users.id')
                ->join('roles', 'roles.role_id', '=', 'employee.role_id')
                ->where('users.user_status', 1)
                ->where('employee.company_id', $company_ID)
                ->where(function ($query) use ($request) {
                    $searchTerm = '%' . $request->search . '%';
                    $query->whereRaw("CONCAT(users.fname, ' ', users.lname) LIKE ?", [$searchTerm])
                        ->orWhere('uname', 'LIKE', $searchTerm);

                })
                ->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function btnViewAllAccount()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['activeEmployee'] = User::ToGetActiveEmployeeInfomation($company_ID);
        if ($data['activeEmployee']->isEmpty())
        {
            $data['noActiveEmployee'] = true;
        }
        else
        {
            $data['noActiveEmployee'] = false;
        }

        return view('systemadmin.account.view_all_account', $data);
    }

    public function btnViewDeletedAccount()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['deleteEmployeeInfomation'] = User::ToGetDeleteEmployeeInfomation($company_ID);
        return view('systemadmin.account.view_deleted_account', $data);
    }

    public function btnViewSuspendAccount()
    {
        $id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['suspendEmployeeInfomation'] = User::ToGetSuspendEmployeeInfomation($company_ID);
        return view('systemadmin.account.view_suspend_account', $data);
    }

    public function btnViewIndividialAccount($id)
    {
        $data['singleUserDetails'] = User::ToGetEmployeeDetails($id);
        if(!empty($data['singleUserDetails']))
        {
            return view('systemadmin.account.view_individual_account', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function btnEditAccount($id)
    {
        $main_id = Auth::user()->id;
        $userDetails = User::ToGetCompanyIDFromSysAdmin($main_id);
        $collection = collect($userDetails);
        $company_ID = $collection->pluck('company_id')->first();

        $data['singleUserDetails'] = User::ToGetEmployeeDetails($id);

        if(!empty($data['singleUserDetails']))
        {
            $data['activeRoles'] = RoleModel::ToGetActiveRole($company_ID);
            return view('systemadmin.account.edit_account', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function deleteUserAccount($id)
    {
        $user = User::ToGetSingleUserDetails($id);
        $user->user_status = 2; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $user->save();

        return redirect('systemadmin/account/view_all_account')->with('success', "User Account Successfully Delete !");
    }

    public function suspendUserAccount($id)
    {
        $user = User::ToGetSingleUserDetails($id);
        $user->user_status = 3; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $user->save();

        return redirect('systemadmin/account/view_all_account')->with('success', "User Account Successfully Suspend !");
    }

    public function restoreUserAccount($id)
    {
        $user = User::ToGetSingleUserDetails($id);
        $user->user_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $user->save();

        return redirect('systemadmin/account/view_all_account')->with('success', "User Account Successfully Restore !");
    }

    public function activateUserAccount($id)
    {
        $user = User::ToGetSingleUserDetails($id);
        $user->user_status = 1; // 1: Active/Restore/Activate, 2: Delete, 3: Suspend
        $user->save();

        return redirect('systemadmin/account/view_all_account')->with('success', "User Account Successfully Activate !");
    }

    public function createUserAccount(Request $request)
    {
        /* dd($request->all()); */
        $user = Auth::user();
        if($user){
            $id = $user->id;
            request()->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users,uname,' . $id,
                'email' => 'required|unique:users,email,' . $id,
                'mobile' => 'max:15|min:8',
                'gender' => 'required',
                'role' => 'required',
                'password' => 'required',
            ]);


            // To Pluck company_id
            $userDetails = User::ToGetCompanyIDFromSysAdmin($id);
            $user_collection = collect($userDetails);
            $company_ID = $user_collection->pluck('company_id')->first();

            $newUser = new User;
            $newUser->fname = trim($request->firstname);
            $newUser->lname = trim($request->lastname);
            $newUser->uname = trim($request->username);
            $newUser->password = Hash::make($request->password);
            $newUser->email = trim($request->email);
            $newUser->mobile = trim($request->mobile);
            $newUser->gender = trim($request->gender);
            if ($request->role == 'HR & Customer Service')
            {
                $newUser->user_type = 5;  // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
            }
            elseif ($request->role == 'Supervisor')
            {
                $newUser->user_type = 6; // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
            }
            elseif ($request->role == 'Technicians')
            {
                $newUser->user_type = 7; // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
            }
            else
            {
                $newUser->user_type = 8; // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
            }
            $newUser->user_status = 1; // Status: 1: Active, 2: Delete, 3: Suspend
            $newUser->photo = "";
            $newUser->save();

            // To Pluck role_id
            $roleDetails = CompanyModel::ToGetRoleID($company_ID, $request->role);
            $role_collection = collect($roleDetails);
            $role_ID = $role_collection->pluck('role_id')->first();

            $newEmployee = new EmployeeModel;
            $newEmployee->user_id = $newUser->id;
            $newEmployee->role_id = $role_ID;
            $newEmployee->company_id = $company_ID;
            $newEmployee->save();

            return redirect('systemadmin/account/view_all_account')->with('success', "New User Account Successfully Created !");
        }
        return redirect()->back()->with('error', 'User not found.');
    }

    public function editUserAccount($id, Request $request)
    {
        /* dd($request->all()); */
        request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users,uname,' . $id,
            'email' => 'required|unique:users,email,' . $id,
            'mobile' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'mobile' => 'max:15|min:8',
        ]);

        $user = Auth::user();
        if($user)
        {
            $userDetails = User::ToGetCompanyIDFromSysAdmin(Auth::user()->id);
            $collection = collect($userDetails);
            $company_ID = $collection->pluck('company_id')->first();

            $user_1 = User::ToGetEmployeeDetails($id);

            // Updating users table
            $user_1->fname = trim($request->firstname);
            $user_1->lname = trim($request->lastname);
            $user_1->uname = trim($request->username);
            if (!empty($request->password))
            {
                $user_1->password = Hash::make($request->password);
            }
            $user_1->email = trim($request->email);
            $user_1->mobile = trim($request->mobile);
            $user_1->gender = trim($request->gender);
            if ($request->role == 'HR & Customer Service')
            {
                $user_1->user_type = 5;  // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
            }
            elseif ($request->role == 'Supervisor')
            {
                $user_1->user_type = 6; // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
            }
            elseif ($request->role == 'Technicians')
            {
                $user_1->user_type = 7; // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
            }
            else
            {
                $user_1->user_type = 8; // User Type: 1, Platform Admin, 2: Seller, 3: Customers,  4: System Admin , 5: HR & Customer Service, 6: Supervisor, 7: Technicians, 8: Others,
            }
            $user_1->user_status = 1; // Status: 1: Active, 2: Delete, 3: Suspend
            $user_1->photo = "";
            $user_1->save();

            // To Pluck role_id
            $roleDetails = CompanyModel::ToGetRoleID($company_ID, $request->role);
            $role_collection = collect($roleDetails);
            $role_ID = $role_collection->pluck('role_id')->first();

            // Updating roles table
            $user_2 = EmployeeModel::ToGetEmployeeWithActiveRole($id);
            $user_2->role_id = $role_ID;
            $user_2->save();

            return redirect('systemadmin/account/view_all_account')->with('success', "User Account Successfully Update !");
        }
        return redirect()->back()->with('error', 'User not found.');
    }

    // PAYMENT
    public function btnMakePayment()
    {
        return view('systemadmin.payment.make_payment');
    }

    public function makePayment(Request $request)
    {
        /* dd($request->all()); */
        $id = Auth::user()->id;
        $user_payment = CompanyModel::ToGetCompanyIDFromSysAdmin($id);
        $user_payment->payment = 1; // Status: 1: Paid, 2: Not Paid
        $user_payment->company_status = 1; // Status: 0: Pending, 1: Approved, 2: Suspend
        $user_payment->save();

        return redirect('systemadmin/dashboard');
    }
}
