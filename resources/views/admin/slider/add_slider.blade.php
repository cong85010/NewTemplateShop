@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                <section class="panel panel-default m-3 dashboard">
                        <header class="panel-heading">
                            <p class="title_thongke">
                                Thêm Slider
                            </p>
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
                                <div class="form-group form-pad">
                                    <label for="exampleInputEmail1">Tên slider</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên thương hiệu" value="{{ old('brand_name') }}">
                                    @if($errors->has('brand_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_name') }}</alert></span> 
                                    @endif
                                </div>
                                <div style="height: 320px;" class="form-group form-pad">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" onchange="readURL(this);"  name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên thương hiệu" value="{{ old('brand_name') }}">
                                    @if($errors->has('brand_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_name') }}</alert></span> 
                                    @endif
                                    <img width="100%" height="250px" id="blah" src="" alt="your image" />
                                </div>
                                <script>
                                       function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $('#blah')
                                                    .attr('src', e.target.result);
                                            };

                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>
                                <div style="height: 100px;" class="form-group form-pad">
                                    <label for="exampleInputPassword1">Mô tả slider</label>
                                    <textarea style="resize: none" rows="3" class="form-control" name="slider_desc" id="exampleInputPassword1" placeholder="Nhập mô tả" value="{{ old('brand_decs') }}"> </textarea>
                                    @if($errors->has('brand_decs'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_decs') }}</alert></span> 
                                    @endif
                                </div>
                                <div style="margin-top: 20px;" class="form-group form-pad">
                                    <label for="exampleInputPassword1">Tình trạng</label>
                                    <select name="slide_status" class="form-control m-bot15">
                                        <option style="font-size: 18px;" value="1">Hiển thị</option>
                                        <option style="font-size: 18px;" value="0">Ẩn</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_slider" class="btn btn-info">Thêm Slider</button>
                            </form>
                            </div>
                            <a href="{{ URL::to('manage-slider') }}" title="">List Slide</a>

                        </div>
                    </section>

            </div>
@endsection