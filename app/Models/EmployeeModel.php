<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployeeModel extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $primaryKey = 'employee_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET ACTIVE EMPLOYEE BASED ON THIER ID
    static function ToGetEmployeeWithActiveRole($id)
    {
        $records = EmployeeModel::select('*')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->join('roles', 'employee.role_id', '=', 'roles.role_id')
                ->where('users.id', $id)
                ->first();
        return $records;
    }

    // TO GET ACTIVE TECHNICIAN
    static function ToGetActiveTechnician($company_ID)
    {
        // User Status = 1: Active, 2: Delete, 3: Suspend
        $records = EmployeeModel::select('*')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->join('roles', 'roles.role_id', '=', 'employee.role_id')
                ->where('users.user_status', 1)
                ->where('users.user_type', 7)
                ->where('employee.company_id', $company_ID)
                ->get();
        return $records;
    }

    // TO GET EMPLOYEE NOT TECHNICIAN
    static function ToGetNotTechnician($company_ID)
    {
        // User Status = 1: Active, 2: Delete, 3: Suspend
        $records = EmployeeModel::select('*')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->join('roles', 'roles.role_id', '=', 'employee.role_id')
                ->where('users.user_status', 1)
                ->where('users.user_type', '!=', 7)
                ->where('employee.company_id', $company_ID)
                ->get();
        return $records;
    }

    // TO GET DETAILS OF TECHNICIAN THAT REQUESTING ASSISTANCE
    static function ToGetAllDetailsForAssistance($employee_ID, $company_ID, $jobDescription)
    {
        $records = EmployeeModel::select(DB::raw("CONCAT(users.fname, ' ', users.lname) AS employee_name"),
                'job.job_description AS job_description',
                'job.customer_id',
                'job.job_id')
            ->join('users', 'employee.user_id', '=', 'users.id')
            ->join('job', 'job.employee_id', '=', 'employee.employee_id')
            ->where('job.employee_id', $employee_ID)
            ->where('employee.employee_id', $employee_ID)
            ->where('employee.company_id', $company_ID)
            ->where('job.job_description', $jobDescription)
            ->where('job.job_status', 2)
            ->first();
            /* ->get(); */
        return $records;
    }

    // TO GET OTHER TECHNICIANS THAT IS AVIALBLE
    static function ToGetOtherTechnicianAvailable($employee_ID, $company_ID)
    {
        $records = EmployeeModel::select('*')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->join('roles', 'roles.role_id', '=', 'employee.role_id')
                ->where('roles.role_name', 'Technicians')
                ->where('users.user_status', 1)
                ->where('employee.employee_id', '!=', $employee_ID)
                ->where('employee.company_id', $company_ID)
                ->get();
        return $records;
    }

}
