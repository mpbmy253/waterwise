<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NotificationModel extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $primaryKey = 'notification';
    public $incrementing = true;
    public $timestamps = false;
}
