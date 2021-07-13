<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false; //set thoi gian, creeat at ...
    protected $fillable = [
    	'admin_email', 'admin_password', 'admin_password','admin_phone','admin_images','admin_token'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';


}
