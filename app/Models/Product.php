<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set thoi gian, creeat at ...
    protected $fillable = [
    	'category_id','brand_id','product_name','product_desc','product_content','product_price','product_image','product_status','product_qty','product_view','price_cost'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function brand()
    {
    	return $this->belongsTo('App\Models\Brand','brand_id');
    }
}
