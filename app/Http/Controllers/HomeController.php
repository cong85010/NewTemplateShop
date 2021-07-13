<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();


class HomeController extends Controller
{
    public function index(){

        //slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(3)->get();

    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

    	// $all_product = DB::table('tbl_product')
     	//    ->join('tbl_category_product','tbl_category_product.category_id', '=' , 'tbl_product.category_id')
	    //    ->join('tbl_brand','tbl_brand.brand_id', '=' , 'tbl_product.brand_id')
	    //    ->orderBy('tbl_product.product_id', 'desc')->get();

    	$all_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id', 'desc')->paginate(9);

    	return view('pages.home')->with('category',$cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('slider', $slider);
    } 

    public function search(Request $request)
    {
        $key_words = $request->keywords;
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(3)->get();
        
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$key_words.'%')->where('product_status', '1')->get();

        Session::put('ssKey', $key_words);

        return view('pages.product.search')->with('category',$cate_product)->with('brand', $brand_product)->with('search_product', $search_product)->with('slider', $slider);
    }
}
