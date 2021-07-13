<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Category;
use App\Models\CategoryProductModel;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use App\Models\Slider;
use Excel;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();

class CategoryProduct extends Controller
{

    public function import_csv(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
    }

    public function export_csv()
    {
        return Excel::download(new ExcelExports, 'category_product.xlsx');
    }
    
    public function add_category_product()
    {
        $category = CategoryProductModel::where('category_parent', 0)->orderBy('category_id','DESC')->get();
    	return view('admin.add_category_product')->with(compact('category'));
    }

    public function all_category_product()
    {   
        $category_product = CategoryProductModel::where('category_parent', 0)->orderBy('category_id','DESC')->get();
        $all_category = Category::orderBy('category_parent', 'DESC')->paginate(4);
    	// $all_category = DB::table('tbl_category_product')->get();
    	$manager_category = view('admin.all_category_product')->with('all_category',$all_category)->with('category_product',$category_product);
    	return view('admin_layout')->with('admin.all_category_product',$manager_category);
    }
    
    public function save_category_product(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required| min: 3', 
            'category_decs' => 'required| min: 3'
        ],[
            'required' => 'Vui lòng không để trống trường này',
            'min' => 'Vui lòng nhập ít nhất 3 ký tự'
        ]);
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_decs'];
        $category->category_status = $data['category_status'];
        $category->category_parent = $data['category_parent'];
        $category->save();

    	// $data = array();
    	// $data['category_name'] = $request->category_name;
    	// $data['category_desc'] = $request->category_decs;
    	// $data['category_status'] = $request->category_status;
    	// DB::table('tbl_category_product')->insert($data);
    	Session::put('messge','Thêm thành công');
    	return redirect()->route('all_category');
    }

    public function active_category($id_active)
    {
        DB::table('tbl_category_product')->where('category_id',$id_active)->update(['category_status'=>1]);
        Session::put('messge','Hiển thị danh mục thành công');
        return redirect()->route('all_category');
    }

    public function unactive_category($id_unactive)
    {
        DB::table('tbl_category_product')->where('category_id',$id_unactive)->update(['category_status'=>0]);
        Session::put('messge','Ẩn danh mục thành công');
        return redirect()->route('all_category');
    }

    public function edit_category_product($id_edit)
    {
        $edit_category_product = Category::where('category_id',$id_edit)->get();
        // $edit_category_product = DB::table('tbl_category_product')->where('category_id',$id_edit)->get();
        $category = CategoryProductModel::orderBy('category_id','DESC')->get();
        $manager_category = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product)->with('category',$category);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category);
    }

    public function update_category_product(Request $request, $id_update) 
    {
        $this->validate($request, [
            'category_name' => 'required| min: 3', 
            'category_decs' => 'required| min: 3'
        ],[
            'required' => 'Vui lòng không để trống trường này',
            'min' => 'Vui lòng nhập ít nhất 3 ký tự'
        ]);

        $data = $request->all();
        $category = Category::find($id_update);
        $category->category_name = $data['category_name'];
        $category->category_desc = $data['category_decs'];
        $category->category_status = $data['category_status'];
        $category->category_parent = $data['category_parent'];
        $category->save();

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_desc'] = $request->category_decs;
        // $data['category_status'] = $request->category_status;
        // DB::table('tbl_category_product')->where('category_id', $id_update)->update($data);
        Session::put('messge','Cập nhật danh mục thành công');
        return redirect()->route('all_category');
    }
//ffkkfkffk //gjgjgjgjgj
    public function delete_category_product($id_delete)
    {
        DB::table('tbl_category_product')->where('category_id', $id_delete)->delete();
        Session::put('messge', 'Xóa danh mục thành công');
        return redirect()->route('all_category');
    }

    //END function Admin

    public function show_category_home($category_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id', 'desc')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->paginate(9);

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id', $category_id)->limit(1)->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status', '1')->take(3)->get();
        return view('pages.category.show_category')->with('category',$cate_product)->with('brand', $brand_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name)->with('slider', $slider);
    }

     public function search_cate_admin(Request $request)
    {
        $key_words = $request->keywords;
        $category_product = Category::where('category_parent', 0)->orderBy('category_id','DESC')->get();
        $search_cate = Category::where('category_name','like','%'.$key_words.'%')->orderBy('category_id', 'desc')->paginate(5);

        Session::put('ssKey', $key_words);

        return view('admin.search_cate_admin')->with('search_cate', $search_cate)->with('category_product', $category_product);
    }
}