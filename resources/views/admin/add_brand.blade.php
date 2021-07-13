@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thương hiệu sản phẩm
                            <br>
                <a href="{{ URL::to('all-brand') }}" title="">List thương hiệu</a>
                        </header>
                        <div class="panel-body">
                            <?php
                                $messge = Session::get('messge');
                                if($messge){
                                    echo $messge;
                                    Session::put('messge',null);
                                }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{ URL::to('save-brand') }}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên thương hiệu" value="{{ old('brand_name') }}">
                                    @if($errors->has('brand_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_name') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="brand_decs" id="exampleInputPassword1" placeholder="Nhập mô tả" value="{{ old('brand_decs') }}"> </textarea>
                                    @if($errors->has('brand_decs'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_decs') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tình trạng</label>
                                    <select name="brand_status" class="form-control m-bot15">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info">Thêm thương hiệu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection