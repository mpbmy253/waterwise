<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FeedbackModel extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $primaryKey = 'feedback_id';
    public $incrementing = true;
    public $timestamps = false;

    // TO GET ALL THE FEEDBACKS
    static function ToGetAllFeedbacks()
    {
        $records = FeedbackModel::select('*',)
                ->join('customer', 'feedback.customer_id', '=', 'customer.customer_id')
                ->join('users', 'customer.user_id', '=', 'users.id')
                ->orderBy('feedback.feedback_id', 'desc')
                ->where('feedback_status', 1)
                ->paginate(15);
        return $records;
    }

    // TO GET INDIVIDUAL FEEDBACKS
    static function ToGetIndividualFeedback($feedback_id)
    {
        $records = FeedbackModel::select("*",DB::raw("CONCAT(users.fname, ' ', users.lname) as customer_name"))
            ->join('customer', 'feedback.customer_id', '=', 'customer.customer_id')
            ->join('users', 'customer.user_id', '=', 'users.id')
            ->where('feedback.feedback_id', $feedback_id)
            ->first();
        return $records;
    }
}
