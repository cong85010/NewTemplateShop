<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Brand;
use Session;
use App\Http\Requests;
use App\Models\Slider;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();

class BrandProduct extends Controller
{
     public function add_brand()
    {
    	return view('admin.add_brand');
    }

    public function all_brand()
    {
    	// $all_brand= DB::table('tbl_brand')->get();
        $all_brand = Brand::orderBy('brand_id', 'DESC')->paginate(4);
        // lay theo brand id tu cao xuong thap
    	$manager_brand = view('admin.all_brand')->with('all_brand',$all_brand);
    	return view('admin_layout')->with('admin.all_brand',$manager_brand);
    }
    
    public function save_brand_product(Request $request)
    {
         $this->validate($request, [
            'brand_name' => 'required| min: 3', 
            'brand_decs' => 'required| min: 3'
        ],[
            'required' => 'Vui lòng không để trống trường này',
            'min' => 'Vui lòng nhập ít nhất 3 ký tự'
        ]);

        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_desc = $data['brand_decs'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();
    	// $data = array();
    	// $data['brand_name'] = $request->brand_name;
    	// $data['brand_desc'] = $request->brand_decs;
    	// $data['brand_status'] = $request->brand_status;
    	// DB::table('tbl_brand')->insert($data);

    	Session::put('messge','Thêm thành công');
    	return redirect()->route('add_brand');
    }

    public function active_brand($id_active)
    {
        DB::table('tbl_brand')->where('brand_id',$id_active)->update(['brand_status'=>1]);
        Session::put('messge','Hiển thị thương hiệu thành công');
        return redirect()->route('all_brand');
    }

    public function unactive_brand($id_unactive)
    {
        DB::table('tbl_brand')->where('brand_id',$id_unactive)->update(['brand_status'=>0]);
        Session::put('messge','Ẩn hiệu thành công');
        return redirect()->route('all_brand');
    }

    public function edit_brand($id_edit)
    {
        // $edit_brand = DB::table('tbl_brand')->where('brand_id',$id_edit)->get();
        $edit_brand = Brand::where('brand_id',$id_edit)->get();
        $manager_brand = view('admin.edit_brand')->with('edit_brand',$edit_brand);
        return view('admin_layout')->with('admin.edit_brand',$manager_brand);
    }

    public function update_brand(Request $request, $id_update) 
    {
        $this->validate($request, [
            'brand_name' => 'required| min: 3', 
            'brand_decs' => 'required| min: 3'
        ],[
            'required' => 'Vui lòng không để trống trường này',
            'min' => 'Vui lòng nhập ít nhất 3 ký tự'
        ]);
        $data = $request->all();
        $brand = Brand::find($id_update);
        $brand->brand_name = $data['brand_name'];
        $brand->brand_desc = $data['brand_decs'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request->brand_name;
        // $data['brand_desc'] = $request->brand_decs;
        // $data['brand_status'] = $request->brand_status;
        // DB::table('tbl_brand')->where('brand_id', $id_update)->update($data);
        Session::put('messge','Cập nhật thương hiệu thành công');
        return redirect()->route('all_brand');
    }
//ffkkfkffk //gjgjgjgjgj
    public function delete_brand($id_delete)
    {
        DB::table('tbl_brand')->where('brand_id', $id_delete)->delete();
        Session::put('messge', 'Xóa thương hiệu thành công');
        return redirect()->route('all_brand');
    }

    //END function ADMIN

    public function show_brand_home($brand_id, Request $request)
    {
        // $start_price = $request->start_price ?? null;
        // $end_price = $request->end_price ?? null;
        // $fillter_price = $request->fillter_price ?? false;
// dd($request->all());
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id', $brand_id)->limit(1)->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(4)->get();

        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->paginate(9);

        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $max_price_range = $max_price + 500000;


        // foreach($brand_by_id as $key => $bra){
        //     $brand_by_id = $bra->category_id;
        // }//

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_price','DESC')->paginate(6)->appends(request()->query());
                 // 
            }else if($sort_by=='tang_dan'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_price','ASC')->paginate(6)->appends(request()->query());
            }else if($sort_by=='kytu_za'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_name','DESC')->paginate(6)->appends(request()->query());
            }else if($sort_by=='kytu_za'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_name','ASC')->paginate(6)->appends(request()->query());
            }

            else{
            $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_id','DESC')->paginate(6);
            }
        }
        if(isset($_GET['start_price']) && isset($_GET['end_price'])) {
                $min_price = $_GET['start_price'];
                $max_price = $_GET['end_price'];
                $brand_by_id = Product::with('brand')->whereBetween('product_price', [$min_price,$max_price])->where('brand_id',$brand_id)->orderBy('product_price','ASC')->paginate(6)->appends(request()->query());
            }
        

        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name)->with('slider', $slider)->with('min_price', $min_price)->with('max_price', $max_price)->with('max_price_range', $max_price_range);
    }

    public function search_brand_admin(Request $request)
    {
        $key_words = $request->keywords;

        $search_brand = Brand::orderBy('brand_id', 'DESC')->where('brand_name','like','%'.$key_words.'%')->orderBy('tbl_brand.brand_id', 'desc')->paginate(5);

        Session::put('ssKey', $key_words);

        return view('admin.search_brand_admin')->with('search_brand', $search_brand);
    }
}
