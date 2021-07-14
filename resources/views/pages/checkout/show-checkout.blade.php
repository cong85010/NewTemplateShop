 @extends('welcome')
 @section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ URL::to('/') }}">Home</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			
			<div class="register-req">
				<p>Vui lòng điền thông tin nhận hàng và kiểm tra lại đơn hàng</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Thông tin nhận hàng</p>
							<div class="form-one">
								<form method="post">
									@csrf 
									Email: <input type="text" class="shipping_email" name="shipping_email" placeholder="Email" value="{{ old('shipping_email') }}">
									@if($errors->has('shipping_email'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('shipping_email') }}</alert></span> 
                                    @endif
									Họ tên người nhận: <input type="text" class="shipping_name" name="shipping_name" placeholder="Họ và tên người nhận" value="{{ old('shipping_name') }}">
									@if($errors->has('shipping_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('skhipping_name') }}</alert></span> 
                                    @endif
									Địa chỉ nhận hàng: <input type="text" class="shipping_address" name="shipping_address" placeholder="Địa chỉ người nhận | Phường, Xã - Quận, Huyện - Tỉnh, thành" value="{{ old('shipping_address') }}">
									@if($errors->has('shipping_address'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('shipping_address') }}</alert></span> 
                                    @endif
									Số điện thoại người nhận: <input type="number" class="shipping_phone" name="shipping_phone" placeholder="Số điện thoại người nhận" value="{{ old('shipping_phone') }}">
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
			<h3>Xem lại đơn hàng</h3><br>





			<div class="payment-options">
				<section id="cart_items">
					<div class="container" style="margin-left: -18px; width: 1057px;">
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
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td class="delete">Loại bỏ</td>
						</tr>
					</thead>
					<tbody>
						@if(Session::get('cart')==true)
						@php
							$total = 0;
						@endphp
						@foreach(Session::get('cart') as $key => $cart)
						@php
							$subtotal = $cart['product_price']*$cart['product_quantity'];
							$total += $subtotal;
						@endphp
						<tr>
							<td class="cart_product">
								<img src="{{ asset('public/uploads/product/'.$cart['product_image']) }}" alt="{{ $cart['product_name'] }}" width="70" height="70">
							</td>
							<td class="cart_description">
								<h4>{{ $cart['product_name'] }}</h4>
								<h5>Mã sản phẩm: {{ $cart['product_id'] }}</h5>
							</td>
							<td class="cart_price">
								<p>{{  number_format($cart['product_price'],0,',','.') }}VNĐ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
										<input width="40" class="cart_quantity_" min="1"  width="20" type="number" name="cart_qty[{{ $cart['session_id'] }}]" value="{{ $cart['product_quantity'] }}">

										
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									{{  number_format($subtotal,0,',','.') }}VNĐ
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{ url('/delete-product-cart/'.$cart['session_id']) }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						
						@endforeach
						<tr>
							<td><input style="margin-top: 20px" type="submit" style="margin: auto" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out"></td>

							<td><a style="margin-top: 19px" class="btn btn-default check_out" href="{{ url('/delete-all-cart') }}">Xóa toàn bộ giỏ hàng</a></td>
							<td colspan="6">
								<li>Tổng tiền: <span>{{  number_format($total,0,',','.') }}VNĐ</span></li>
								@if(Session::get('coupon'))
								<li>
									
										@foreach(Session::get('coupon') as $key => $cou)
											@if($cou['coupon_condition']==1)
												Giảm giá: {{ $cou['coupon_discount'] }}%
												<p>
													@php
														$total_coupon = ($total*$cou['coupon_discount'])/100;
														echo "<li>Tổng giảm: ".number_format($total_coupon,0,',','.')." VNĐ</li>";
													@endphp
												</p>
												<li>Thành tiền: {{number_format($total - $total_coupon,0,',','.')}} VNĐ</li>
											@elseif($cou['coupon_condition']==0)
											Giảm giá: {{ number_format($cou['coupon_discount'],0,',','.') }}VNĐ
												<p>
													@php
														$total_coupon = $total - $cou['coupon_discount'];
													@endphp
												</p>
												<li>Thành tiền:{{number_format( $total_coupon,0,',','.')}} VNĐ</li>
												@endif
										@endforeach
									
									




								</li>
								@endif
								{{-- <li>Phí vận chuyển <span>Free</span></li> --}}
							</td>
							
						</tr>
						@else
						<tr>
							<td colspan="6"><center>
							@php 
								echo '<div class="alert alert-danger"><h4>'."Vui lòng thêm <a href='/shopbanhang2'>sản phẩm</a> vào giỏ hàng".'</h4></div>';
							@endphp
							</center></td>
						</tr>
						@endif
					</tbody>
					
				</form>
				<tr>
					@if(Session::get('cart')==true)
					<td> 
						<form action="{{ url('check-coupon') }}" method="post">
							@csrf
							<input type="text" name="coupon" class="form-control" value="" placeholder="Nhập mã giảm giá">
							<input type="submit" class="btn btn-default check_out" name="check_coupon" value="Áp dụng mã giảm giá">
							@if(Session::get('coupon')==true)
							<td><a style="margin-top: 52px" class="btn btn-default check_out" href="{{ url('/unset-coupon') }}">Loại bỏ mã giảm giá</a></td>
							<td>
							@endif
						</form>
					</td>
					@endif
				</tr>
				</table>
			</div>
		</div>
		
		</div>
	</section> <!--/#cart_items-->

 @endsection