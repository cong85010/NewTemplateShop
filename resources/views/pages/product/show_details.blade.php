 @extends('welcome')
 @section('content')
 @foreach($details_product as $key => $value)
<div class="product-details_PRO"><!--product-details-->
	<style type="text/css" media="screen">
		.lSSlideOuter .lSPager.lSGallery img {
		    display: block;
		    height: 100px;
		    max-width: 100%;
		}
		li.active {
		    border: 2px solid;
		    color: #FE980F;
		}
	</style>	
						<div class="col-sm-5 style-11" style="max-height: 1000px; overflow-y: auto;">
							<ul>
								@foreach($gallery as $key => $gal)
								<li>
								<img width="100%" src="{{ asset('public/uploads/gallery/'.$gal->gallery_image) }}" />

								</li>
							  	@endforeach
							</ul>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{ ($value->product_name) }}</h2>
								<p>Mã sản phẩm: {{ ($value->product_id) }}</p>
								<p><b>Tồn kho: {{ ($value->product_qty) }}<b></p>
								<img src="images/product-details/rating.png" alt="" />


							<form>
								@csrf
								<input type="hidden" value="{{ $value->product_id }}" class="cart_product_id_{{ $value->product_id }}">
								<input type="hidden" value="{{ $value->product_name }}" class="cart_product_name_{{ $value->product_id }}">
								<input type="hidden" value="{{ $value->product_image }}" class="cart_product_image_{{ $value->product_id }}">
								<input type="hidden" value="{{ $value->product_qty }}" class="cart_product_qty_{{ $value->product_id }}">
								<input type="hidden" value="{{ $value->product_price }}" class="cart_product_price_{{ $value->product_id }}">
								<span style="display: flex; flex-direction: column; align-items: flex-start;">
									<span>{{ number_format($value->product_price) }} VNĐ</span>
									
									<?php 
										if($value->product_qty == '0'){
									?>
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Hết hàng
									</button>
									<?php
								}else{
									?>
									<label>Số lượng:</label>
									<input name="qty" class="cart_product_quantity_{{ $value->product_id }}" type="number" min="1" max="{{ $value->product_qty }}" value="1" />
									<input name="productid_hidden" type="hidden" value="{{ $value->product_id }}" />

									<button type="button" class="btn btn-primary btn-sm add-to-cart" name="add-to-cart" value="{{ $value->product_id }}" data-id_product="{{ $value->product_id }}">
										<i class="fa fa-shopping-cart"></i>
										Thêm giỏ hàng
									</button>
									{{-- <input type="button" name="{{ $value->product_id }}" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{ $value->product_id }}"> --}}
									<?php
								}
									?>
								</span>
							</form>
								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện mặt hàng:</b> Mới</p>
								<p><b>Danh mục:</b> {{ ($value->category_name) }}</p>
								<p><b>Thương hiệu:</b> {{ ($value->brand_name) }}</p>
							</div><!--/product-information-->
							<h4 style="font-size: 20px;">Chi tiết sản phẩm</h4>
							{!! $value->product_content !!}
						</div>
					</div><!--/product-details-->


				<div class="category-tab shop-details-tab style-11"><!--category-tab-->
					<div class="col-sm-6">
							<h4 style="font-size: 20px;">Đánh giá</h4>
							<p style="line-height: 30px;font-size: 15px;">{!! $value->brand_desc !!}</p>
						</div>		
					<div class="col-sm-6" style="border-right: 1px solid #cfcfcf;">
							<h4 style="font-size: 20px;">Thông tin thương hiệu</h4>
							<p style="font-size: 15px;">{!! $value->product_content !!}</p>
						</div>
				</div><!--/category-tab-->

@endforeach
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									@foreach($relate as $key => $lienquan)
										<a href="{{ URL::to('/chi-tiet-san-pham/'.$lienquan->product_id) }}" title="">
											<div class="col-sm-4">
												<div class="product-image-wrapper">
													<div class="single-products">
				                                        <div class="productinfo text-center">
				                                            <img src="{{ URL::to('public/uploads/product/'.$lienquan->product_image) }}" style="height: 257px;"   />
				                                            <h2>{{ number_format($lienquan->product_price) }} VND</h2>
				                                            <p>{{($lienquan->product_name) }}</p>
				                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
				                                        </div>
		                                			</div>
												</div>
											</div>
										</a>
									@endforeach
								</div> 
								<div class="item">
									@foreach($relate2 as $key => $lienquan2 )	
										<a href="{{ URL::to('/chi-tiet-san-pham/'.$lienquan2->product_id) }}" title="">
											<div class="col-sm-4">
												<div class="product-image-wrapper">
													<div class="single-products">
														<div class="productinfo text-center">
															<img src="{{ URL::to('public/uploads/product/'.$lienquan2->product_image) }}" alt="" style="height: 257px;"  />
															<h2>{{ number_format($lienquan2->product_price) }}</h2>
															<p>{{ $lienquan2->product_name }}</p>
															<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
														</div>
													</div>
												</div>
											</div>
										</a>
									@endforeach
								</div>

							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@endsection