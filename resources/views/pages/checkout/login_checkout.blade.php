 @extends('welcome')
 @section('content')

<?php 
	$mess = Session::get('customer_name');
	if($mess ==NULL){
?>
	<h4 style="color: red">Quý khách vui lòng kéo xuống ĐĂNG NHẬP hoặc ĐĂNG KÝ để sử dụng tác vụ. E-Shop xin cảm ơn! </h4>
<?php	
	}
?>

<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản của bạn</h2>
						<span style="color: red">@php
							$err_log = Session::get('err_log');
							if($err_log){
								echo $err_log;
								Session::put('err_log',null);
							}
						@endphp</span>
						<form action="{{ URL::to('/login-customer') }}" method="POST">
							{{ csrf_field() }}
							<input type="text" name="email_account" placeholder="Email đăng nhập" value="{{ old('email_account') }}" />
							@if($errors->has('email_account'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('email_account') }}</alert></span> 
                            @endif
							<input type="password" name="password_account" placeholder="Mật khẩu" value="{{ old('password_account') }}" />
							@if($errors->has('password_account'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('password_account') }}</alert></span> 
                            @endif
                            <span>
                            	<a href="{{ URL::to('/quen-mat-khau') }}" title="">Quên mật khẩu</a>
                            </span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký</h2>
						@php
							$succ = Session::get('succ');
							if($succ){
								echo $succ;
								Session::put('succ',null);
							}
						@endphp
						<form action="{{ URL::to('/add-customer') }}" method="post">
							{{ csrf_field() }}
							<input type="text" name="customer_name" placeholder="Họ và tên" value="{{ old('customer_name') }}"/>
							@if($errors->has('customer_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('customer_name') }}</alert></span> 
                            @endif
                            <input type="number" name="customer_phone" placeholder="Phone" value="{{ old('customer_phone') }}"/>
                            @if($errors->has('customer_phone'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('customer_phone') }}</alert></span> 
                            @endif
							<input type="email" name="customer_email" placeholder="Email" value="{{ old('customer_email') }}"/>
							@if($errors->has('customer_email'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('customer_email') }}</alert></span> 
                            @endif
							<input type="password" name="customer_password" placeholder="Mật khẩu"/>
							@if($errors->has('customer_password'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('customer_password') }}</alert></span> 
                            @endif
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

 @endsection