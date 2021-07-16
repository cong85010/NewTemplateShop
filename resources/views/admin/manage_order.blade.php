@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default dashboard">
    <div class="panel-heading">
      <p class="title_thongke">
      Liệt kê đơn hàng
      </p>
    </div>
    <div class="row w3-res-tb">
      
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
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Chi tiết</th>
          </tr>
        </thead>
        <tbody>
          @php
          $i = 0;
          @endphp
          @foreach($order as $key => $ord)
          @php
            $i++;
          @endphp
          <tr>
            <td>{{ $i }}</td>
            <td><a href="{{ URL::to('view-order/'.$ord->order_code) }}" title="">{{ $ord->order_code }}</a></td>
            <td>@if($ord->order_status==1)
                    <p style="color: blue">Đơn hàng mới</p>
                @elseif($ord->order_status==2)
                    <p style="color: green">Đã xử lý</p>
                @else
                    <p style="color: red">Hủy hoặc có vấn đề</p>
                @endif

            </td>
            <td>{{ $ord->created_at }}</td>
            
            <td class="flex-between">
              <a href="{{ URL::to('view-order/'.$ord->order_code) }}" class="active" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')" href="{{ URL::to('delete-order/'.$ord->order_code) }}" title="">
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
            {{ $order -> links() }}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection