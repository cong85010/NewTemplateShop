 @extends('welcome')
 @section('content')



<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-sm-offset-1">
					<div class="login-form" style="margin-top: -20px"><!--login form-->
						<h2>Email nhận thông tin đổi mật khẩu</h2>
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
						<form action="{{ url('/reset-pass') }}" method="POST">
							{{ csrf_field() }}
							<input type="text" name="email_account" placeholder="Email đăng nhập" value="{{ old('email_account') }}" />
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