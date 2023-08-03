<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JobModel extends Model
{
    use HasFactory;
    protected $table = 'job';
    protected $primaryKey = 'job_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET SINGLE RECORD OF QUERY
    static function ToSingleJob($job_id)
    {
        return JobModel::find($job_id);
    }

    // SUPERVISOR SIDE
    // TO GET EMPLOYEE ON JOB
    static function ToGetIndividualEmployeeOnJob($job_id)
    {
        $records = JobModel::select("*",
            DB::raw("CONCAT(employee_users.fname, ' ', employee_users.lname) as employee_name"),
            DB::raw("CONCAT(customer_users.fname, ' ', customer_users.lname) as customer_name"),
            DB::raw("CONCAT(address.building_street, ' ', '#', address.unit_no, ' ', 'Singapore (',address.postal_code,')') as customer_address"),
            )
            ->join('customer', 'job.customer_id', '=', 'job.customer_id')
            ->join('address', 'customer.address_id', '=', 'address.address_id')
            ->join('employee', 'job.employee_id', '=', 'employee.employee_id')
            ->join('users as employee_users', 'employee.user_id', '=', 'employee_users.id')
            ->join('users as customer_users', 'customer.user_id', '=', 'customer_users.id')
            ->where('job.job_id', $job_id)
            ->first();
        return $records;
    }

    // TO GET ALL PENDING JOB
    static function ToViewAllPendingJob($company_ID)
    {
        $records = JobModel::select('*')
                ->join('employee', 'job.employee_id', '=', 'employee.employee_id')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->where('job.job_status', 0)
                ->where('employee.company_id', $company_ID)
                ->orderBy('job.job_date', 'desc')
                ->paginate(15);
        return $records;
    }

    // TO GET ALL JOB THAT REQUIRE ASSISTANCE
    static function ToViewAllJobRequireAssistance($company_ID)
    {
        $records = JobModel::select('*')
                ->join('employee', 'job.employee_id', '=', 'employee.employee_id')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->where('job.job_status', 2)
                ->where('employee.company_id', $company_ID)
                ->orderBy('job.job_date', 'desc')
                ->paginate(15);
        return $records;
    }

    // TO GET ALL DELETE JOB
    static function ToViewAllDeletedJob()
    {
        $records = JobModel::select('*')
                ->join('employee', 'job.employee_id', '=', 'employee.employee_id')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->where('job.job_status', 3)
                ->orderBy('job.job_id', 'desc')
                ->paginate(15);
        return $records;
    }

    // TO GET THE JOB DETAILS OF THE EMPLOYEEE THAT REQUIRE ASSISTANCE
    static function ToViewJobDetailsBasedOnEmployeeThatRequestingAssistance($job_id)
    {
        $records = JobModel::select('*')
            ->join('employee', 'job.employee_id', '=', 'employee.employee_id')
            ->join('users', 'employee.user_id', '=', 'users.id')
            ->where('job.job_status', 2)
            ->where('job.job_id', $job_id)
            ->get();
        return $records;
    }

    // TO GET ALL COMPLETED JOB
    static function ToViewAllCompletedJobsByTechnicians($company_ID)
    {
        $records = JobModel::select('*')
                ->join('employee', 'job.employee_id', '=', 'employee.employee_id')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->where('job.job_status', 1)
                ->where('employee.company_id', $company_ID)
                ->orderBy('job.job_date', 'desc')
                ->paginate(15);
        return $records;
    }

    // TECHNICIAN SIDE
    // // TO GET SINGLE RECORD OF QUERY
    static function ToSingleJobDetails($job_id)
    {
        $records = JobModel::select('*',)
                    ->join('employee', 'job.employee_id', '=', 'employee.employee_id')
                    ->join('users', 'employee.user_id', '=', 'users.id')
                    ->where('job.job_id', $job_id)
                    ->get();
        return $records;
    }

    // TO GET ALL COMPLETED JOB
    static function ToViewAllCompletedJob($id)
    {
        $records = JobModel::select('*')
                ->join('employee', 'job.employee_id', '=', 'employee.employee_id')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->where('job.job_status', 1)
                ->where('users.id', $id)
                ->orderBy('job.job_date', 'desc')
                ->paginate(15);
        return $records;
    }

    // TO GET ALL PENDING JOB
    static function ToViewPendingJobForTechnician($id)
    {
        $records = JobModel::select('*')
                ->join('employee', 'job.employee_id', '=', 'employee.employee_id')
                ->join('users', 'employee.user_id', '=', 'users.id')
                ->where('job.job_status', 0)
                ->where('users.id', $id)
                ->orderBy('job.job_date', 'desc')
                ->paginate(15);
        return $records;
    }
}
