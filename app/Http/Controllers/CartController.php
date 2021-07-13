<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use App\Models\Slider;
use Cart;
session_start();

class CartController extends Controller
{
    public function check_coupon(Request $request)
    {
        $data = $request->all();
        if(Session::get('customer_id')){
             $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_used','LIKE','%'.Session::get('customer_id').'%')->first();
             if($coupon){
                return redirect()->back()->with('err', 'Mỗi mã giảm giá chỉ áp dụng được cho 1 đơn hàng, mã giảm giá này bạn đã sử dụng. Vui lòng nhập mã khác, xin cảm ơn!');
             }else{
                $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
                $coupon_time = 0;
                if ($coupon) {
                    $coupon_time = $coupon->coupon_time;       
                }
                if($coupon_time <= 0){
                    return redirect()->back()->with('err', 'Mã giảm giá sai hoặc không tồn tại');
                }
                else if($coupon==true){
                    $count_coupon = $coupon->count();
                    if($count_coupon>0){
                        $coupon_session = Session::get('coupon');
                        if($coupon_session==true){
                            $is_avaiable = 0;
                            if($is_avaiable == 0){
                                $cou[] = array(
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_condition' => $coupon->coupon_condition,
                                    'coupon_discount' => $coupon->coupon_discount,
                                );
                                Session::put('coupon', $cou);
                            }
                        }else{
                             $cou[] = array(
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_condition' => $coupon->coupon_condition,
                                    'coupon_discount' => $coupon->coupon_discount,
                                );
                                Session::put('coupon', $cou);
                        }
                        Session::save();
                        return redirect()->back()->with('mess', 'Thêm mã giảm giá thành công');
                    }
                }else{
                    return redirect()->back()->with('err', 'Mã giảm giá sai hoặc không tồn tại');
                }
                 }
            }else{
                $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
                $coupon_time = 0;
                if ($coupon) {
                    $coupon_time = $coupon->coupon_time;       
                }
                if($coupon_time <= 0){
                    return redirect()->back()->with('err', 'Mã giảm giá sai hoặc không tồn tại');
                }
                else if($coupon==true){
                    $count_coupon = $coupon->count();
                    if($count_coupon>0){
                        $coupon_session = Session::get('coupon');
                        if($coupon_session==true){
                            $is_avaiable = 0;
                            if($is_avaiable == 0){
                                $cou[] = array(
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_condition' => $coupon->coupon_condition,
                                    'coupon_discount' => $coupon->coupon_discount,
                                );
                                Session::put('coupon', $cou);
                            }
                        }else{
                             $cou[] = array(
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_condition' => $coupon->coupon_condition,
                                    'coupon_discount' => $coupon->coupon_discount,
                                );
                                Session::put('coupon', $cou);
                        }
                        Session::save();
                        return redirect()->back()->with('mess', 'Thêm mã giảm giá thành công');
                    }
                }else{
                    return redirect()->back()->with('err', 'Mã giảm giá sai hoặc đã hết hạn');
                }
            }
        
        
    }

    public function show_cart_ajax(Request $request)
    {
        $meta_desc = "Giỏ hàng của bạn";
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(4)->get();
        return view('pages.cart.cart_ajax')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider', $slider);
    }
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $sl_dathang = $data['cart_product_quantity'];
        if($sl_dathang == null){
            $sl_dathang = 1;
        }
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id'=> $session_id,
                'product_name'=> $data['cart_product_name'],
                'product_id'=> $data['cart_product_id'],
                'product_image'=> $data['cart_product_image'],
                'product_quantity'=> $data['cart_product_quantity'],
                'product_qty'=> $data['cart_product_qty'],
                'product_price'=> $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id'=> $session_id,
                'product_name'=> $data['cart_product_name'],
                'product_id'=> $data['cart_product_id'],
                'product_image'=> $data['cart_product_image'],
                'product_quantity'=> $data['cart_product_quantity'],
                'product_qty'=> $data['cart_product_qty'],
                'product_price'=> $data['cart_product_price'],
            );
            Session::put('cart',$cart);
        }  
        
        Session::save();

    }

    public function delete_product_cart($session_id)
    {
        $cart = Session::get('cart');
        // echo "<pre>";
        // print_r($cart);
        // echo "</pre>";    
        if($cart == true){
            foreach($cart as $key => $val){
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('mess','Xóa thành công sản phẩm');
        }else{
            return redirect()->back()->with('mess','Xóa sản phẩm không thành công');
        }
    }

    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;
                    if($val['session_id'] == $key && $qty < $cart[$session]['product_qty']){

                        $cart[$session]['product_quantity'] = $qty;


                        $message.='<p style="color:green">'.$i.') Cập nhật số lượng '.$cart[$session]['product_name'].' Thành công</p>';

                    }elseif($val['session_id'] == $key && $qty > $cart[$session]['product_qty']){


                        $message.='<p style="color:red">'.$i.') Cập nhật số lượng '.$cart[$session]['product_name'].' Thất bại, số lượng trong kho không đáp ứng đủ</p>';

                    }
                }
            }
            Session::put('cart',$cart);
             return redirect()->back()->with('mess',$message);
        }else{
             return redirect()->back()->with('mess','Cập nhật số lượng sản phẩm không thành công');
        }
    }

    public function delete_all_cart()        
    {
       
    }

    public function save_cart(Request $request)
    {
    	

    	$productId = $request->productid_hidden;
    	$quantity = $request->qty;
		$product_info = $cate_product = DB::table('tbl_product')->where('product_id', $productId)->first();

        // Cart::destroy();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        return Redirect::to('/show-cart');
    }

    public function show_cart()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();
        $content = Cart::content();
        foreach($content as $v_content){
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=' , 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=' , 'tbl_product.brand_id')->where('tbl_product.product_id', $v_content->id)->get();
    }
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product)->with('details_product', $details_product);
    }

    public function delete_to_cart($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }

    public function update_cart_qty(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}
