<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReplyFeedbackModel extends Model
{
    use HasFactory;
    protected $table = 'reply_feedback';
    protected $primaryKey = 'reply_feedback_id';
    public $incrementing = true;
    public $timestamps = false;
}
