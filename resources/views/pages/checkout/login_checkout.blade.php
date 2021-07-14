 @extends('welcome')
 @section('content')

 <?php
	$mess = Session::get('customer_name');
	if ($mess == NULL) {
	?>
 	<h4 style="color: red">Quý khách vui lòng kéo xuống ĐĂNG NHẬP hoặc ĐĂNG KÝ để sử dụng tác vụ. E-Shop xin cảm ơn! </h4>
 <?php
	}
	?>

 <section class="forms-section">
 	<div class="forms">
 		<div class="form-wrapper is-active">
 			<button type="button" class="switcher switcher-login">
 				Đăng nhập
 				<span class="underline"></span>
 			</button>
 			<span style="color: red">@php
 				$err_log = Session::get('err_log');
 				if($err_log){
 				echo $err_log;
 				Session::put('err_log',null);
 				}
 				@endphp</span>
 			<form action="{{ URL::to('/login-customer') }}" method="POST" class="form form-login">
 				{{ csrf_field() }}
 				<fieldset>
 					<legend>Vui lòng nhập thông tin</legend>
 					<div class="input-block">
 						<label for="login-email">E-mail</label>
 						<input name="email_account" id="login-email" type="email" value="{{ old('email_account') }}" required>
 						@if($errors->has('email_account'))
 						<span class="help-block">
 							<alert class="text-danger">{{ $errors->first('email_account') }}</alert>
 						</span>
 						@endif
 					</div>
 					<div class="input-block">
 						<label for="login-password">Password</label>
 						<input name="password_account" id="login-password" type="password" value="{{ old('password_account') }}" required>
 						@if($errors->has('password_account'))
 						<span class="help-block">
 							<alert class="text-danger">{{ $errors->first('password_account') }}</alert>
 						</span>
 						@endif
 						<span>
 							<a href="{{ URL::to('/quen-mat-khau') }}" title="">Quên mật khẩu</a>
 						</span>
 					</div>
 				</fieldset>
 				<button type="submit" class="btn-login">Đăng nhập</button>
 			</form>
 		</div>
 		<div class="form-wrapper">
 			<button type="button" class="switcher switcher-signup">
 				Đăng ký
 				<span class="underline"></span>
 			</button>
 			<h5>
				@php
				$succ = Session::get('succ');
				if($succ){
					echo $succ;
					Session::put('succ',null);
				}
				@endphp
			 </h5>
 			<form action="{{ URL::to('/add-customer') }}" method="post" class="form form-signup">
 				{{ csrf_field() }}
 				<fieldset>
 					<legend>Vui lòng nhập thông tin.</legend>
 					<div class="input-block">
 						<label for="hoten">Họ tên</label>
 						<input id="hoten" type="text" name="customer_name" placeholder="Họ và tên" value="{{ old('customer_name') }}" />
 						@if($errors->has('customer_name'))
 						<span class="help-block">
 							<alert class="text-danger">{{ $errors->first('customer_name') }}</alert>
 						</span>
 						@endif
 					</div>
 					<div class="input-block">
 						<label for="phone">Phone</label>
 						<input id="phone" type="number" name="customer_phone" placeholder="Phone" value="{{ old('customer_phone') }}" />
 						@if($errors->has('customer_phone'))
 						<span class="help-block">
 							<alert class="text-danger">{{ $errors->first('customer_phone') }}</alert>
 						</span>
 						@endif
 					</div>
 					<div class="input-block">
 						<label for="signup-email">E-mail</label>
 						<input name="customer_email" id="signup-email" type="email" value="{{ old('email_account') }}" required>
 						@if($errors->has('customer_email'))
 						<span class="help-block">
 							<alert class="text-danger">{{ $errors->first('customer_email') }}</alert>
 						</span>
 						@endif
 					</div>
 					<div class="input-block">
 						<label for="signup-password">Password</label>
 						<input name="customer_password" id="signup-password" type="password" required>
 						@if($errors->has('customer_password'))
 						<span class="help-block">
 							<alert class="text-danger">{{ $errors->first('customer_password') }}</alert>
 						</span>
 						@endif
 					</div>
 				</fieldset>
 				<button type="submit" class="btn-signup">Đăng ký</button>
 			</form>
 		</div>
 	</div>
 </section>
 <script>
 	const switchers = [...document.querySelectorAll('.switcher')]

 	switchers.forEach(item => {
 		item.addEventListener('click', function() {
 			switchers.forEach(item => item.parentElement.classList.remove('is-active'))
 			this.parentElement.classList.add('is-active')
 		})
 	})
 </script>

 @endsection