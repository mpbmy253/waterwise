<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlatformAdminModel extends Model
{
    use HasFactory;
    protected $table = 'platform_admin';
    protected $primaryKey = 'platform_admin_id';
    public $incrementing = true;
    public $timestamps = false;
}
