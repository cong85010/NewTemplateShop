@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <a href="{{ ('add-product') }}" title="">THÊM SẢN PHẨM</a>
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
          <form action="{{ URL::to('/search-pro-admin') }}" method="post">
            {{ csrf_field() }}
            <input type="text" name="keywords" class="input-sm form-control" placeholder="Tìm kiếm">
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
      <span style="color: red;"><?php
        $err = Session::get('err');
        if($err){
          echo $err;
          Session::put('err',null);
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
            <th>Tên sản phẩm</th>
            <th>Hình ảnh sản phẩm</th>
            <th>Hình ảnh mô tả</th>
            <th>Giá sản phẩm</th>
            <th>Giá nhập</th>
            <th>Danh mục sản phẩm</th>
            <th>Thương hiệu</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th style="width:30px;">Sửa/xóa</th>
          </tr>
        </thead>
        <tbody>
          @foreach($search_product as $key => $product)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $product->product_name }}</td>
            <td><img src="public/uploads/product/{{ $product->product_image }}" width="100" height="100"></td>
            <td><a href="{{ 'add-gallery/'.$product->product_id }}">Thêm/sửa hình ảnh mô tả</a></td>
            <td>{{ number_format($product->product_price) }}</td>
            <td>{{ number_format($product->product_cost) }}</td>
            <td>{{ $product->category_name }}</td>
            <td>{{ $product->brand_name }}</td>
            <td>{{ $product->product_qty }}</td>
            <td><span class="text-ellipsis">
              {{-- <?php
              if($cate->category_status==0){
                echo '<a href="#"> Ẩn </a>';
              }else{
                echo "<a href='#'> Hiển thị </a>";
              }
            ?> --}}
              @if($product->product_status==0)
                <a href="{{ URL::to('/active-product/'.$product->product_id) }}" title="">Ẩn</a>
              @else
                <a href="{{ URL::to('/unactive-product/'.$product->product_id) }}" title="">Hiển thị</a>
              @endif
            </span></td>
            <td>
              <a href="{{ URL::to('edit-product/'.$product->product_id) }}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')" href="{{ URL::to('delete-product/'.$product->product_id) }}" title="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table><br>

      <form action="{{ url('import-csv-product') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" accept=".xlsx">
          <input type="submit" value="Import Excel" name="import_csv" class="btn btn-warning">
      </form>

      <form action="{{ url('export-csv-product') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="submit" value="Export Excel" name="export_csv" class="btn btn-success">
      </form>

    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm"></small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $search_product -> links() }}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection