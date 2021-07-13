@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa thương hiệu
                        </header>
                            <?php
                                $messge = Session::get('messge');
                                if($messge){
                                    echo $messge;
                                    Session::put('messge',null);
                                }
                            ?>
                            <div class="panel-body">
                                @foreach($edit_brand as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{ URL::to('update-brand/'.$edit_value->brand_id) }}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" value="{{ $edit_value->brand_name }}" placeholder="Nhập tên thương hiệu">
                                    @if($errors->has('brand_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_name') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="brand_decs" id="exampleInputPassword1" > {{ $edit_value->brand_desc }} </textarea>
                                     @if($errors->has('brand_decs'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_decs') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tình trạng thương hiệu</label>
                                    <select name="brand_status" class="form-control m-bot15" >
                                        <option value="{{ $edit_value->brand_status }}"></var>
                                            <?php
                                                if($edit_value->brand_status == 1)
                                                    echo "Hiển thị";
                                                else{
                                                    echo "Ẩn";
                                                }
                                            ?>
                                        </option>
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <button type="submit" name="update_brand" class="btn btn-info">Cập nhật thương hiệu</button>
                            </form>
                            </div>
                            @endforeach
                        </div>

                        {{-- <div class="panel-body">
                              
                            <div class="position-center">
                                <form role="form" action="{{ URL::to('update-brand/'.$edit_brand->brand_id) }}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" value="{{ $edit_brand->brand_name }}" placeholder="Nhập tên thương hiệu">
                                    @if($errors->has('brand_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_name') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="brand_decs" id="exampleInputPassword1" > {{ $edit_brand->brand_desc }} </textarea>
                                     @if($errors->has('brand_decs'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('brand_decs') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tình trạng thương hiệu</label>
                                    <select name="brand_status" class="form-control m-bot15" >
                                        <option value="{{ $edit_brand->brand_status }}"></var>
                                            <?php
                                                if($edit_brand->brand_status == 1)
                                                    echo "Hiển thị";
                                                else{
                                                    echo "Ẩn";
                                                }
                                            ?>
                                        </option>
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <button type="submit" name="update_brand" class="btn btn-info">Cập nhật thương hiệu</button>
                            </form>
                            </div>
                        </div> --}}
                    </section>

            </div>
@endsection