<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- bootstrap-css -->
	<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css') }}" >
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="{{asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
	<link href="{{asset('public/backend/css/style-responsive.css') }}" rel="stylesheet"/>
	<!-- font CSS -->
	<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css?fbclid=IwAR2hW-UVKVzrY8wv5mhLirtIbqHtuWpOsEqiOtaoqftHoN8xJ09cuQJdNV4' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="{{asset('public/backend/css/font.css') }}" type="text/css"/>
	<link href="{{asset('public/backend/css/font-awesome.css') }}" rel="stylesheet"> 
	<link rel="stylesheet" href="{{asset('public/backend/css/morris.css') }}" type="text/css"/>
	<!-- calendar -->
	<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css') }}">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<!-- //calendar -->
	<!-- //font-awesome icons -->
	<script src="{{asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
	<script src="{{asset('public/backend/js/raphael-min.js') }}"></script>
	<script src="{{asset('public/backend/js/morris.js') }}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{ URL::to('admin-dashboard') }}" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="top-nav clearfix text-right">
	<h4><a style="padding: 10px; background-color: #d9534f; color: white;" href="{{ URL::to('/logout') }}">Đăng xuất</a></h4>
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
				<div class="sidebar-img flex-center" style="flex-direction: column;">
					<a href="{{ URL::to('/profile_admin/'.Session::get('admin_id')) }}">
						<img src="{{ asset('public/backend/images/find_user.png') }}" alt=""/>
						<div>
							<h3 class="text-danger text-center">
							<?php 
							$name = Session::get('admin_name');
							if($name){
								echo $name;
							}
						?></h3>
						</div>
					</a>
				</div>
                <li>
                    <a class="active" href="{{ URL::to('admin-dashboard') }}">
                        <i class="fa fa-dashboard fa-3x"></i>
                        <span>Tổng Quan</span>
                    </a>
                </li>  

                <li class="sub-menu">
                    <a href="javascript:;">
                       <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>Banner</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/manage-slider') }}">Quản lý Banner</a></li>
						<li><a href="{{ URL::to('/add-slider') }}">Thêm Banner</a></li>
						
                    </ul>
                </li>
                
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-dropbox" aria-hidden="true"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/manage-order') }}">Quản lý đơn hàng</a></li>
						
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tag" aria-hidden="true"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/insert-coupon') }}">Thêm mã giảm giá</a></li>
						<li><a href="{{ URL::to('/list-coupon') }}">Danh sách mã giảm giá</a></li>
						
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                       <i class="fas fa-boxes    "></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/add-category-product') }}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{ URL::to('/all-category-product') }}">Liệt kê danh mục sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                      	<i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/add-brand') }}">Thêm thương hiệu</a></li>
						<li><a href="{{ URL::to('/all-brand') }}">Liệt kê thương hiệu</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-archive" aria-hidden="true"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/add-product') }}">Thêm sản phẩm</a></li>
						<li><a href="{{ URL::to('/all-product') }}">Liệt kê sản phẩm</a></li>
                    </ul>
                </li>
                </ul> </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        @yield('admin_content')
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>GTO shop - Chuyên đồ gia dụng cao cấp <a href="#">GTO SHOP </a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js') }}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{asset('public/backend/js/scripts.js') }}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js') }}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js') }}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js') }}"></script>
<script src="{{asset('public/backend/js/formValidation.min.js') }}"></script>
<script src="{{asset('public/backend/js/simple.money.format.js') }}"></script>	
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

{{-- <script>
	CKEDITOR.replace('ckeditor1');
</script> --}}

<script>
    $(document).ready(function(){
        load_gallery();

        function load_gallery(){
                var pro_id = $('.pro_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                	url:"{{ url('/select-gallery') }}",
                	method:"POST",
                	data:{pro_id:pro_id,_token:_token},
                	success:function(data) {
                			$('#gallery_load').html(data);
                	}
                });
        }

        $('#file').change(function() {
        		var error ='';
        		var files = $('#file')[0].files;

        		if(files.length>5){
        			error+='<p> Vui lòng chọn tối đa 5 ảnh </p>'
        		}else if(files.length==''){
        			error+='<p> Không được để trống </p>'
        		}else if(files.size > 2000000){
        			err+='<p>File ảnh không được lớn hơn hoặc bằng 2mb</p>'
        		}

        		if(error==''){
        			
        		}
        		else{
        			$('#file').val('');
        			$('#error_gallery').html('<span class="text-danger">'+error+'</span>');
        			return false; 
        		}


        })

        $(document).on('click','.delete-gallery',function(){
        	var gal_id = $(this).data('gal_id');

        	var _token = $('input[name="_token"').val();
        	if(confirm('Bạn muốn xóa mục này?')){
        		$.ajax({
        			url:"{{ url('/delete-gallery') }}",
        			method:"POST",
        			data:{gal_id:gal_id,_token:_token},
        			success:function(data) {
        					load_gallery();
        					$('#error_gallery').html('<span class="text-danger">Xóa ảnh thành công</span>');
        			}
        		});
        	}
        });


        $(document).on('change','.file_image',function(){
        	var gal_id = $(this).data('gal_id');
        	var image = document.getElementById("file-"+gal_id).files[0];

        	var form_data = new FormData();

        	form_data.append("file", document.getElementById("file-"+gal_id).files[0]);
        	form_data.append("gal_id",gal_id);

        	
        		$.ajax({
        			url:"{{url('/update-gallery') }}",
        			method:"POST",
        			headers:{
        				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        			},
        			data:form_data,
        			contentType:false,
        			cache:false,
        			processData:false,
        			success:function(data) {
        					load_gallery();
        					$('#error_gallery').html('<span class="text-danger">Cập nhật ảnh thành công</span>');
        			}
        		});
        });
    });    


