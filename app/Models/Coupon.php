<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false; //set thoi gian, creeat at ...
    protected $fillable = [
    	'coupon_name', 'coupon_code', 'coupon_time', 'coupon_discount', 'coupon_condition','coupon_used'
    ];
    protected $primaryKey = 'coupon_id';	
    protected $table = 'tbl_coupon';
}
