<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Statistic;
use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Cart;
use Carbon\Carbon;
session_start();

class OrderController extends Controller
{
	public function view_history_order(Request $request, $order_code)
	{
		if(!Session::get('customer_id')){
			return redirect('login-checkout')->with('err_log','Vui lòng đăng nhập');
		}else{
			
    		
	        //slider
	        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(3)->get();

	    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

	    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

	    	// $all_product = DB::table('tbl_product')
	     	//    ->join('tbl_category_product','tbl_category_product.category_id', '=' , 'tbl_product.category_id')
		    //    ->join('tbl_brand','tbl_brand.brand_id', '=' , 'tbl_product.brand_id')
		    //    ->orderBy('tbl_product.product_id', 'desc')->get();

	    	$all_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id', 'desc')->get();

	    	//xem lich su don hang
	    	$order_detail = OrderDetails::with('product')->where('order_code', $order_code)->get();
			$order = Order::where('order_code',$order_code)->first();
			
				$customer_id = $order->customer_id;
				$shipping_id = $order->shipping_id;
				$order_status = $order->order_status;
			
			$customer = Customer::where('customer_id', $customer_id)->first();
			$shipping = Shipping::where('shipping_id', $shipping_id)->first();

			$order_detail_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

			foreach ($order_detail_product as $key => $order_d) {
				$product_coupon = $order_d->product_coupon;
			}
			if($product_coupon != 'No'){
				$coupon = Coupon::where('coupon_code', $product_coupon)->first();
				$coupon_condition = $coupon->coupon_condition;
				$coupon_discount = $coupon->coupon_discount;
			}else{
				 $coupon_condition = 2;
				 $coupon_discount = 0;
			}
	    	

	    	return view('pages.history.view_history_order')->with('category',$cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('slider', $slider)->with('order_detail', $order_detail)->with('customer', $customer)->with('shipping', $shipping)->with('coupon_condition', $coupon_condition)->with('coupon_discount', $coupon_discount)->with('order', $order)->with('order_status', $order_status);
			}
	}

	public function history(Request $request)
	{
		if(!Session::get('customer_id')){
			return redirect('login-checkout')->with('err_log','Vui lòng đăng nhập');
		}else{
			
    		
	        //slider
	        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(3)->get();

	    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

	    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

	    	$all_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id', 'desc')->get();

	    	$order = Order::where('customer_id',Session::get('customer_id'))->orderby('created_at','DESC')->paginate(4);

	    	return view('pages.history.history')->with('category',$cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('slider', $slider)->with('order', $order);
			}
	}

	public function update_qty(Request $request)
	{
		$data = $request->all();
		$order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_details->product_sale_qty = $data['order_qty'];
		$order_details->save();
	}
	public function update_order_qty(Request $request)
	{
		//update tinh trang order
		$data = $request->all();
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();
		$order_date = $order->order_date;
		$statistic = Statistic::where('order_date', $order_date)->get();
		if($statistic){
			$statistic_count = $statistic->count();
		}else{
			$statistic_count = 0;
		}
		if($order->order_status==2){
			$total_order = 0;
			$sales = 0;
			$profit =0;
			$quantity = 0;
			foreach($data['order_product_id'] as $key => $product_id){
				$product = Product::find($product_id);
				$product_qty = $product->product_qty;
				$product_sold = $product->product_sold;

				$product_price = $product->product_price;
				$product_cost = $product->product_cost;
				$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
				foreach($data['quantity'] as $key2 => $qty){
					if($key == $key2){
						$pro_remain = $product_qty - $qty;
						$product->product_qty = $pro_remain;
						$product->product_sold = $product_sold + $qty;
						$product->save();
						//update doanh thu
						$quantity += $qty;
						$total_order +=1;
						$sales+=$product_price*$qty;
						$profit += ($product_price*$qty)-($product_cost*$qty);
					}
				}

			}
			
				if($statistic_count>0){
					$statistic_update = Statistic::where('order_date',$order_date)->first();
					$statistic_update->sales = $statistic_update->sales + $sales;
					$statistic_update->profit = $statistic_update->profit + $profit;
					$statistic_update->quantity = $statistic_update->quantity + $quantity;
					$statistic_update->total_order = $statistic_update->total_order + $total_order;
					$statistic_update->save();
				}else{
					$statistic_new = new Statistic();
					$statistic_new->order_date = $order_date;
					$statistic_new->sales = $sales;
					$statistic_new->profit = $profit;
					$statistic_new->quantity = $quantity;
					$statistic_new->total_order = $total_order;
					$statistic_new->save();
				}
		}elseif($order->order_status==3){
			foreach($data['order_product_id'] as $key => $product_id){
				$product = Product::find($product_id);
				$product_qty = $product->product_qty;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
					if($key == $key2){
						$pro_remain = $product_qty + $qty;
						$product->product_qty = $pro_remain;
						$product->product_sold = $product_sold - $qty;
						$product->save();
					}
				}

			}
		}else{
		}
	}

	public function print_order($checkout_code)
	{
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		return $pdf->stream();
	}

	public function print_order_convert($checkout_code)
	{
		$order_detail = OrderDetails::where('order_code', $checkout_code)->get();
		$order = Order::where('order_code',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = Customer::where('customer_id', $customer_id)->first();
		$shipping = Shipping::where('shipping_id', $shipping_id)->first();
		$order_detail_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();
		
		foreach ($order_detail_product as $key => $order_d) {
			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'No'){
			$coupon = Coupon::where('coupon_code', $product_coupon)->first();
			
			$coupon_condition = $coupon->coupon_condition;
			$coupon_discount = $coupon->coupon_discount;
			
			if($coupon_condition==1){
				$coupon_echo = $coupon_discount.'%';
			}elseif($coupon_condition==0){
				$coupon_echo = number_format($coupon_discount,0,',','.').' VNĐ';
			}
		}else{
			 $coupon_condition = 2;
			 $coupon_discount = 0;

			 
				$coupon_echo = '0';
		}

		$output = '';

		$output.='
		<style> body{ 
			font-family: DejaVu Sans; 
		}

		.table-styling{
			margin:auto;
			border:1px solid #000;

		}
		.table-styling tr td{
			border:1px solid #000;
		}
		</style>

		<h2><center> Shop đồ gia dụng cao cấp GTO </center></h2>
		<h3><center> Hóa đơn bán hàng </center></h3>
		<p> Người đặt hàng: </p>
		<table class="table-styling" style="width: 100%">
			<thead>
				<tr>
					<th width="30%"> Tên KH </th>
					<th width="30%"> Số điện thoại đặt </th>
					<th width="40%"> Email </th>
					<th width="15%"> Mã đơn </th>
				</tr>

			</thead>
			<tbody>'; 

		$output.='
				<tr> 
					<td width="30%"> '.$customer->customer_name.' </td>
					<td width="20%"> '.$customer->customer_phone.' </td>
					<td width="40%"> '.$customer->customer_email.' </td>
					<td width="10%"> '.$checkout_code.' </td>
				</tr>';
		$output.='
			</tbody>
		</table>

		<p> Thông tin nhận hàng: </p>
		<table class="table-styling"  style="width: 100%">
			<thead>
				<tr>
					<th width="25%"> Tên người nhận </th>
					<th width="25%"> Số điện thoại </th>
					<th width="30%"> Email </th>
					<th width="40%"> Ghi chú </th>
				</tr>

			</thead>
			<tbody>'; 

		$output.='
				<tr> 
					<td width="30%"> '.$shipping->shipping_name.' </td>
					<td width="25%"> '.$shipping->shipping_phone.' </td>
					<td width="30%"> '.$shipping->shipping_email.' </td>
					<td width="40%"> '.$shipping->shipping_notes.' </td>
				</tr>';
		$output.='
			</tbody>
		</table>

		<p> Chi tiết đơn hàng: </p>
		<table class="table-styling"  style="width: 100%">
			<thead>
				<tr>
					<th> Tên sản phẩm </th>
					<th> Số lượng </th>
					<th> Mã giảm giá </th>
					<th> Giá sản phẩm </th>
					<th> Thành tiền </th>
				</tr>

			</thead>
			<tbody>'; 
			
			$total = 0;
			foreach($order_detail_product as $key => $product){
				$subtotal = $product->product_price*$product->product_sale_qty;
				$total += $subtotal;
				if($product->product_coupon!='No'){
					$product_coupon = $product->product_coupon;
				}else{
					$product_coupon = 'Không áp dụng';
				}
		$output.='
				<tr> 
					<td> '.$product->product_name.' </td>
					<td> '.$product->product_sale_qty.' </td>
					<td> '.$product_coupon.' </td>
					<td> '.number_format($product->product_price,0,',','.').' VNĐ'.' </td>
					<td> '.number_format($subtotal,0,',','.').' VNĐ'.' </td>
				</tr>';
			}

			if($coupon_condition==1){
				$total_after_coupon = ($total*$coupon_discount)/100;

                $total_coupon = $total-$total_after_coupon;
			}else{

                $total_coupon = $total-$coupon_discount;
			}

		$output.='<tr>
			<td colspan="6" style="text-align: right">
				
				<p>Tổng giảm: '.$coupon_echo.'</p>
				<p>Thanh toán: '.number_format($total_coupon,0,',','.').' VNĐ'.'</p>
			</td>
		</tr>';
		$output.='
			</tbody>
		</table>

		<p style="text-align: right;"> GTO-shop, ngày ... , tháng ... , năm . . . : </p>
		<table style="width: 100%">
			<thead>
				<tr>
					<th width="400px"> </th>
					<th> Người lên đơn </th>
				</tr>

			</thead>
			<tbody>'; 

		$output.='
				<tr colspan="2"> 
					<td> </td>
					<td> </td>
				</tr>';
		$output.='
			</tbody>
		</table>
		';

		return $output;
	}

	public function view_order($order_code)
	{
		$order_detail = OrderDetails::with('product')->where('order_code', $order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
		}
		$customer = Customer::where('customer_id', $customer_id)->first();
		$shipping = Shipping::where('shipping_id', $shipping_id)->first();

		$order_detail_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

		foreach ($order_detail_product as $key => $order_d) {
			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'No'){
			$coupon = Coupon::where('coupon_code', $product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_discount = $coupon->coupon_discount;
		}else{
			 $coupon_condition = 2;
			 $coupon_discount = 0;
		}
		return view('admin.view_order')->with(compact('order_detail','customer','shipping','order_detail_product','coupon_condition','coupon_discount','order','order_status'));
	}
    public function manage_order()
    {
    	$order = Order::orderby('created_at','DESC')->paginate(4);
    	return view('admin.manage_order')->with(compact('order'));
    }
}
