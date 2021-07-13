 @extends('welcome')
 @section('content')
 @foreach($details_product as $key => $value)
<div class="product-details"><!--product-details-->
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
						<div class="col-sm-5">
							<ul id="imageGallery">
								@foreach($gallery as $key => $gal)
							  <li data-thumb="{{ asset('public/uploads/gallery/'.$gal->gallery_image) }}" data-src="{{ asset('public/uploads/gallery/'.$gal->gallery_image) }}">
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
								<span>
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
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->


<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Thông tin thương hiệu</a></li>
								<li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="col-sm-12">
									<p><h4>{!! $value->product_content !!}</h4></p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-12">
									<p><h4>{!! $value->brand_desc !!}</h4></p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
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