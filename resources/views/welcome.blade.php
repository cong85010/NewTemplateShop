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
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/style_template.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{asset('public/frontend/css/main_new.css')}}" rel="stylesheet">
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

</head>
<!--/head-->

<body>
    <!-- Top -->
    <div id="top">
        <div class="shell">
            <!-- Header -->
            <div id="header">
                <h1 id="logo">
                    <a href="{{ URL::to('/trangchu') }}"><img src="{{ URL::to('public/frontend/images/logo.png') }}" alt="" /></a>
                </h1>
                <div id="navigation">
                    <ul>
                        <li>
                            <a href="{{ URL::to('/trangchu') }}">Home</a>
                        </li>
                        <li><a href="#">Support</a></li>
                        <?php
                        $user = Session::get('customer_name');
                        $id = Session::get('customer_id');
                        if ($user != NULL) {
                        ?>
                            <li><a href="{{ URL::to('/profile-customer/'.Session::get('customer_id')) }}"><?php echo "$user"; ?></a></li>
                            <li><a href="#">ID: <?php echo "$id"; ?></a></li>
                        <?php
                        } else {
                        ?>

                        <?php
                        }
                        ?>
                        <li><a href="#">
                                <?php
                                $customer_id = Session::get('customer_id');
                                if ($customer_id != NULL) {
                                ?>
                        <li><a href="{{ URL::to('/logout-checkout') }}"></i> Đăng xuất</a></li>

                    <?php
                                } else {
                    ?>
                        <li><a href="{{ URL::to('/login-checkout') }}"></i> Đăng nhập</a></li>
                    <?php
                                }
                    ?>
                    </a></li>
                    <li class="last"><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Header -->
            <!-- Slider -->
            <div id="slider">
                <div id="slider-holder">
                    <ul>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($slider as $key => $slide)
                        @php
                        $i++;
                        @endphp
                        <li>
                            <div>
                                <img src="{{ URL::to('/') }}/public/uploads/slider/{{ $slide->slider_image }}" width="100%">
                            </div>
                            <div class="col-sm-6">
                                <p style="color: #FE980F"><b> <i>{{ $slide->slider_desc }}</i></p> </b></center>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div id="slider-nav">
                    <a href="#" class="prev"><img src="{{ URL::to('public/frontend/images/prev.gif') }}" alt=""></a>
                    <a href="#" class="next"><img src="{{ URL::to('public/frontend/images/next.gif') }}" alt=""></a>
                </div>
            </div>
            <!-- End SLIDER -->
        </div>
    </div>
    <!-- Top -->
    <!-- Main -->
    <div id="main">
        <div class="shell">
            <!-- Search, etc -->
            <div class="options">
                <div class="search">
                    <form action="{{ URL::to('/search') }}" method="post">
                        {{ csrf_field() }}
                        <span class="field">
                            <input class="blink" type="text" name="keywords" placeholder="Tìm kiếm sản phẩm" />
                        </span>
                        <input class="search-submit" type="submit" name="search_item" value="Go" placeholder="">
                    </form>
                </div>
                <?php
                            $customer_id = Session::get('customer_id');
                                if ($customer_id != NULL) {
                                ?>
                                    <strong><span class="left"><a href="{{ URL::to('/history') }}"><i></i> Lịch sử mua hàng</a></span></strong>
                            <?php
                            }
                            ?> 
                <?php
                $customer_id = Session::get('customer_id');
                if ($customer_id != NULL) {
                ?>
                    <div  class="right"><span class="cart"><a href="{{ URL::to('/show-cart-ajax') }}" class="cart-ico">&nbsp;</a>
                    <strong>
             <?php
                            $customer_id = Session::get('customer_id');
                            if ($customer_id != NULL) {
                            ?>
                                <?php
                                $shipping_id = Session::get('shipping_id');
                                $customer_id = Session::get('customer_id');
                                if ($customer_id != NULL && $shipping_id != NULL) {
                                ?>
                                  <span> <a href="{{ URL::to('/payment') }}"> Thanh toán</a></span>
                                <?php
                                } else if ($customer_id != NULL && $shipping_id == NULL) {
                                ?>
                                    <span><a href="{{ URL::to('/show-checkout') }}"> Thanh toán</a></span>
                                <?php
                                } else {
                                ?>
                                   <span> <a href="{{ URL::to('/show-checkout') }}"> Thanh toán</a></span>
                                <?php
                                }
                                ?>

                            <?php
                            } else {
                            ?>
                                <span><a href="{{ URL::to('/login-checkout') }}"> Thanh toán</a></span>
                            <?php

                            }
                            ?>  </strong> </span>
                        
                        </div>

                <?php
                } else {
                ?>
                    <div  class="right"><span class="cart"><a href="{{ URL::to('/login-checkout') }}" class="cart-ico">&nbsp;</a><strong><span><a href="{{ URL::to('/login-checkout') }}"> Thanh toán</a></span></strong> </span><span class="left more-links"> 
                    </div>
                <?php

                }
                ?>
            </div>
            <!-- End Search, etc -->
            <!-- Content -->
            <div id="content">
                <!-- Tabs -->
                <div class="tabs">
                    <ul>
                        <li><a href="#" class="active"><span>Mục chính</span></a></li>
                        <li><a href="#"><span>Danh mục sản phẩm</span></a></li>
                        <li><a href="#" class="red"><span>Thương hiệu</span></a></li>
                    </ul>
                </div>
                <!-- Tabs -->
                <!-- Container -->
                <div id="container">
                    <div class="tabbed">
                        <!-- First Tab Content -->
                        <div class="tab-content" style="display:block;">
                            <div class="items">
                                <div class="cl">&nbsp;</div>
                                    @yield('content')
                                <div class="cl">&nbsp;</div>
                            </div>
                        </div>
                        <!-- End First Tab Content -->
                        <!-- Second Tab Content -->
                        <div class="tab-content">
                            <div class="items">
                                <div class="cl">&nbsp;</div>
                                <div class="panel-group category-products" id="accordian">
                                    <!--category-productsr-->
                                    <h2 class="title text-center">Danh mục sản phẩm</h2>
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
                                <div class="cl">&nbsp;</div>
                            </div>
                        </div>
                        <!-- End Second Tab Content -->
                        <!-- Third Tab Content -->
                        <div class="tab-content">
                            <div class="items">
                                <div class="cl">&nbsp;</div>
                                <div class="brands_products">
                            <!--brands_products-->
                                    <h2 class="title">Thương hiệu sản phẩm</h2>
                                    <div class="list-branch">
                                        @foreach($brand as $key => $brand)
                                        <div class="brands-name">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="{{ URL::to('/thuong-hieu-san-pham/'.$brand->brand_id) }}"> <span class="pull-right">(50)</span>{{ $brand->brand_name }}</a></li>
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="shipping text-center">
                                    <!--shipping-->
                                    <img src="{{ ('public/frontend/images/shipping.jpg') }}" alt="" />
                                </div>
                                <!--/shipping-->
                                <div class="cl">&nbsp;</div>
                            </div>
                        </div>
                        <!-- End Third Tab Content -->
                    </div>
                    <!-- Footer -->
                    <div id="footer">
                        <div class="left"> <a href="#">Home</a> <span>|</span> <a href="#">Support</a> <span>|</span> <a href="#">My Account</a> <span>|</span> <a href="#">The Store</a> <span>|</span> <a href="#">Contact</a> </div>
                        <div class="right"> &copy; Sitename.com. Design by <a href="http://chocotemplates.com">ChocoTemplates.com</a> </div>
                    </div>
                    <!-- End Footer -->
                </div>
                <!-- End Container -->
            </div>
            <!-- End Content -->
        </div>
    </div>
    

    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/simple.money.format.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('public/frontend/js/jquery-1.4.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/frontend/js/jquery.jcarousel.pack.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/frontend/js/jquery.slide.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/frontend/js/jquery-func.js') }}" type="text/javascript"></script>


    <script>
        $(document).ready(function() {
            $('#sort').change(function() {
                var url = $(this).val();
                // alert(url);
                if (url) {
                    window.location = url;
                }
                return false;
            });
        });
    </script>
