@extends('welcome')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
  
      @foreach($order_detail as $key => $tt1)
     
      Thông tin khách đặt hàng - đơn <span style="color: red">{{ $tt1->order_code }}</span>

      @endforeach
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
            
            <th>Tên/ ID khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td>{{ $customer->customer_name }}/ ID: {{ $customer->customer_id }} </td>
            <td>{{ $customer->customer_phone }}</td>
            <td>{{ $customer->customer_email }}</td>
          </tr>
           
        </tbody>
      </table>
    </div>
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      @foreach($order_detail as $key => $tt1)
      Thông tin nhận hàng - đơn <span style="color: red">{{ $tt1->order_code }}</span>
      @endforeach
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
            
            <th>Tên người nhận</th>
            <th>Số điện thoại người nhận</th>
            <th>Địa chỉ người nhận</th>
            <th>Email</th>
            <th>Phương thức thanh toán</th>
            <th>Ghi chú</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          
          <tr>
            <td>{{ $shipping->shipping_name }}</td>
            <td>{{ $shipping->shipping_phone }}</td>
            <td>{{ $shipping->shipping_address }}</td>
            <td>{{ $shipping->shipping_email }}</td>
            <td>
              @if($shipping->shipping_method==0)
              Thanh toán chuyển khoản
              @else
              Nhận hàng thanh toán
              @endif
            </td>
            <td>{{ $shipping->shipping_notes }}</td>
            
          </tr>
            
        </tbody>
      </table>
    </div>
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      @foreach($order_detail as $key => $tt1)
      Chi tiết đơn hàng - đơn <span style="color: red">{{ $tt1->order_code }}</span> 
      @endforeach
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
            <th>Sản phẩm</th>
            <th>Số lượng khách đặt</th>
            <th>Mã giảm giá</th>
            <th>Giá sản phẩm</th>
            <th>Thành tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
          $i = 0;
          $total = 0;
          @endphp
           @foreach($order_detail as $key => $details)
          @php 
          $i++;
          $subtotal = $details->product_price * $details->product_sale_qty;
          $total += $subtotal;
          @endphp
          <tr class="color_qty_{{ $details->product_id }}">
            <td>{{ $i }}</td>
            <td>{{ $details->product_name }}</td>
            <td><input type="number" disabled class="order_qty_{{ $details->product_id }}" min="1" value="{{ $details->product_sale_qty }}" name="product_sale_qty">
                <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{ $details->product_id }}" value="{{ $details->product->product_qty }}">

                <input type="hidden" name="order_code" class="order_code" value="{{ $details->order_code }}">

                <input type="hidden" name="order_product_id" class="order_product_id" value="{{ $details->product_id }}">
                @if($order_status!=2)
               
                @endif
            </td>
            <td>
              @if($details->product_coupon != 'No')
                {{ $details->product_coupon }}
              @else
                Không áp dụng
              @endif
            </td>
            <td>{{ number_format($details->product_price,0,',','.') }} VNĐ</td>
            <td>{{ number_format($subtotal,0,',','.') }} VNĐ</td>
          </tr>
            @endforeach
          <tr>
            <td></td>
            <td></td>
            
            <td></td>
            <td style="color: red">
              @php
                $total_coupon = 0;
              @endphp

              @if($coupon_condition==1)
                @php
                $total_after_coupon = ($total*$coupon_discount)/100;
                echo "Tổng giảm: ".number_format($total_after_coupon,0,',','.')." VNĐ";
                $total_coupon = $total-$total_after_coupon;
                @endphp
              @else
                @php
                echo "Tổng giảm: ".number_format($coupon_discount,0,',','.')." VNĐ";
                $total_coupon = $total-$coupon_discount;
                @endphp
              @endif
            </td>
           
            
            <td ></td>
            <td style="color: red; font-weight: bold;">Tổng tiền: {{ number_format($total_coupon,0,',','.') }} VNĐ</td>
          </tr>

        </tbody>
      </table>
      <a style="font-size: 16x; color: blue;" href="{{ url('/print-order/'.$details->order_code) }}" target="blank"><i class="fa fa-print" aria-hidden="true"></i> In đơn hàng</a>
    </div>
   
  </div>
</div>
@endsection