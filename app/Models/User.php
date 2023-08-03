<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    // To get a single user details
    static function ToGetSingleUserDetails($id)
    {
        return User::find($id);
    }

    // To get Company ID from System Admin
    static function ToGetCompanyIDFromSysAdmin($id)
    {
        $records = User::select('*',)
                ->join('sys_admin', 'users.id', '=', 'sys_admin.user_id')
                ->join('company', 'company.company_id', '=', 'sys_admin.company_id')
                ->where('users.id', $id)
                ->get();
        return $records;
    }

    // To get Company ID from Employee
    static function ToGetCompanyIDFromEmployee($id)
    {
        $records = User::select('*',)
                ->join('employee', 'users.id', '=', 'employee.user_id')
                ->join('company', 'company.company_id', '=', 'employee.company_id')
                ->where('users.id', $id)
                ->get();
        return $records;
    }

    // To get all the record query of the active employee
    static function ToGetActiveEmployeeInfomation($company_ID)
    {
        // User Status = 1: Active, 2: Delete, 3: Suspend
        $records = User::select('*')
                ->join('employee', 'employee.user_id', '=', 'users.id')
                ->join('roles', 'roles.role_id', '=', 'employee.role_id')
                ->where('users.user_status', 1)
                ->where('employee.company_id', $company_ID)
                ->paginate(15);
        return $records;
    }

    // To get all the record query of the delete employee
    static function ToGetDeleteEmployeeInfomation($company_ID)
    {
        // User Status = 1: Active, 2: Delete, 3: Suspend
        $records = User::select('*')
                ->join('employee', 'employee.user_id', '=', 'users.id')
                ->join('roles', 'roles.role_id', '=', 'employee.role_id')
                ->where('users.user_status', 2)
                ->where('employee.company_id', $company_ID)
                ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no deleted account !';
        }
        return $records;
    }

    // To get all the record query of the delete employee
    static function ToGetSuspendEmployeeInfomation($company_ID)
    {
        // User Status = 1: Active, 2: Delete, 3: Suspend
        $records = User::select('*')
                ->join('employee', 'employee.user_id', '=', 'users.id')
                ->join('roles', 'roles.role_id', '=', 'employee.role_id')
                ->where('users.user_status', 3)
                ->where('employee.company_id', $company_ID)
                ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no suspended account !';
        }
        return $records;
    }

    static function ToGetEmployeeDetails($id)
    {
        // User Status = 1: Active, 2: Delete, 3: Suspend
        $records = User::select('*')
                ->join('employee', 'employee.user_id', '=', 'users.id')
                ->join('roles', 'roles.role_id', '=', 'employee.role_id')
                ->where('users.user_status', 1)
                ->where('users.id', $id)
                ->first();
        return $records;
    }

    /* PLATFORM ADMIN  */
    // To know the Platform Admin Account Details
    static function ToKnowPlatformAdminDetails($id)
    {
        $records = User::select('*',)
                ->join('platform_admin', 'users.id', '=', 'platform_admin.platform_admin_id')
                ->where('users.id', $id)
                ->first();
        return $records;
    }

    /* SYSTEM  ADMIN  */
    // To know the System Admin Account Details
    static function ToKnowSystemAdminDetails($id)
    {
        $records = User::select('*',)
                ->join('sys_admin', 'sys_admin.user_id', '=', 'users.id')
                ->where('users.id', $id)
                ->first();
        return $records;
    }

    /* HR & CUSTOMER SERVICE  */
    // To know the HR & Customer Service Account Details
    static function ToKnowHRCustomerServiceDetails($id)
    {
        $records = User::select('*',)
                /* ->join('employee', 'users.id', '=', 'employee.employee_id') */
                ->where('users.id', $id)
                ->first();
        return $records;
    }

    /* SUPERVISOR  */
    // To know the Supervisor Details
    static function ToKnowSupervisorDetails($id)
    {
        $records = User::select('*',)
                /* ->join('employee', 'users.id', '=', 'employee.employee_id') */
                ->where('users.id', $id)
                ->first();
        return $records;
    }


    /* TECHNICANS  */
    // To know the Technicans Details
    static function ToKnowTechnicianDetails($id)
    {
        $records = User::select('*',)
                ->join('employee', 'employee.user_id', '=', 'users.id')
                ->where('users.id', $id)
                ->first();
        return $records;
    }


    /* SELLER  */
    // To know the Seller Details
    static function ToKnowSellerDetails($id)
    {
        $records = User::select('*',)
                ->join('seller', 'users.id', '=', 'seller.user_id')
                ->where('users.id', $id)
                ->first();
        return $records;
    }

    static function ToGetSellerID($id)
    {
        $records = User::select('*',)
                ->join('seller', 'users.id', '=', 'seller.user_id')
                ->where('users.id', $id)
                ->get();
        return $records;
    }

}
