<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Statistic;
use App\Models\Visitors;
use App\Models\Product;
use App\Models\Admin;
use Carbon\Carbon;
use Mail;

session_start();

class AdminController extends Controller
{

    public function reset_new_pass_ad(Request $request)
    {
        $data = $request->all();
        $token_random = Str::random();
        $admin = Admin::where('admin_email','=',$data['email'])->where('admin_token','=',$data['token'])->get();
        $count = $admin->count();
        if($count>0){
            foreach($admin as $key => $ad){
                $admin_id = $ad->admin_id;
            }
            $reset = Admin::find($admin_id);
            $reset->admin_password = $data['new_pass'];
            $reset->admin_token = $token_random;
            $reset->save();
            return redirect('quen-mat-khau-ad')->with('mess','Cập nhật mật khẩu mới thành công, vui lòng quay lại trang đăng nhập');
        }else{
            return redirect('quen-mat-khau-ad')->with('err','Vui lòng nhập lại Email vì link đã hết hạn');
        }
    }

    public function update_new_pass_ad(Request $request)
    {
        return view('admin.password.new_password_ad');
    }

    public function reset_pass_ad(Request $request)     
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu admin tại Eshopper".' '.$now;
        $admin = Admin::where('admin_email','=', $data['email_admin'])->get();
        foreach ($admin as $key => $value) {
            $admin_id = $value->admin_id;
        }
        if($admin){
            $count_customer = $admin->count();
            if($count_customer==0){
                return redirect()->back()->with('err','Email chưa được đăng ký tại Eshopper');
            }else{
                $token_random = Str::random();
                $admin = Admin::find($admin_id);
                $admin->admin_token = $token_random;
                $admin->save();

                $to_email = $data['email_admin'];//send this email
                $link_reset_pass = url('/update-new-pass-ad?email='.$to_email.'&token='.$token_random);

                $data = array("name"=>$title_mail, "body"=>$link_reset_pass, 'email'=>$data['email_admin']);//send body mail

                Mail::send('admin.password.forget_pass_body', ['data'=>$data], function($message) use ($title_mail, $data)
                {
                    $message->to($data['email'])->subject($title_mail);//send this mail with subject
                    $message->from($data['email'],$title_mail);//send from this mail
                });
                return redirect()->back()->with('mess','Gửi email khôi phục thành công, vui lòng check email.');
            }
        }
    }

    public function quen_mat_khau_ad()
    {
        return view('admin.password.forgot_password_ad');
    }

    // public function send_mail()
    // {
    //     $to_name = "CheckMail";
    //     $to_email = "dotiensang110797@gmail.com";

    //     $data = array("name"=>"Mail từ tài khoản khách hàng", "body"=>'Mail gửi về vấn đề hàng hóa');

    //     Mail::send('pages.send_mail', $data, function ($message) use ($to_name, $to_email)
    //     {
    //         $message->to($to_email)->subject('Quên mật khẩu Admin Thiatv.com');
    //         $message->from($to_email, $to_name);
    //     });
    //     // return redirect('/')->with('message','')
    // }

    public function day_order_30()  
    {
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $get = Statistic::whereBetween('order_date',[$sub30days, $now])->orderBy('order_date','ASC')->get();

        foreach($get as $key => $val) {
            $chart_data[] = array(
            'period' => $val->order_date,
            'order' => $val->total_order,
            'sales' => $val->sales,
            'profit' => $val->profit,
            'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $yesterday = Carbon::yesterday('Asia/Ho_Chi_Minh')->toDateString();
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        // dd($data['dashboard_value']);
        if($data['dashboard_value']=='7ngay'){
            $get = Statistic::whereBetween('order_date', [$sub7days, $now])->orderBy('order_date','ASC')->get();
        }else if($data['dashboard_value']=='homnay'){
            $get = Statistic::whereBetween('order_date', [$now, $now])->orderBy('order_date','ASC')->get();
        }else if($data['dashboard_value']=='homqua'){
            $get = Statistic::whereBetween('order_date', [$yesterday, $now])->orderBy('order_date','ASC')->get();
        }else if($data['dashboard_value']=='thangtruoc'){
            $get = Statistic::whereBetween('order_date', [$dau_thangtruoc, $cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        }else if($data['dashboard_value']=='thangnay'){
            $get = Statistic::whereBetween('order_date', [$dauthangnay, $now])->orderBy('order_date','ASC')->get();
        }else{
            $get = Statistic::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date','ASC')->get();
        }

        foreach ($get as $key => $val) {
            $chart_data[] = array(
            'period' => $val->order_date,
            'order' => $val->total_order,
            'sales' => $val->sales,
            'profit' => $val->profit,
            'quantity' => $val->quantity
            );
        }
        
        echo $data = json_encode($chart_data);

    }

    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();

            foreach ($get as $key => $val) {
                $chart_data[] = array(
                    'period' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity' => $val->quantity
                );
            }
            echo $data = json_encode($chart_data);
    }

    public function index(){
    	return view('admin_login');
    }
    ///////////////////////////////////////////////////////////
    // public function dashboard()
    // {
    // 	return view('admin.dashboard');
    // }
    ///////////////////////////////////////////////////////////

    public function handleLogin(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;
        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();

        if ($result) {
            Session::put('admin_name',$result->admin_name);         
            Session::put('admin_id',$result->admin_id);

            return redirect()->route('admin-home');       
        }else {
            Session::put('messge','Mật khẩu hoặc tài khoản sai'); 
            return redirect()->route('login');
        }

    }

    public function show_dashboard(Request $request)
    {   
            $user_ip_address = $request->ip();
            $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
            $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
            $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
            $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
             //total last month
            $visitors_of_lastmonth = Visitors::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get();
            $visitors_last_month_count = $visitors_of_lastmonth->count();
            //total this month
            $visitors_of_thismonth = Visitors::whereBetween('date_visitor',[$early_this_month,$now])->get();
            $visitors_this_month_count = $visitors_of_thismonth->count();
            //total one year
            $visitors_of_year = Visitors::whereBetween('date_visitor',[$oneyears,$now])->get();
            $visitors_year_count = $visitors_of_year->count();
            //online
            $visitors_current = Visitors::where('ip_address',$user_ip_address)->get();
            $visitor_count = $visitors_current->count();
            //total visitor
            $visitors = Visitors::all();
            $visitor_total = $visitors->count();

            if($visitor_count < 1){
                $visitor = new visitors();
                $visitor->ip_address = $user_ip_address;
                $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                $visitor->save();
            }

            $product_views = Product::orderBy('product_views','DESC')->take(10)->get();

            return view('admin.dashboard')->with(compact('visitors_last_month_count','visitors_this_month_count','visitors_year_count','visitor_total','visitor_count','product_views'));        
        
    }
    ///////////////////////////////////////////////////////////
    public function logout(Request $request)
    {
    	Auth::logout();
    	$request->session()->invalidate();
    	$request->session()->regenerateToken();
    	return redirect()->route('login');
    }
    ///////////////////////////////////////////////////////////
    public function admin_edit(Request $request)
    {
    	
    }

}
