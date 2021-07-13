 @extends('welcome')
 @section('content')


<section id="cart_items">

		<div class="container" style="width: 1050px">
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

							{{-- <td><a style="margin-top: 19px" class="btn btn-default check_out" href="{{ url('/delete-all-cart') }}">Xóa toàn bộ giỏ hàng</a></td> --}}
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
							<a class="btn btn-default check_out" href="{{ URL::to('/show-checkout') }}">Thanh toán</a>
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
	</section> <!--/#cart_items-->

	{{-- <section id="do_action">
		<div class="container" style="width: 1050px">
			<div class="heading">
				<h3>Quý khách vui lòng nhấn cập nhật sau khi thay đổi số lượng</h3>
				<p>Kiểm tra kĩ càng trước khi thanh toán. E-Shop xin cảm ơn quý khách !</p>
			</div>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							
						</ul>
						<a class="btn btn-default check_out" href="">Thanh toán</a>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action--> --}}
 @endsection