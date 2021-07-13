<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false; //set thoi gian, creeat at ...
    protected $fillable = [
    	'shipping_name', 'shipping_address', 'shipping_phone','shipping_email','','shipping_method','shipping_notes'
    ];
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';
}
