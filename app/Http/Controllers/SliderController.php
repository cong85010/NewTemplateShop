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

class SliderController extends Controller
{

  public function delete_slide($slide_id)
  {
    $slider = Slider::find($slide_id);
    $slider->delete();
    Session::put('messge', 'Xóa banner quảng cáo thành công');
      return redirect()->route('manage_slider');
  }

	public function active_slide($slide_id)
    {
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>1]);
        Session::put('messge','Hiển thị slider thành công');
        return redirect()->route('manage_slider');
    }

    public function unactive_slide($slide_id)
    {
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>0]);
        Session::put('messge','Ẩn slider thành công');
        return redirect()->route('manage_slider');
    }

    public function manage_slider()
    {
    	$all_slide = Slider::orderBy('slider_id','DESC')->paginate(2);
    	return view('admin.slider.list_slider')->with(compact('all_slide'));
    }

    public function add_slider()
    {
    	return view('admin.slider.add_slider');
    }

    public function insert_slider(Request $request)
    {
    	$data = $request->all();

        $get_image = $request->file('slider_image');

        if($get_image){
           $get_name_image = $get_image->getClientOriginalName();
           $name_imgae = current(explode('.',$get_name_image));
           $new_image = $name_imgae.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('public/uploads/slider', $new_image);
           
           $slider = new Slider();

           $slider->slider_name = $data['slider_name'];
           $slider->slider_image = $new_image;
           $slider->slider_status = $data['slide_status'];
           $slider->slider_desc = $data['slider_desc'];
           $slider->save();

            Session::put('messge','Thêm slider thành công');
            return redirect()->route('add_slider'); 
        }else{
        	Session::put('messge','Vui lòng thêm ảnh');
            return redirect()->route('add_slider'); 
        }
            
    }
}
