<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Gallery;
use File;
use App\Exports\ExportProduct;
use App\Imports\ImportProduct; 
session_start();

class ProductController extends Controller
{

    public function import_csv_product(Request $request)
    {   
        
        if($request->file('file')){
            $path = $request->file('file')->getRealPath();  
            Excel::import(new ImportProduct, $path);
            return back();
        }else{
            Session::put('err','Lỗi! Không có file được chọn, vui lòng chọn file muốn nhập');
            return back();
        }
        
    }

    public function export_csv_product()
    {
        return Excel::download(new ExportProduct, 'product.xlsx');
    }

     public function add_product()
    {
    	$cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
    	$brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();
    	return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product', $brand_product);
    }

    public function all_product()
    {
    	$all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=' , 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=' , 'tbl_product.brand_id')
        ->orderBy('tbl_product.product_id', 'desc')->paginate(5);
    	$manager_product = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    
    public function save_product(Request $request)
    {

        $this->validate($request, [
            'product_name' => 'required| min: 3', 
            'product_price' => 'required', 
            'product_qty' => 'required', 
            'product_image' => 'required',
            'product_cost' => 'required',
            'product_content' => 'required| min: 3'
        ],[
            'required' => 'Vui lòng không để trống trường này',
            'min' => 'Vui lòng nhập ít nhất 3 ký tự',
            'integer' => 'Vui lòng nhập nhập ký tự số',
        ]);
    	$data = array();
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $product_cost = filter_var($request->product_cost, FILTER_SANITIZE_NUMBER_INT);
    	$data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_decs;
        $data['product_status'] = $request->product_status;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $product_price;
        $data['product_cost'] = $product_cost;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_image;
        $data['product_qty'] = $request->product_qty;
        $get_image = $request->file('product_image');

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';

        if($get_image){
           $get_name_image = $get_image->getClientOriginalName();
           $name_image = current(explode('.',$get_name_image));
           $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           $get_image->move($path, $new_image);
           File::copy($path.$new_image,$path_gallery.$new_image);
           $data['product_image'] = $new_image;
           
        } 
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
        Session::put('messge','Thêm sản phẩm thành công');
        return redirect()->route('add_product'); 
        
    	
    }

    public function active_product($id_active)
    {
        DB::table('tbl_product')->where('product_id',$id_active)->update(['product_status'=>1]);
        Session::put('messge','Hiển thị sản phẩm thành công');
        return redirect()->route('all_product');
    }

    public function unactive_product($id_unactive)
    {
        DB::table('tbl_product')->where('product_id',$id_unactive)->update(['product_status'=>0]);
        Session::put('messge','Ẩn sản phẩm thành công');
        return redirect()->route('all_product');
    }

    public function edit_product($id_edit)
    {
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$id_edit)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }

    public function update_product(Request $request, $id_update) 
    {
        // dd(111);
        // dd($request->all());
        $this->validate($request, [
            'product_name' => 'required| min: 3', 
            'product_price' => 'required', 
            'product_cost' => 'required', 
            'product_qty' => 'required', 
            // 'product_image' => 'required', 
            'product_content' => 'required| min: 3'
        ],[
            'required' => 'Vui lòng không để trống trường này',
            'min' => 'Vui lòng nhập ít nhất 3 ký tự'
        ]);
        $data = array();
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $product_cost = filter_var($request->product_cost, FILTER_SANITIZE_NUMBER_INT);
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_decs;
        $data['product_status'] = $request->product_status;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $product_price;
        $data['product_cost'] = $product_cost;
        $data['product_qty'] = $request->product_qty;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
           $get_name_image = $get_image->getClientOriginalName();
           $name_image = current(explode('.',$get_name_image));
           $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('public/uploads/product', $new_image);
           $data['product_image'] = $new_image;
           DB::table('tbl_product')->where('product_id', $id_update)->update($data);
            Session::put('messge','Cập nhật sản phẩm thành công');
            return redirect()->route('all_product'); 
        } 
           DB::table('tbl_product')->where('product_id', $id_update)->update($data);
            Session::put('messge','Cập nhật sản phẩm thành công');
            return redirect()->route('all_product'); 
}

    public function delete_product($id_delete)
    {
        DB::table('tbl_product')->where('product_id', $id_delete)->delete();
        Session::put('messge', 'Xóa sản phẩm thành công');
        return redirect()->route('all_product');
    }

    //END FUNCTION ADMIN

//     public function details_product($product_id)
//     {
//         $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

//         $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

//         $details_product = DB::table('tbl_product')
//         ->join('tbl_category_product','tbl_category_product.category_id', '=' , 'tbl_product.category_id')
//         ->join('tbl_brand','tbl_brand.brand_id', '=' , 'tbl_product.brand_id')
//         ->where('tbl_product.product_id', $product_id)->get();
// dd($details_product->toArray());
//         return view('pages.product.show_details')->with('category',$cate_product)->with('brand', $brand_product)->with('details_product', $details_product);
//     }

    public function details_product($product_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(4)->get();

        

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=' , 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=' , 'tbl_product.brand_id')
        ->where('tbl_product.product_id', $product_id)->get();
        $details_product->map(function ($item) {
            $item->product_content = str_replace(["\r", "\n", "\r\n"], "<br />", $item->product_content);
            $item->brand_desc = str_replace(["\r", "\n", "\r\n"], "<br />", $item->brand_desc);
            return $item;
        });

        foreach ($details_product as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
        };
        //lay thu vien hinh anh dua theo product_id
        $gallery = Gallery::where('product_id', $product_id)->get();

        //update views
        $product = Product::where('product_id', $product_id)->first();
        $product->product_views = $product->product_views+1;
        $product->save();
        
        $related_product = DB::table('tbl_product') //lay theo danh muc
        ->join('tbl_category_product','tbl_category_product.category_id', '=' , 'tbl_product.category_id')
        ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->limit(10)->get();

        foreach ($details_product as $key => $value2){
            $brand_id = $value->brand_id;
        };

        $related_product2 = DB::table('tbl_product') //lay theo thuong hieu
        ->join('tbl_brand','tbl_brand.brand_id', '=' , 'tbl_product.brand_id')
        ->where('tbl_brand.brand_id', $brand_id)->whereNotIn('tbl_product.product_id', [$product_id])->limit(10)->get();

        return view('pages.product.show_details')->with('category',$cate_product)->with('brand', $brand_product)->with('slider', $slider)->with('details_product', $details_product)->with('relate', $related_product)->with('relate2', $related_product2)->with('gallery', $gallery);
    }

    public function update_qty()
    {
        $data1 = DB::table('tbl_product')->where('product_qty');
        dd($data1);
    }

    public function search_pro_admin(Request $request)
    {
        $key_words = $request->keywords;

        $search_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=' , 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=' , 'tbl_product.brand_id')->where('product_name','like','%'.$key_words.'%')->orderBy('tbl_product.product_id', 'desc')->paginate(5);

        Session::put('ssKey', $key_words);

        return view('admin.search_pro_admin')->with('search_product', $search_product);
    }
}
