<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();


class Profile_Admin extends Controller
{
    public function profile_admin($id_admin)
    {
    	$edit_admin = DB::table('tbl_admin')->where('admin_id',$id_admin)->get();
        $manager_admin = view('admin.profile_admin')->with('edit_admin',$edit_admin);
        return view('admin_layout')->with('admin.profile_admin',$manager_admin);
    }

    public function update_admin(Request $request, $customer_id)
    {
    	$data = array();
        $data['admin_name'] = $request->firstname;
        $data['admin_email'] = $request->email;
        $data['admin_password'] = $request->password;
        $data['admin_phone'] = $request->phone;
        $password = $request->password;
        $confirm = $request->confirm_password;
        if($confirm == $password){
        	DB::table('tbl_admin')->where('admin_id', $id_admin)->update($data);
        	Session::put('messge','Cập nhật thông tin thành công');
        	return redirect()->route('profile_admin',['id_admin'=> $id_admin]);
        } else{
        	Session::put('messge','Vui lòng xác nhận lại chính xác mật khẩu');
        	return redirect()->route('profile_admin',['id_admin'=> $id_admin]);
        }
        
    }
}
