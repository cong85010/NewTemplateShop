<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
    public function unset_coupon()
    {
        $coupon = Session::get('coupon');
       if($coupon == true){
            Session::forget('coupon');
             return redirect()->back()->with('mess','Xóa mã khuyến mãi thành công');
       }
    }

	public function insert_coupon()
	{
		return view('admin.coupon.insert_coupon');
	}

	public function delete_coupon($coupon_id)
	{
		$coupon = Coupon::find($coupon_id);
		$coupon->delete();
		Session::put('mess', 'Xóa mã giảm giá thành công');
    	return Redirect::to('list-coupon');
	}
    
    public function insert_coupon_code(Request $request)
    {
    	$data = $request->all();
    	$coupon= new Coupon;

    	$coupon->coupon_name = $data['coupon_name'];
    	$coupon->coupon_discount = $data['coupon_discount'];
    	$coupon->coupon_time = $data['coupon_time'];
    	$coupon->coupon_condition = $data['coupon_condition'];
    	$coupon->coupon_code = $data['coupon_code'];
    	$coupon->save();

    	Session::put('mess', 'Thêm mã giảm giá thành công');
    	return Redirect::to('insert-coupon');
    }

    public function list_coupon()
    {
    	$coupon = Coupon::orderby('coupon_id','DESC')->paginate(2);
    	return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }
}
