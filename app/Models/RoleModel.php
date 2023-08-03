<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoleModel extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET SINGLE RECORD OF QUERY
    static function ToGetSingleRole($role_id)
    {
        return RoleModel::find($role_id);
    }

    // TO GET ACTIVE ROLES
    static function ToGetActiveRole($company_ID)
    {
        $records = RoleModel::select('*')
                    ->where('role_status', 1)
                    ->where('company_id', $company_ID)
                    ->paginate(15);
        return $records;
    }

    // TO GET DELETE ROLES
    static function ToGetDeletedRole($company_ID)
    {
        $records = RoleModel::select('*')
                    ->where('role_status', 2)
                    ->where('company_id', $company_ID)
                    ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no roles being deleted !';
        }
        return $records;
    }

    // TO GET SUSPEND ROLES
    static function ToGetSuspendRole($company_ID)
    {
        $records = RoleModel::select('*')
                    ->where('role_status', 3)
                    ->where('company_id', $company_ID)
                    ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no roles being suspended !';
        }
        return $records;
    }
}
