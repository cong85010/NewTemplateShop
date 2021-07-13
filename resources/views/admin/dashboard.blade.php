@extends('admin_layout')
@section('admin_content')	  

<div class="container-fluid">
	<style type="text/css">
		p.title_thongke{
			text-align: center;
			font-size: 20px;
			font-weight: bold;
		}
	</style>
</div>

<div class="row">
	<p class="title_thongke">Thống kê doanh số</p>

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
</div>

<div class="row">
	<style type="text/css" media="screen">
		table.table.table-bordered.table-dark{
			background: #32383e;
		}
		table.table.table-bordered.table-dark tr th{
			color: #fff;
		}
	</style>
	<p class="title_thongke">Thống kê truy cập</p>
	<table class="table table-bordered table-dark">
		<thead>
			<tr>
				<th scope="col">Đang online</th>
				<th scope="col">Tổng tháng trước</th>
				<th scope="col">Tổng tháng này</th>
				<th scope="col">Tổng một năm</th>
				<th scope="col">Tổng truy cập</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				{{-- <td>20</td>
				<td>100</td>
				<td>50</td>
				<td>2000</td>
				<td>10000</td> --}}
				<td>{{ $visitor_count }}</td>
				<td>{{ $visitors_last_month_count }}</td>
				<td>{{ $visitors_this_month_count }}</td>
				<td>{{ $visitors_year_count }}</td>
				<td>{{ $visitor_total }}</td>
			</tr>
		</tbody>		
	</table>
</div>

<div class="row" style="margin-left:355px;">
	<style type="text/css" media="screen">
		ol.list_views{
			color:#fff;
			margin: 10px 0;
		}
		ol.list_views a{
			color: orange;
			font-weight: 400;
		}
	</style>
	<h3>Top 10 sản phẩm được xem nhiều nhất</h3>

	<ol class="list_views">
		@foreach($product_views as $key => $pro)
			<li>
				<a target="blank" href="{{ url('/chi-tiet-san-pham/'.$pro->product_id) }}">{{ $pro->product_name }} | <span style="color: black">{{ $pro->product_views }}</span></a>
			</li>
		@endforeach
	</ol>
</div>

@endsection