<!-- 
    <script>
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 3,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script> -->

    <?php
    $id = Session::get('customer_id');
    if ($id != NULL) {
    ?>

        <script>
            $(document).ready(function() {
                $('.xac-nhan').click(function() {
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
                        function(isConfirm) {
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
                                    url: '{{ url(' / confirm - order ') }}',
                                    method: 'POST',
                                    data: {
                                        shipping_email: shipping_email,
                                        shipping_name: shipping_name,
                                        shipping_address: shipping_address,
                                        shipping_phone: shipping_phone,
                                        shipping_notes: shipping_notes,
                                        order_coupon: order_coupon,
                                        _token: _token,
                                        shipping_method: shipping_method
                                    },
                                    success: function() {
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
            $(document).ready(function() {
                $('.add-to-cart').click(function() {
                    var id = $(this).data('id_product');
                    var cart_product_id = $('.cart_product_id_' + id).val();
                    var cart_product_name = $('.cart_product_name_' + id).val();
                    var cart_product_image = $('.cart_product_image_' + id).val();
                    var cart_product_qty = $('.cart_product_qty_' + id).val();
                    var cart_product_price = $('.cart_product_price_' + id).val();
                    var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                    var _token = $('input[name="_token"]').val();
                    if (parseInt(cart_product_quantity) > parseInt(cart_product_qty)) {
                        alert('Vui lòng đặt nhỏ hơn hoặc bằng số lượng có sẵn trong kho hiện tại: ' + cart_product_qty);
                    } else {
                        $.ajax({
                            url: '{url(" / add - cart - ajax ")}',
                            method: 'POST',
                            data: {
                                cart_product_id: cart_product_id,
                                cart_product_name: cart_product_name,
                                cart_product_image: cart_product_image,
                                cart_product_price: cart_product_price,
                                cart_product_quantity: cart_product_quantity,
                                _token: _token,
                                cart_product_qty: cart_product_qty
                            },
                            success: function(data) {

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
    } else {
    ?>
        <script>
            $(document).ready(function() {
                $('.add-to-cart').click(function() {
                    alert('Bạn cần phải đăng nhập mới có thể sử dụng tác vụ. Xin cảm ơn!');
                });
            })
        </script>
    <?php
    }
    ?>
</body>

</html>