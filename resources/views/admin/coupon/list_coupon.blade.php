 @extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <p class="title_thongke">
      Danh sách mã giảm giá
      </p>
    </div
    <div class="table-responsive">
      <?php
        $mess = Session::get('mess');
        if($mess){
            echo $mess;
            Session::put('mess',null);
        }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên mã</th>
            <th>Mã</th>
            <th>Số lượng mã giảm</th>
            <th>Điều kiện giảm giá</th>
            <th>Số tiền giảm</th>
            <th style="width:30px;">Hủy</th>
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key => $cou)
          <tr>
            <td>{{ $cou->coupon_name }}</td>
            <td>{{ $cou->coupon_code }}</td>
            <td>{{ $cou->coupon_time }}</td>
            <td><span class="text-ellipsis">
              @if($cou->coupon_condition == 1)
                Giảm theo %
              @else
                Giảm theo số tiền đưa ra
              @endif
            </span></td>

            <td><span class="text-ellipsis">
              @if($cou->coupon_condition == 1)
                Giảm {{ $cou->coupon_discount }}% đơn hàng
              @else
                Giảm {{ number_format($cou->coupon_discount) }} VNĐ 
              @endif
            </span></td>
            
            <td>
              <a onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')" href="{{ URL::to('delete-coupon/'.$cou->coupon_id) }}" title="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
        <footer class="panel-footer">
      <div class="flex-between">
        <div class="col-sm-5">
        <a  href="{{ URL::to('insert-coupon') }}" title="">Thêm mã giảm</a>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $coupon -> links() }}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection