<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompanyModel extends Model
{
    use HasFactory;
    protected $table = 'company';
    protected $primaryKey = 'company_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET SINGLE QUERY OF RECORD
    static function ToSingleCompany($company_id)
    {
        return CompanyModel::find($company_id);
    }

    // TO GET COMPANY ID FROM SYSTEM ADMIN
    static function ToGetCompanyIDFromSysAdmin($id)
    {
        $records = CompanyModel::select('*',)
                ->join('sys_admin', 'company.company_id', '=', 'sys_admin.company_id')
                ->join('users', 'users.id', '=', 'sys_admin.user_id')
                ->where('users.id', $id)
                ->first();
        return $records;
    }

    // TO GET COMPANY ID FROM SELLER
    static function ToGetCompanyIDFromSeller($id)
    {
        $records = CompanyModel::select('*',)
                ->join('seller', 'company.company_id', '=', 'seller.company_id')
                ->join('users', 'users.id', '=', 'seller.user_id')
                ->where('users.id', $id)
                ->first();
        return $records;
    }

    // TO GET COMPANY ID FROM EMPLOYEE
    static function ToGetCompanyIDFromEmplopyee($id)
    {
        $records = CompanyModel::select('*',)
                ->join('employee', 'company.company_id', '=', 'employee.company_id')
                ->join('users', 'users.id', '=', 'employee.user_id')
                ->where('users.id', $id)
                ->first();
        return $records;
    }

    // TO GET ROLE ID
    static function ToGetRoleID($company_ID,  $role_name)
    {
        $records = CompanyModel::select('*',)
                ->join('roles', 'roles.company_id', '=', 'company.company_id')
                ->where('roles.role_name', $role_name)
                ->where('company.company_id', $company_ID)
                ->get();
        return $records;
    }

    // TO GET ALL APPROVED COMPANY
    static function ToGetActiveCompany()
    {
         $records = CompanyModel::select('*',)
                    ->where('company_status', 1)
                    ->where('registration_type', 'company')
                    ->paginate(15);
        return $records;
    }

    // TO GET ALL PENDING COMPANY
    static function ToGetPendingCompany()
    {
        $records = CompanyModel::select('*',)
                    ->where('company_status', 0)
                    ->where('registration_type', 'company')
                    ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no pending company !';
        }
        return $records;
    }

    // TO GET ALL SUSPEND COMPANY
    static function ToGetSuspendCompany()
    {
        $records = CompanyModel::select('*',)
                    ->where('company.company_status', 2)
                    ->where('registration_type', 'company')
                    ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no suspend company !';
        }
        return $records;
    }

    // TO GET SYSTEM ADMIN WHICH HAS NOT CREATED FOR COMPANY
    static function ToGetSysAdminNotYetCreatedForCompany()
    {
        $records = CompanyModel::select('*',)
                ->where('company_status', 1)
                ->where('sys_admin_account_created', 0)
                ->where('registration_type', 'company')
                ->get();
        return $records;
    }

    // TO GET ALL APPROVED SELLER
    static function ToGetActiveSeller()
    {
        $records = CompanyModel::select('*',)
                    ->where('company.company_status', 1)
                    ->where('registration_type', 'seller')
                    ->paginate(15);
        return $records;
    }

    // TO GET ALL PENDING SELLER
    static function ToGetPendingSeller()
    {
        $records = CompanyModel::select('*',)
                    ->where('company.company_status', 0)
                    ->where('registration_type', 'seller')
                    ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no pending seller !';
        }
        return $records;
    }

    // TO GET ALL SUSPEND SELLER
    static function ToGetSuspendSeller()
    {
        $records = CompanyModel::select('*',)
                    ->where('company.company_status', 2)
                    ->where('registration_type', 'seller')
                    ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no suspend seller !';
        }
        return $records;
    }

    // TO GET SYSTEM ADMIN WHICH HAS NOT CREATED FOR SELLER
    static function ToGetSysAdminNotYetCreatedForSeller()
    {
        $records = CompanyModel::select('*',)
                ->where('company.company_status', 1)
                ->where('company.sys_admin_account_created', 0)
                ->where('registration_type', 'seller')
                ->get();
        return $records;
    }
}
