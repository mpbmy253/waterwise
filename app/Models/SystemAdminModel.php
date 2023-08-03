<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SystemAdminModel extends Model
{
    use HasFactory;
    protected $table = 'sys_admin';
    protected $primaryKey = 'sys_admin_id';
    public $incrementing = true;
    public $timestamps = false;
}
