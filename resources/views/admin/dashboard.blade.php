@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">

</div>

<div class="row dashboard">
	<div class="dashboard_hello">
		<h2>Admin Dashboard</h2>
		<p>Xin chào
			<span><?php
					$name = Session::get('admin_name');
					if ($name) {
						echo $name;
					}
					?></span> , rất vui khi gặp lại bạn.
		</p>
	</div>
	<div class="row" style="margin: 20px 0;">
		<p class="title_thongke">Thống kê truy cập</p>
		<div style="width: 20%;" class="col-md-2 col-sm-6 col-xs-6">
			<div class="panel panel-back noti-box">
				<span class="icon-box bg-color-red set-icon">
					<i class="fa fa-globe" aria-hidden="true"></i>
				</span>
				<div class="text-box">
					<p class="main-text">Hiện tại</p>
					<p class="text-muted">{{ $visitor_count }}</p>
				</div>
			</div>
		</div>
		<div style="width: 20%;" class="col-md-2 col-sm-6 col-xs-6">
			<div class="panel panel-back noti-box">
				<span class="icon-box bg-color-green set-icon">
					<i class="fa fa-bars"></i>
				</span>
				<div class="text-box">
					<p class="main-text">Tháng trước</p>
					<p class="text-muted">{{ $visitors_last_month_count }}</p>
				</div>
			</div>
		</div>
		<div style="width: 20%;" class="col-md-3 col-sm-6 col-xs-6">
			<div class="panel panel-back noti-box">
				<span class="icon-box bg-color-blue set-icon">
					<i class="fa fa-calendar" aria-hidden="true"></i>
				</span>
				<div class="text-box">
					<p class="main-text">Tháng này</p>
					<p class="text-muted">{{ $visitors_this_month_count }}</p>
				</div>
			</div>
		</div>
		<div style="width: 20%;" class="col-md-3 col-sm-6 col-xs-6">
			<div class="panel panel-back noti-box">
				<span class="icon-box bg-color-brown set-icon">
					<i class="fas fa-globe"></i>
				</span>
				<div class="text-box">
					<p class="main-text">Năm nay</p>
					<p class="text-muted">{{ $visitors_year_count }}</p>
				</div>
			</div>
		</div>
		<div style="width: 20%;" class="col-md-2 col-sm-6 col-xs-6">
			<div class="panel panel-back noti-box">
				<span class="icon-box bg-color-brown set-icon">
					<i class="fa fa-rocket"></i>
				</span>
				<div class="text-box">
					<p class="main-text">Tất cả</p>
					<p class="text-muted">{{ $visitor_total }}</p>
				</div>
			</div>
		</div>
	</div>
	<!-- /. ROW  -->
	<p style="margin-top: 30px;" class="title_thongke">Thống kê doanh số</p>
	<form autocomplete="off">
		@csrf
		<div class="col-md-2">
			<p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
			<input type="button" name="" value="Lọc kết quả" class="btn btn-primary btn-sm" id="btn-dashboard-filter">
		</div>

		<div class="col-md-2">
			<p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
		</div>

		<div class="col-md-2">
			<p>
				Lọc theo:
				<select class="dashboard-filter form-control">
					<option value="">------ Chọn ------</option>
					<option value="homnay">Hôm nay</option>
					<option value="homqua">Hôm qua</option>
					<option value="7ngay">7 ngày</option>
					<option value="thangnay">Tháng này</option>
					<option value="thangtruoc">Tháng trước</option>
					<option value="365ngayqua">365 ngày qua</option>
				</select>
			</p>
		</div>
	</form>
	<div class="col-md-12">
		<div id="chart" style="height: 300px;"></div>
	</div>
	<div  style="margin-top: 30px;" class="col-md-12">
		<p class="title_thongke">
		Top 10 sản phẩm được xem nhiều nhất
		</p>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên sản phẩm</th>
						<th>Số lượng</th>
						<th>Xem chi tiết</th>
					</tr>
				</thead>
				<tbody class="table_thongke">
				@php
				$i = 0;
				@endphp
				@foreach($product_views as $key => $pro)
				@php
					$i++;
				@endphp
					<tr>
						<td>{{ $i }}</td>
						<td style="font-weight: bold;">{{ $pro->product_name }}</td>
						<td>{{ $pro->product_views }}</td>
						<td><a target="blank" href="{{ url('/chi-tiet-san-pham/'.$pro->product_id) }}">Xem chi tiết</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection