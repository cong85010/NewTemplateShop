<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false; //set thoi gian, creeat at ...
    protected $fillable = [
    	'order_code ', 'product_id', 'product_name','product_price','product_sale_qty','product_coupon'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';

     public function product()
    {
    	return $this->belongsTo('App\Models\Product','product_id');
    }
}