</script>

<script type="text/javascript">
	$('.price_format').simpleMoneyFormat();

</script>

<script type="text/javascript">
	$(document).ready(function() {
		chart30days();

		var chart = new Morris.Area({
			  // ID of the element in which to draw the chart.
			  element: 'chart',
			  // Chart data records -- each entry in this array corresponds to a point on
			  // the chart.
			  lineColors:['#819C79','#fc8710','#FF6541','#A4ADD3','#766B56'],
			  pointFillColors: ['#ffffff'],
			  pointStrokeColors: ['black'],
			  	fillOpacity:0.3,
			  	hideHover:'auto',
			  	parseTime: false,
			  	hideHover:'auto',
			  // The name of the data record attribute that contains x-values.
			  xkey: 'period',
			  // A list of names of data record attributes that contain y-values.
			  ykeys: ['order','sales','profit','quantity'],
			  behaveLikeLine:true,
			  labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
			  // Labels for the ykeys -- will be displayed when you hover over the
			  // chart.
			});

		function chart30days() {
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url:"{{ url('/day-order-30') }}",
				method:"POST",
				dataType:"JSON",
				data:{_token:_token},

				success:function(data) {
					chart.setData(data);
				}
			});
		}
		
		$('.dashboard-filter').change(function() {
			var dashboard_value = $(this).val();
			var _token = $('input[name="_token"]').val();
			// alert(dashboard_value);
			$.ajax({
				url:"{{ url('/dashboard-filter') }}",
				method:"POST",
				dataType:"JSON",
				data:{dashboard_value:dashboard_value, _token:_token},

				success:function(data) {
					chart.setData(data);
				}
			});
		});

		$('#btn-dashboard-filter').click(function() {
			var _token = $('input[name="_token"]').val();
			var from_date = $('#datepicker').val();
			var to_date = $('#datepicker2').val();
			// alert(from_date);
			// alert(to_date);
			$.ajax({
				url:"{{ url('/filter-by-date') }}",
				method:"POST",
				dataType:"JSON",
				data:{from_date:from_date, to_date:to_date, _token:_token},

				success:function(data) {
					chart.setData(data);

				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker({
			prevText:"Tháng trước",
			nextText:"Tháng sau",
			dateFormat:"yy-mm-dd",
			dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","CN"],
			duration:"slow"
		});
		$("#datepicker2").datepicker({
			prevText:"Tháng trước",
			nextText:"Tháng sau",
			dateFormat:"yy-mm-dd",
			dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","CN"],
			duration:"slow"
		});
	});
</script>



<script type="text/javascript">
	$('.update_qty_order').click(function() {
		var order_product_id = $(this).data('product_id');
		var order_qty = $('.order_qty_'+order_product_id).val();
		var order_code = $('.order_code').val();
		var _token = $('input[name="_token"]').val();
		// alert(order_product_id);
		// alert(order_qty);
		// alert(order_code);
		$.ajax({
			url : '{{ url('/update-qty') }}',
			method: 'POST',
			data:{_token:_token, order_product_id:order_product_id, order_code:order_code, order_qty:order_qty},
			success:function(data) {
				alert('Cập nhật số lượng thành công');
				location.reload();
			}
		})
	})
</script>

<script type="text/javascript">
	$('.order_details').change(function() {
		var order_status = $(this).val();
		var order_id = $(this).children(":selected").attr("id");
		var _token = $('input[name="_token"]').val();

		//lay ra so luong
		quantity = [];
		$("input[name='product_sale_qty']").each(function() {
			quantity.push($(this).val());
		});
		//lay ra product id de so sanh
		order_product_id = [];
		$("input[name='order_product_id']").each(function() {
			order_product_id.push($(this).val());
		});
		if(order_status == 2){
			j = 0;
			for(i = 0; i<order_product_id.length; i++){
				var order_qty = $('.order_qty_' + order_product_id[i]).val();
				var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
				if(parseInt(order_qty) > parseInt(order_qty_storage)){
					j = j+1;
					if(j==1){
					alert('Số lượng tồn kho không đủ, vui lòng kiểm tra lại');
					}
					$('.color_qty_'+order_product_id[i]).css('background','#FF3030');
				}
			}
			if(j == 0){
				$.ajax({
				url : '{{ url('/update-order-qty') }}',
				method: 'POST',
				data:{_token:_token, order_status:order_status, order_id:order_id, quantity:quantity, order_product_id:order_product_id},
				success:function(data) {
					alert('Cập nhật tình trạng thành công');
					location.reload();
				}
			})
			}

		}else{
		$.ajax({
				url : '{{ url('/update-order-qty') }}',
				method: 'POST',
				data:{_token:_token, order_status:order_status, order_id:order_id, quantity:quantity, order_product_id:order_product_id},
				success:function(data) {
					alert('Cập nhật tình trạng thành công');
					location.reload();
				}
			})
			
		}
	});
</script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js') }}"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js') }}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
