 @extends('welcome')
 @section('content')



<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-sm-offset-1">
					<div class="login-form" style="margin-top: -20px"><!--login form-->
						<h2>Điền mật khẩu mới</h2>
						<span>
							@if(session()->has('mess'))
								<div class="alert alert-success">
									{!! session()->get('mess') !!}
								</div>
							@elseif(session()->has('err'))
								<div class="alert alert-danger">
									{!! session()->get('err') !!}
								</div>
							@endif
						</span>
						@php 
							$token = $_GET['token'];
							$email = $_GET['email'];
						@endphp
						<form action="{{ url('/reset-new-pass') }}" method="POST">
							{{ csrf_field() }}
							<input type="hidden" name="email" value="{{ $email }}">
							<input type="hidden" name="token" value="{{ $token }}">
							<input type="password" name="password_account" placeholder="Mật khẩu mới" value="{{ old('email_account') }}" />
							@if($errors->has('email_account'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('email_account') }}</alert></span> 
                            @endif
							
							<button type="submit" class="btn btn-default">Gửi</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

 @endsection