 @extends('welcome')
 @section('content')

<section id="cart_items">
		<div class="">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ URL::to('/') }}">Home</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>
			<h3>Xem lại đơn hàng</h3><br>
			<div class="payment-options">
				<section id="cart_items">
					<div class="" >
			<?php 
				$mess = Session::get('mess');
				$err = Session::get('err');
				if($mess){
					echo '<div class="alert alert-success"><h4>'.$mess.'</h4></div>';
					Session::put('mess',null);
				}elseif($err){
					echo '<div class="alert alert-danger"><h4>'.$err.'</h4></div>';
					Session::put('err',null);
				}
			?>
			
 <div class="table-responsive cart_info">
 	<form action="{{ url('/update-cart') }}" method="POST">
 		@csrf
 		<section class="main-basket" id="cart_items">
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
 	<div class="basket-voucher" style="padding-right: 35x;">
 		<form action="{{ url('check-coupon') }}" method="post">
 			@csrf
 			<div class="flex-between">
 				<div class="flex-between">
 					<input style="width: 200px;background-color: transparent;" type="text" name="coupon" class="form-control" value="" placeholder="Nhập mã giảm giá">
 					<input type="submit" class="btn btn-success" name="check_coupon" value="Áp dụng">
 				</div>
 				@if(Session::get('coupon')==true)
 				<a style="color: black; width: 200px;background-color: transparent;"  class="btn btn-danger" href="{{ url('/unset-coupon') }}">Loại bỏ mã giảm giá</a>
 				@endif
 		</form>
 	</div>
 	</div>
 </section >
			<div class="shopper-informations">
				<div style="clear: both; margin-top: 150px;">
					<div class="">
						<div class="bill-to">
							<h2>Thông tin nhận hàng</h2>
							<div class="form-one">
								<form method="post">
									@csrf 
									Email: <input type="text" class="shipping_email" name="shipping_email" value="{{ old('shipping_email') }}">
									@if($errors->has('shipping_email'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('shipping_email') }}</alert></span> 
                                    @endif
									Họ tên người nhận: <input type="text" class="shipping_name" name="shipping_name" value="{{ old('shipping_name') }}">
									@if($errors->has('shipping_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('skhipping_name') }}</alert></span> 
                                    @endif
									Địa chỉ nhận hàng: <input type="text" class="shipping_address" name="shipping_address" placeholder="Địa chỉ người nhận | Phường, Xã - Quận, Huyện - Tỉnh, thành" value="{{ old('shipping_address') }}">
									@if($errors->has('shipping_address'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('shipping_address') }}</alert></span> 
                                    @endif
									Số điện thoại người nhận: <input type="number" class="shipping_phone" name="shipping_phone"  value="{{ old('shipping_phone') }}">
									@if($errors->has('shipping_phone'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('shipping_phone') }}</alert></span> 
                                    @endif

                                    @if(Session::get('coupon'))
                                    	@foreach(Session::get('coupon') as $key => $cou)
                                    	<input type="hidden" class="order_coupon" name="order_coupon" value="{{ $cou['coupon_code'] }}">
                                    	@endforeach
                            		@else
                            			<input type="hidden" class="order_coupon" name="order_coupon" value="No" >
                            		@endif

                            		Chọn hình thức thanh toán:
                            			<select name="payment_select" id="wards" class="form-control input-sm m-bot15 payment_select">
                            				<option value="0">Thanh toán chuyển khoản</option>
                            				<option value="1">Nhận hàng - thanh toán</option>
                            			</select>
                                	
									Ghi chú đơn hàng: <textarea class="shipping_notes" name="shipping_notes"  placeholder="Điền thông tin cần lưu ý đến Shop hoặc Shipper" rows="16" value="{{ old('shipping_notes') }}"></textarea>
									@php
										if(Session::get('cart')){
									@endphp		
										<input type="button" value="Xác nhận" name="xac-nhan" class="btn btn-primary btn-sm xac-nhan">
									@php	
										}else{
									@endphp
										<input type="button" value="Qúy khách vui lòng thêm sản phẩm vào giỏ hàng" class="btn btn-primary btn-sm">
									@php		
										}
									@endphp

								</form>
							</div>
						</div>
					</div>					
				</div>
			</div>
			</div>
	</section> <!--/#cart_items-->

 @endsection