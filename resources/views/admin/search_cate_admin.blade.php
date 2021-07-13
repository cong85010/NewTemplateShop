@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh mục sản phẩm
    </div>

    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <a href="{{ ('add-category-product') }}" title="">THÊM DANH MỤC</a>
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
          <form action="{{ URL::to('/search-cate-admin') }}" method="post">
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
            <th>Tên danh mục</th>
            <th>Thuộc danh mục</th>
            <th>Trạng thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($search_cate as $key => $cate)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $cate->category_name }}</td>
            <td>
                @if($cate->category_parent==0)
                  <span style="color: red">Danh mục lớn</span>
                @else
                  @foreach($category_product as $key =>$cate_sub_pro)
                    @if($cate_sub_pro->category_id==$cate->category_parent)
                      <span style="color: green">{{ $cate_sub_pro->category_name }}</span>
                    @endif
                  @endforeach
                @endif
            </td>
            <td><span class="text-ellipsis">
              {{-- <?php
              if($cate->category_status==0){
                echo '<a href="#"> Ẩn </a>';
              }else{
                echo "<a href='#'> Hiển thị </a>";
              }
            ?> --}}
              @if($cate->category_status==0)
                <a href="{{ URL::to('/active-category/'.$cate->category_id) }}" title="">Ẩn</a>
              @else
                <a href="{{ URL::to('/unactive-category/'.$cate->category_id) }}" title="">Hiển thị</a>
              @endif
            </span></td>
            <td>
              <a href="{{ URL::to('edit-category-product/'.$cate->category_id) }}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')" href="{{ URL::to('delete-category-product/'.$cate->category_id) }}" title="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table><br>

      <form action="{{ url('import-csv') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" accept=".xlsx">
          <input type="submit" value="Import Excel" name="import_csv" class="btn btn-warning">
      </form>

      <form action="{{ url('export-csv') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="submit" value="Export Excel" name="export_csv" class="btn btn-success">
      </form>

    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm"></small>
        </div>
        <div class="phantrang" style="margin-left: 390px">
          {{ $search_cate -> links() }}
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection