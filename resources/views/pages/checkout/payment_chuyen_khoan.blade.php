 @extends('welcome')
 @section('content')
 	<form action="{{ URL::to('/finish-order') }}" method="get">
 		<h4 style="color: red">Quý khách vui lòng chuyển khoản theo số tài khoản phía dưới: ↓</h4>
 		<h4>	
 			0123456789<br>
 			ABC<br>
 			Ngân hàng ACB chi nhánh CBA<br>
 		</h4>
 		<h4 style="color: red">Quý khách vui lòng chỉ ấn "Xác Nhận" sau khi đã chuyển khoản, chúng tôi sẽ kiểm tra hệ thống và liên hệ lại trong thời gian sớm nhất để xác nhận đơn hàng của quý khách. Xin chân thành cảm ơn!</h4>
 		<input type="submit" name="finish" value="Xác nhận" class="btn btn-primary btn-sm" placeholder="">
 	</form>
 @endsection