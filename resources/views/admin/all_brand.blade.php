@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thương hiệu sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <a href="{{ ('add-brand') }}" title="">THÊM THƯƠNG HIỆU</a>
        {{-- <select class="input-sm form-control w-sm inline v-middle">
          <button type="">Thêm sản phẩm</button>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select> --}}
        {{-- <button class="btn btn-sm btn-default">Apply</button>  --}}               
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <form action="{{ URL::to('/search-brand-admin') }}" method="post">
            {{ csrf_field() }}
            <input type="text" name="keywords" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
            </span>
          </form>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <?php
        $messge = Session::get('messge');
        if($messge){
            echo $messge;
            Session::put('messge',null);
        }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên thương hiệu</th>
            <th>Trạng thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_brand as $key => $brand)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $brand->brand_name }}</td>
            <td><span class="text-ellipsis">
              {{-- <?php
              if($cate->category_status==0){
                echo '<a href="#"> <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>Ẩn </a>';
              }else{
                echo "<a href='#'> Hiển thị </a>";
              }
            ?> --}}
              @if($brand->brand_status==0)
                <a href="{{ URL::to('/active-brand/'.$brand->brand_id) }}" title="">Ẩn</a>
              @else
                <a href="{{ URL::to('/unactive-brand/'.$brand->brand_id) }}" title="">Hiển thị</a>
              @endif
            </span></td>
            <td>
              <a href="{{ URL::to('edit-brand/'.$brand->brand_id) }}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')" href="{{ URL::to('delete-brand/'.$brand->brand_id) }}" title="">
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
            {{ $all_brand -> links() }}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection