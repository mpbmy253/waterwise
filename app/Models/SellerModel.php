<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SellerModel extends Model
{
    use HasFactory;
    protected $table = 'seller';
    protected $primaryKey = 'seller_id';
    public $incrementing = true;
    public $timestamps = false;
}
