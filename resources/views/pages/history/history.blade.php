@extends('welcome')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
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
            
            <td>
              <a href="{{ URL::to('view-history-order/'.$ord->order_code) }}" class="active" ui-toggle-class="">
                Xem chi tiết</a>
              {{-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')" href="{{ URL::to('delete-order/'.$ord->order_code) }}" title=""> --}}
                {{-- <i class="fa fa-times text-danger text"></i></a> --}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection