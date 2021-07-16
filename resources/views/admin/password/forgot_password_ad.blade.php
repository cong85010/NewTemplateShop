<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Quên mật khẩu Admin - Design by Sang</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css') }}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css') }}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css') }}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
</head>
<body>
<div class="log-w3  background-main">
<div style="background-color: rgba(255,255,255,0.2);"  id="login_el" class="w3layouts-main">
	<h2>Quên mật khẩu - Admin<br> E-Shopper</h2>
	<?php
		$mess = Session::get('mess');	
		if($mess){
			echo $mess;
			Session::put('mess',null);
		}
	?>
			<form action="{{ url('/reset-pass-ad') }}" method="post">
			{{ csrf_field() }}
			<input type="text" class="ggg" name="email_admin" placeholder="Vui lòng điền Email admin" required="">
			<h6><a href="{{ URL::to('/admin') }}">Đăng nhập</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Gửi" name="login">
			</form>
		{{-- <p>Don't Have an Account ?<a href="registration.html">Tạo Tài Khoản</a></p> --}}
		<h3 style="color: red"><?php
		$err = Session::get('err');	
		if($err){
			echo $err;
			Session::put('err',null);
		}
	?></h3>
</div>
</div>
<script src="{{asset('public/backend/js/bootstrap.js') }}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{asset('public/backend/js/scripts.js') }}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js') }}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js') }}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js') }}"></script>
</body>
</html>
