<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Wellcome E Shop</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css?fbclid=IwAR2hW-UVKVzrY8wv5mhLirtIbqHtuWpOsEqiOtaoqftHoN8xJ09cuQJdNV4" rel="stylesheet">
    <script src="https://kit.fontawesome.com/98e932dc3d.js" crossorigin="anonymous"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ ('public/frontend/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ ('public/frontend/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ ('public/frontend/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ ('public/frontend/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ ('public/frontend/images/ico/apple-touch-icon-57-precomposed.png') }}">

</head><!--/head-->

<body>
    {{-- <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top--> --}}
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ URL::to('/trangchu') }}"><img src="{{ URL::to('public/frontend/images/logo.png') }}" alt="" /></a>
                        </div> 
                        {{-- <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <?php 
                                $user = Session::get('customer_name');
                                $id = Session::get('customer_id');
                                if($user !=NULL){
                                ?>
                                <li><a href="{{ URL::to('/profile-customer/'.Session::get('customer_id')) }}"><i class="fa fa-user"></i>Xin chào <?php echo"$user"; ?></a></li>
                                <li><a href="#"><i class="fa fa-star"></i>ID: <?php echo"$id"; ?></a></li>
                                <?php 
                            } else{
                                ?>
                             
                                <?php 
                            }
                                ?>
                                
                                {{-- <li><a href="#"><i class="fa fa-heart"></i> Yêu thích</a></li> --}}
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                                <?php 
                                    $shipping_id = Session::get('shipping_id');
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id !=NULL && $shipping_id != NULL){
                                ?>
                                <li><a href="{{ URL::to('/payment') }}"><i class="fas fa-money-bill-wave"></i> Thanh toán</a></li>
                                <?php 
                            } else if($customer_id !=NULL && $shipping_id == NULL){
                                ?>
                                <li><a href="{{ URL::to('/show-checkout') }}"><i class="fas fa-money-bill-wave"></i> Thanh toán</a></li>
                                <?php 
                            } else{
                                ?>
                                <li><a href="{{ URL::to('/show-checkout') }}"><i class="fas fa-money-bill-wave"></i> Thanh toán</a></li>
                                <?php 
                            }
                                ?>

                                <?php 
                            }else{
                                ?>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fas fa-money-bill-wave"></i> Thanh toán</a></li>
                                <?php

                            }
                                ?>
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                                <li><a href="{{ URL::to('/show-cart-ajax') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                
                                <?php 
                            }else{
                                ?>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                <?php

                            }
                                ?>
                                
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                                <li><a href="{{ URL::to('/logout-checkout') }}"><i class="fa fa-user"></i> Đăng xuất</a></li>
                                
                                <?php 
                            }else{
                                ?>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-user"></i> Đăng nhập</a></li>
                                <?php

                            }
                                ?>

                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ URL::to('/trangchu') }}" class="active">Trang Chủ</a></li>
                                {{-- <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="#">Danh mục</a></li>
                                    </ul>
                                </li>  --}}
                                {{-- <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                </li>  --}}
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                                <li><a href="{{ URL::to('/history') }}"><i ></i> Lịch sử mua hàng</a></li>
                                
                                <?php 
                            }
                                ?>
{{--                                 <li><a href="contact-us.html">Liên hệ</a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{ URL::to('/search') }}" method="post">
                            {{ csrf_field() }}
                        <div class="search_box pull-right">
                            <label><i class="fas fa-search fa-2x"><input type="text" name="keywords" placeholder="Tìm kiếm sản phẩm"/></i></label>
                            <input type="submit" style="margin-top: 0; color: black; background-color: #FF9933" name="search_item" class="btn btn-default btn-sm" value="Enter" placeholder="">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            @php
                                $i = 0;
                            @endphp
                            @foreach($slider as $key => $slide)
                            @php
                                $i++;
                            @endphp
                            <div class="item {{ $i==1 ? 'active' : '' }}">
                                
                                <div class="col-sm-12">
                                    <img style="margin-left: -48px;" src="{{ URL::to('/') }}/public/uploads/slider/{{ $slide->slider_image }}" width="100%" class="img img-responsive">
                                </div>
                                <div style="margin-left: 395px" class="col-sm-6">
                                    <p style="color: #FE980F"><b> <i>{{ $slide->slider_desc }}</i></p> </b></center>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                                @foreach($category as $key => $cate)
                                    <div class="panel panel-default">
                                       @if($cate->category_parent==0) 
                                        <div class="panel-heading">
                                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordian" href="#{{ $cate->category_id }}{{-- {{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }} --}}">
                                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                    {{ $cate->category_name }}</a></h4>
                                        </div>
                                        
                                        <div id="{{ $cate->category_id }}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul>
                                                    @foreach($category as $key => $cate_sub)
                                                        @if($cate_sub->category_parent==$cate->category_id)
                                                            <li><a href="{{ URL::to('/danh-muc-san-pham/'.$cate_sub->category_id) }}"> {{ $cate_sub->category_name }} </a></li><br>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu sản phẩm</h2>
                                @foreach($brand as $key => $brand)
                            <div class="brands-name">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a href="{{ URL::to('/thuong-hieu-san-pham/'.$brand->brand_id) }}"> <span class="pull-right">(50)</span>{{ $brand->brand_name }}</a></li>
                                    </ul>
                            </div>
                                @endforeach
                        </div>
                        
                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ ('public/frontend/images/shipping.jpg') }}" alt="" />
                        </div><!--/shipping-->
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content')
                    
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ URL::to('/public/frontend/images/iframe1.png') }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ URL::to('public/frontend/images/iframe2.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ URL::to('public/frontend/images/iframe3.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ URL::to('public/frontend/images/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{ URL::to('public/frontend/images/map.png') }}" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/lightslider.js') }}"></script>
    <script src="{{ asset('public/frontend/js/lightslider.js') }}"></script>
    <script src="{{ asset('public/frontend/js/simple.money.format.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $( "#slider-range" ).slider({
              orientation: "horizontal",
              range: true,
              min:{{ $min_price }},
              max:{{ $max_price_range }},
              step: 50000,
              values: [ {{ $min_price }}, {{ $max_price }} ],
              slide: function( event, ui ) {

                $( "#amount_start" ).val( ui.values[ 0 ]).simpleMoneyFormat();
                $( "#amount_end" ).val( ui.values[ 1 ]).simpleMoneyFormat();
                
                $( "#start_price" ).val( ui.values[ 0 ]);
                $( "#end_price" ).val( ui.values[ 1 ]);
            }
            });
    $( "#amount_start" ).val( $( "#slider-range" ).slider( "values", 0 )).simpleMoneyFormat(); 

    $( "#amount_end" ).val( $( "#slider-range" ).slider( "values", 1 )).simpleMoneyFormat(); 
        });
    </script>   

    <script>
        $(document).ready(function() {
            $('#sort').on('change',function() {
                    var url = $(this).val();
                    // alert(url);
                    if(url){
                        window.location=url;
                    }
                    return false;
            });
        });
    </script>               

    <script>
         $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:3,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }   
            });  
  });
    </script>       

    <?php
        $id = Session::get('customer_id');
        if($id != NULL){
    ?>

    <script>
        $(document).ready(function () {
            $('.xac-nhan').click(function(){
                swal({
                      title: "Xác nhận đơn hàng?",
                      text: "Đơn hàng không thể hủy bỏ sau khi nhấn xác nhận, bạn vẫn muốn đặt hàng?",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Xác nhận đặt hàng!",
                      cancelButtonText: "Tôi cần suy nghĩ thêm!",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_method = $('.payment_select').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: '{{ url('/confirm-order') }}',
                                method: 'POST',
                                data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,order_coupon:order_coupon,_token:_token,shipping_method:shipping_method},
                                success:function(){
                                    swal("Đặt hàng thành công!", "Đơn hàng của bạn đang trong quá trình xử lý, xin cảm ơn quý khách!.", "success");
                                }

                            });
                            window.setTimeout(function() {
                                location.reload();
                            }, 2000);
                           
                          } else {
                            swal("Tạm dừng", "Nếu chưa chắc chắn đơn hàng,quý khách vui lòng bỏ qua thông báo này", "error");
                          }
                      
                    });
                
            });
        });

    </script>
    <script>
        $(document).ready(function () {
            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var _token = $('input[name="_token"]').val();
                if(parseInt(cart_product_quantity) > parseInt(cart_product_qty)){
                    alert('Vui lòng đặt nhỏ hơn hoặc bằng số lượng có sẵn trong kho hiện tại: ' + cart_product_qty); 
                }else{
                $.ajax({
                    url: '{{ url('/add-cart-ajax') }}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_quantity:cart_product_quantity,_token:_token,cart_product_qty:cart_product_qty},
                    success:function(data){
                        
                        swal({
                                title: "Đã thêm thành công sản phẩm vào giỏ hàng",
                                text: "Bạn có thể tiếp tục mua hàng hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/show-cart-ajax')}}";
                            });

                        }

                    })
                };
            });
        });
    </script>
    <?php
}else{
    ?>
    <script>
        $(document).ready(function () {
            $('.add-to-cart').click(function(){
                alert('Bạn cần phải đăng nhập mới có thể sử dụng tác vụ. Xin cảm ơn!');
            });
        })
    </script>
    <?php 
    }
    ?>
</body>
</html>