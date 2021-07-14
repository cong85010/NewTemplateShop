<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Coupon;
use App\Models\OrderDetails;
use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Cart;
use Mail;
use Carbon\Carbon;
session_start();

class CheckoutController extends Controller //neu muon them phi van chuyen nho phai xoa session sau khi dat hang o phan confirm order
{

    public function reset_new_pass(Request $request)
    {
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->get();
        $count = $customer->count();
        if($count>0){
            foreach($customer as $key => $cus){
                $customer_id = $cus->customer_id;
            }
            $reset = Customer::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('quen-mat-khau')->with('mess','Cập nhật mật khẩu mới thành công');
        }else{
            return redirect('quen-mat-khau')->with('err','Vui lòng nhập lại Email vì link đã hết hạn');
        }
    }

    public function update_new_pass(Request $request)
    {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();
        return view('pages.checkout.new_pass')->with('category', $cate_product)->with('brand', $brand_product)->with('slider', $slider);
    }

    public function reset_pass(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu tại Eshopper".' '.$now;
        $customer = Customer::where('customer_email','=', $data['email_account'])->get();
        foreach ($customer as $key => $value) {
            $customer_id = $value->customer_id;
        }
        if($customer){
            $count_customer = $customer->count();
            if($count_customer==0){
                return redirect()->back()->with('err','Email chưa được đăng ký tại Eshopper');
            }else{
                $token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();

                $to_email = $data['email_account'];//send this email
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);

                $data = array("name"=>$title_mail, "body"=>$link_reset_pass, 'email'=>$data['email_account']);//send body mail

                Mail::send('pages.checkout.forget_pass_body', ['data'=>$data], function($message) use ($title_mail, $data)
                {
                    $message->to($data['email'])->subject($title_mail);//send this mail with subject
                    $message->from($data['email'],$title_mail);//send from this mail
                });
                return redirect()->back()->with('mess','Gửi email khôi phục thành công, vui lòng check email.');
            }
        }
    }

    public function quen_mat_khau(Request $request)
    {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();
        return view('pages.checkout.forget_password')->with('category', $cate_product)->with('brand', $brand_product)->with('slider', $slider);
    }

    public function confirm_order(Request $request)
    {

        $data = $request->all();
            
        $coupon = Coupon::where('coupon_code',$data['order_coupon'])->first();
        if ($coupon) {
            $coupon->coupon_used = $coupon->coupon_used.','.Session::get('customer_id');
            $coupon->coupon_time = $coupon->coupon_time - 1;
            $coupon->save(); 
        }
    
        //lay thong tin nguoi nhan hang
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->created_at = $today;
        $order->order_date = $order_date;
        $order->save();

        
        if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails();
                $order_details->order_code = $checkout_code ;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sale_qty = $cart['product_quantity'];
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->save();
            }
        }
        Session::forget('coupon');
        Session::forget('cart');
    }

    public function login_checkout()
    {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(4)->get();
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

    	return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product)->with('slider', $slider);
    }

    public function add_customer(Request $request)
    {
        
        $this->validate($request, [
            'customer_name' => 'required| min: 6', 
            'customer_email' => 'email|unique:tbl_customers',
            'customer_password' => 'required| min: 6',
            'customer_phone' => 'required|regex:/^[0]+[0-9]{9}$/|unique:tbl_customers',
        ],[
            'required' => 'Vui lòng không để trống trường này',
            'min' => 'Vui lòng nhập ít nhất 6 ký tự',
            'customer_phone.regex' => 'Số điện thoại không hợp lệ',
            'email' => 'Email không hợp lệ',
            'customer_email.unique' => 'Email đã được sử dụng, vui lòng sử dụng Email khác',
            'customer_phone.unique' => 'Số đã được sử dụng, vui lòng sử dụng số khác',
        ]);
    	$data = array(); 
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
    	$data['customer_phone'] = $request->customer_phone;
            
        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        Session::put('succ', 'Tạo tài khoản thành công');
        return Redirect('/login-checkout');
        

    }

    public function checkout()
    {
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(4)->get();
    	return view('pages.checkout.show-checkout')->with('category', $cate_product)->with('brand', $brand_product)->with('slider', $slider);
    }

    public function save_checkout_customer(Request $request)
    {
        $this->validate($request, [
            'shipping_name' => 'required| min: 6', 
            'shipping_email' => 'email',
            'shipping_address' => 'required| min: 6',
            'shipping_phone' => 'required|regex:/^[0]+[0-9]{9}$/',
        ],[
            'required' => 'Vui lòng không để trống trường này',
            'min' => 'Vui lòng nhập ít nhất 6 ký tự',
            'shipping_address.min' => 'Vui lòng điền đầy đủ thông tin Phường, Xã, Quận, Huyện,Tỉnh, Thành',
            'shipping_phone.regex' => 'Số điện thoại không hợp lệ',
            'email' => 'Email không hợp lệ',
        ]);
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_notes'] = $request->shipping_notes;
    	$data['shipping_address'] = $request->shipping_address;
    	$data['shipping_phone'] = $request->shipping_phone;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	Session::put('shipping_id', $shipping_id);
    	return Redirect('/payment');
    }

    public function payment()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();
    	return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function order(Request $request)
    {
        //isert phuong thuc thanh toan
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert oder details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sale_qty'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);  
        }
        if($data['payment_method'] == 1){
             $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();
            return view('pages.checkout.payment_chuyen_khoan')->with('category', $cate_product)->with('brand', $brand_product);

        } else if($data['payment_method'] == 2){
            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();
            return view('pages.checkout.finish_order')->with('category', $cate_product)->with('brand', $brand_product);

        } else{
            echo "Đang nâng cấp";
        }
 
        // return Redirect('/payment');
    }

    public function finish_order()
    {
            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();
            Cart::destroy();
            return view('pages.checkout.finish_order')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function logout_checkout()
    {
    	Session::flush();
    	return Redirect('/');
    }

    public function login_customer(Request $request)
    {
        $this->validate($request, [
            'email_account' => 'email',
            'password_account' => 'required| min: 6'
        ],[
            'required' => 'Vui lòng không để trống trường này',
            'min' => 'Vui lòng nhập ít nhất 6 ký tự',
            'email' => 'Email không hợp lệ'
        ]);
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(4)->get();
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
        if($result){
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            return Redirect::to('/');
        } else{
            Session::put('err_log','Sai tên đăng nhập hoặc mật khẩu');
        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product)->with('slider', $slider);
        
    }
}

    public function manage_order()
    {
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id', '=' , 'tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name','tbl_customers.customer_id')
        ->orderBy('tbl_order.order_id', 'desc')->get();
        $manage_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manage_order);
    }

    public function view_order($orderId)
    {
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id', '=' , 'tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id', '=' , 'tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id', '=' , 'tbl_order_details.order_id')->where('tbl_order.order_id', $orderId)
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->get();
        $manage_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order',$manage_order_by_id);
    }

    public function profile_customer($customer_id)
    {
        if(!Session::get('customer_id')){
            return redirect('login-checkout')->with('err_log','Vui lòng đăng nhập');
        }else{
            //slider
            $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(3)->get();

            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

            $all_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id', 'desc')->get();

            $edit_customer = DB::table('tbl_customers')->where('customer_id',$customer_id)->get();
            return view('pages.customers.profile_customer')->with('category',$cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('slider', $slider)->with('edit_customer', $edit_customer);
        }
    }

    public function update_customer(Request $request, $customer_id)
    {
        //slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(3)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id', 'desc')->get();
        $confirm = $request->confirm_password;
        $password = Customer::where('customer_id',$customer_id)->first();
        $password = $password->customer_password;
        $data = array();
        $data['customer_name'] = $request->firstname;
        $data['customer_email'] = $request->email;
        $data['customer_phone'] = $request->phone;
        if($confirm == $password){
            DB::table('tbl_customers')->where('customer_id', $customer_id)->update($data);
            // Session::put('messge','Cập nhật thông tin thành công');
            return Redirect::back()->with('messge', 'Cập nhật thông tin thành công');
        } else if($confirm != $password){
            // Session::put('messge','Vui lòng xác nhận lại chính xác mật khẩu');
            return Redirect::back()->with('messge', 'Vui lòng xác nhận lại chính xác mật khẩu');
        }
        
    }
}
