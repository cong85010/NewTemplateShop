@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
  
      @foreach($order_detail as $key => $tt1)
     
      Thông tin khách hàng đăng nhập - đơn <span style="color: red">{{ $tt1->order_code }}</span>

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
  <div style="min-height: auto; padding: 0;" class="table-agile-info">
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
<div style="height: auto; padding: 0;" class="table-agile-info">
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
            <th>Tồn kho</th>
            <th>Số lượng khách đặt</th>
            <th>Mã giảm giá</th>
            <th>Giá sản phẩm</th>
            <th>Giá nhập</th>
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
            <td>{{ $details->product->product_qty }}</td>
            <td><input type="number" {{ $order_status ==2 || $order_status ==3  ? 'disabled' : '' }} class="order_qty_{{ $details->product_id }}" min="1" value="{{ $details->product_sale_qty }}" name="product_sale_qty">
                <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{ $details->product_id }}" value="{{ $details->product->product_qty }}">

                <input type="hidden" name="order_code" class="order_code" value="{{ $details->order_code }}">

                <input type="hidden" name="order_product_id" class="order_product_id" value="{{ $details->product_id }}">
                @if($order_status!=2)
                <button class="btn btn-default update_qty_order" data-product_id="{{ $details->product_id }}" name="update_qty_order">Cập nhật</button>
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
            <td>{{ number_format($details->product->product_cost,0,',','.') }} VNĐ</td>
            <td>{{ number_format($subtotal,0,',','.') }} VNĐ</td>
          </tr>
            @endforeach
          <tr>
            <td></td>
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
           
            <td></td>
            <td ></td>
            <td style="color: red">Tổng tiền: {{ number_format($total_coupon,0,',','.') }} VNĐ</td>
          </tr>

          <tr>
            <td colspan="7">
              @foreach ($order as $key => $or)
                @if($or->order_status==1)
              <form>
                @csrf
                <select class="form-control order_details">
                  <option value="" selected>------- Đơn hàng chưa xử lý -------</option>
                  <option id="{{ $or->order_id }}" value="2">Đã xử lý</option>               
                </select>
              </form>
              @elseif($or->order_status==2)
              <form>
                @csrf
                <select class="form-control order_details">
                  <option value="">-------> Đã xử lý <-------</option>
                  <option id="{{ $or->order_id }}" value="3">Hủy hoặc có vấn đề</option>                
                </select>
              </form>
              @else
              <form>
                @csrf
                <select class="form-control order_details">
                  <option value="3">-------> Hủy hoặc có vấn đề <-------</option>                
                </select>
              </form>
              @endif
              @endforeach
            </td>
          </tr>
        </tbody>
      </table>
      <a href="{{ url('/print-order/'.$details->order_code) }}" target="blank">In đơn hàng</a>
    </div>
   
  </div>
</div>
</div>
@endsection