@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Slider
                            <br>
                <a href="{{ URL::to('manage-slider') }}" title="">List Slide</a>
                        </header>
                        <div class="panel-body">
                            <span style="color: green"><?php
                                $messge = Session::get('messge');
                                if($messge){
                                    echo $messge;
                                    Session::put('messge',null);
                                }
                            ?></span>
                            <div class="position-center">
                                <form role="form" action="{{ URL::to('insert-slider') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slider</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên thương hiệu" value="{{ old('brand_name') }}">
                                    @if($errors->has('brand_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_name') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên thương hiệu" value="{{ old('brand_name') }}">
                                    @if($errors->has('brand_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_name') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả slider</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="slider_desc" id="exampleInputPassword1" placeholder="Nhập mô tả" value="{{ old('brand_decs') }}"> </textarea>
                                    @if($errors->has('brand_decs'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_decs') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tình trạng</label>
                                    <select name="slide_status" class="form-control m-bot15">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_slider" class="btn btn-info">Thêm Slider</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection