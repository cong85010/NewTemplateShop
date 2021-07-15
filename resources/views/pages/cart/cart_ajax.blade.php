 @extends('welcome')
 @section('content')


 <div class="table-responsive cart_info">
 	<form action="{{ url('/update-cart') }}" method="POST">
 		@csrf
 		<section class="main-basket" id="cart_items">
 			<div class="breadcrumbs">
 				<ol class="breadcrumb">
 					<li><a href="{{ URL::to('/') }}">Home</a></li>
 					<li class="active">Giỏ hàng</li>
 				</ol>
 			</div>
 			@if(session()->has('mess'))
 			<div class="alert alert-success">
 				{!! session()->get('mess') !!}
 			</div>
 			@elseif(session()->has('err'))
 			<div class="alert alert-danger">
 				{!! session()->get('err') !!}
 			</div>
 			@endif
 			<div class="basket">
 				<p style="font-size: 15px;text-align: end;">Đơn vị: VNĐ</p>
 				<div class="basket-labels">
 					<ul>
 						<li class="basket__item">Sản phẩm</li>
 						<li class="price">Giá</li>
 						<li class="quantity">Số lượng</li>
 						<li class="subtotal">Tổng</li>
 					</ul>
 				</div>
 				@if(Session::get('cart')==true)
 				@php
 				$total = 0;
 				@endphp
 				@foreach(Session::get('cart') as $key => $cart)
 				@php
 				$subtotal = $cart['product_price']*$cart['product_quantity'];
 				$total += $subtotal;
 				@endphp
 				<div class="basket-product">
 					<div class="basket__item">
 						<div class="product-image">
 							<img class="product-frame" src="{{ asset('public/uploads/product/'.$cart['product_image']) }}" alt="{{ $cart['product_name'] }}" width="100" height="70">
 						</div>
 						<div class="product-details">
 							<h5>{{ $cart['product_name'] }}</h5>
 							<p><strong>Mã sản phẩm: {{ $cart['product_id'] }}</strong></p>
 						</div>
 					</div>
 					<div class="price">{{ number_format($cart['product_price'],0,',','.') }}</div>
 					<div class="quantity">
 						<input width="40" class="quantity-field" min="1" width="20" type="number" name="cart_qty[{{ $cart['session_id'] }}]" value="{{ $cart['product_quantity'] }}">
 					</div>
 					<div class="subtotal">{{ number_format($subtotal,0,',','.') }}</div>
 					<div class="remove">
 						<button class="btn btn-danger"><a href="{{ url('/delete-product-cart/'.$cart['session_id']) }}">xóa</a></button>
 					</div>

 				</div>
 				@endforeach
 			</div>
 			<aside>
 				<div class="summary">
 					<div class="summary-total-items">Tổng <span class="total-items"></span> sản phẩm</div>
 					<div class="summary-subtotal">
 						<div class="subtotal-title">Tạm tính</div>
 						<div class="subtotal-value final-value" id="basket-subtotal">{{ number_format($total,0,',','.') }}VNĐ</div>
 						<div class="summary-promo hide">
 							<div class="promo-title">Promotion</div>
 							<div class="promo-value final-value" id="basket-promo"></div>
 						</div>
 					</div>
 					<div class="summary-delivery">
 						@if(Session::get('coupon'))
 						<li>
 							@foreach(Session::get('coupon') as $key => $cou)
 							@if($cou['coupon_condition']==1)
 							Giảm giá: {{ $cou['coupon_discount'] }}%
 							<p>
 								@php
 								$total_coupon = ($total*$cou['coupon_discount'])/100;
 								echo "
 						<li>Tổng giảm: ".number_format($total_coupon,0,',','.')." VNĐ</li>";
 						@endphp
 						</p>
 						@elseif($cou['coupon_condition']==0)
 						Giảm giá: {{ number_format($cou['coupon_discount'],0,',','.') }}VNĐ
 						<p>
 							@php
 							$total_coupon = $total - $cou['coupon_discount'];
 							@endphp
 						</p>
 						@endif
 						@endforeach
 						@endif

 					</div>
 					<div class="summary-total">
 						<div class="total-title">Tổng</div>
 						@if(Session::get('coupon'))
 						@foreach(Session::get('coupon') as $key => $cou)
 						@if($cou['coupon_condition']==1)
 						@php
 						$total_coupon = $total - ($total*$cou['coupon_discount'])/100;
 						@endphp
 						<div class="final-value-price total-value final-value" id="basket-total">{{number_format($total_coupon,0,',','.')}} VNĐ</div>
 						@elseif($cou['coupon_condition']==0)

 						@php
 						$total_coupon = $total - $cou['coupon_discount'];
 						@endphp
 						<div class="final-value-price total-value final-value" id="basket-total">{{number_format($total_coupon,0,',','.')}} VNĐ</div>

 						@endif
 						@endforeach

 						@else
 						<div class="final-value-price total-value final-value" id="basket-total">{{number_format($total,0,',','.')}} VNĐ</div>
 						@endif
 					</div>
 					<div class="summary-checkout">
 						<button class="checkout-cta"><a href="{{ URL::to('/show-checkout') }}">Thanh toán</a></button>

 					</div>
 				</div>
 			</aside>
 			<div style="width: 70%; margin-top: 20px;float: left;">
 				<div class="flex-between">
 					<input style="margin-left: 0;color: black; background-color: transparent;" type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-success">
 					<a style="width: 200px;color: black;background-color: transparent;"  class="btn btn-danger" href="{{ url('/delete-all-cart') }}">Xóa toàn bộ giỏ hàng</a>
 				</div>
 				@endif
 			</div>

 </div>
 </section>
 </form>
 <section>
 	<div class="basket-voucher">
 		<form action="{{ url('check-coupon') }}" method="post">
 			@csrf
 			<div class="flex-between">
 				<div class="flex-between">
 					<input style="width: 200px;background-color: transparent;" type="text" name="coupon" class="form-control" value="" placeholder="Nhập mã giảm giá">
 					<input type="submit" class="btn btn-success" name="check_coupon" value="Áp dụng">
 				</div>
 				@if(Session::get('coupon')==true)
 				<a style="width: 200px;background-color: transparent;"  class="btn btn-danger" href="{{ url('/unset-coupon') }}">Loại bỏ mã giảm giá</a>
 				@endif
 		</form>
 	</div>
 	</div>
 </section>
 </div>
 @endsection