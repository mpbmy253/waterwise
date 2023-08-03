<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JobReportModel extends Model
{
    use HasFactory;
    protected $table = 'job_report';
    protected $primaryKey = 'job_report_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET INDIVIDUAL EMPLOYEEE JOB REPORT
    static function ToGetIndividualEmployeeOnJobReport($job_id)
    {
        $records = JobReportModel::select('*')
                ->join('job', 'job_report.job_id', '=', 'job.job_id')
                ->where('job_report.job_id', $job_id)
                ->first();
        return $records;
    }
}
