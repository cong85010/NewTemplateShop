<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false; //set thoi gian, creeat at ...
    protected $fillable = [
    	'category_name', 'category_desc', 'brand_status'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

}
