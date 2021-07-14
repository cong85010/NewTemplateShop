@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      BANNER
      <div><a style="margin-left: 600px" href="{{ URL::to('add-slider') }}" title="">Thêm Banner</a></div>
    </div>
    <div class="table-responsive">
      <span style="color: green"><?php
        $messge = Session::get('messge');
        if($messge){
            echo $messge;
            Session::put('messge',null);
        }
      ?></span>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên Slide</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Tình trạng</th>
            <th style="width:30px;">Xóa</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_slide as $key => $slide)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $slide->slider_name }}</td>
            <td><img src="public/uploads/slider/{{ $slide->slider_image }}" width="500" height="100"></td>
            <td>{{ $slide->slider_desc }}</td>
            <td><span class="text-ellipsis">
              @if($slide->slider_status==0)
                <a href="{{ URL::to('/active-slide/'.$slide->slider_id) }}" title="">Ẩn</a>
              @else
                <a href="{{ URL::to('/unactive-slide/'.$slide->slider_id) }}" title="">Hiển thị</a>
              @endif
            </span></td>
            <td>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')" href="{{ URL::to('delete-slide/'.$slide->slider_id) }}" title="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
        <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm"></small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $all_slide -> links() }}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection