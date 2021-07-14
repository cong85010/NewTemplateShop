 @extends('welcome')
 @section('content')
 <?php 
 	if($details_product ==NULL){
 		echo "Hello";
 	}
 ?>
 @foreach($details_product as $key => $value)

<section id="cart_items">

		<div class="container" style="width: 1050px">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ URL::to('/') }}">Home</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
					$content = Cart::content();
					echo "<pre>";
						echo $content;
					echo "</pre>";
				?>
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
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{ URL::to('public/uploads/product/'.$v_content->options->image) }}" width="50" alt="" height="50" /></a>
							</td>
							<td class="cart_description">
								<h4>{{ ($v_content->name) }}</h4>
								<h5>Mã sản phẩm: {{ ($v_content->id) }}</h5>
								<h5>Tồn kho: {{ ($value->product_qty) }}</h5>
							</td>
							<td class="cart_price">
								<p>{{ number_format($v_content->price) }} VNĐ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{ URL::to('/update-cart-qty') }}" method="POST">
										{{ csrf_field() }}
										<input width="40" class="cart_quantity_input" min="1"  max="{{ $value->product_qty }}" width="20" type="number" name="cart_quantity" value="{{ ($v_content->qty) }}">
										<input type="hidden" value="{{ $v_content->rowId }}" name="rowId_cart" class="form-control">
										<input type="submit" style="margin: auto" value="Cập nhật" name="update_qty" class="btn btn-primary btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
										$subtotal = $v_content->price * $v_content->qty;
										echo number_format($subtotal).' '. 'VNĐ';
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{ URL::to('/delete-to-cart/'.$v_content->rowId) }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container" style="width: 1050px">
			<div class="heading">
				<h3>Quý khách vui lòng nhấn cập nhật sau khi thay đổi số lượng</h3>
				<p>Kiểm tra kĩ càng trước khi thanh toán. E-Shop xin cảm ơn quý khách !</p>
			</div>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền <span>{{ Cart::total(0) }}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span></span></li>
						</ul>
						<?php 
							if($v_content->qty > $value->product_qty){
						?>
						<a class="btn btn-default check_out">Số lượng quý khách đặt đang vượt quá số lượng tồn kho. Vui lòng cập nhật lại số lượng</a>
						<?php 
					} else{
						?>
						<a class="btn btn-default check_out" href="{{ URL::to('/show-checkout') }}">Thanh toán</a>
						<?php 
					}
						?>
							{{-- <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                                
                                <a class="btn btn-default check_out" href="{{ URL::to('/show-checkout') }}">Thanh toán</a>
                                
                                <?php 
                            }else{
                                ?>
                                <a class="btn btn-default check_out" href="{{ URL::to('/login-checkout') }}">Thanh toán</a>
                                <?php

                            }
                                ?> --}}
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	@endforeach
 @endsection