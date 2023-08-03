<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $primaryKey = 'card_payment_id';
    public $incrementing = true;
    public $timestamps = false;
}
