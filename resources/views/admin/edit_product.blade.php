@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa sản phẩm
                            <br>
                <a href="{{ URL::to('all-product') }}" title="">Danh sách sản phẩm</a>
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
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{ URL::to('update-product/'.$pro->product_id) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục" value="{{  $pro->product_name }}">
                                    @if($errors->has('product_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('product_name') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control price_format" id="exampleInputEmail1" placeholder="Nhập giá sản phẩm" value="{{  $pro->product_price }}">
                                    @if($errors->has('product_price'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('product_price') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá nhập</label>
                                    <input type="text" name="product_cost" class="form-control price_format" id="exampleInputEmail1" placeholder="Nhập giá sản phẩm" value="{{  $pro->product_cost }}">
                                    @if($errors->has('product_price'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('product_cost') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
                                    <img src="{{ URL::to('public/uploads/product/'.$pro->product_image) }}" width="100" height="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                    <input type="number" name="product_qty" class="form-control" id="exampleInputEmail1" placeholder="Nhập số lượng sản phẩm" value="{{  $pro->product_qty }}">
                                    @if($errors->has('product_qty'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('product_qty') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_decs" id="exampleInputPassword1" placeholder="Nhập mô tả" > {{  $pro->product_desc }} </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Nhập mô tả"> {{  $pro->product_content }} </textarea>
                                    @if($errors->has('product_content'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('product_content') }}</alert></span> 
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="product_cate" class="form-control m-bot15">
                                        @foreach($cate_product as $key =>$cate)
                                            @if($cate->category_id == $pro->category_id)
                                            <option selected value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                            @else
                                            <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                    <select name="product_brand" class="form-control m-bot15">
                                        @foreach($brand_product as $key =>$brand)
                                            @if($cate->category_id == $pro->category_id)
                                            <option selected value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                            @else
                                            <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tình trạng sản phẩm</label>
                                    <select name="product_status" class="form-control m-bot15">
                                        <option value="{{  $pro->product_status }}">
                                            <?php
                                                if($pro->product_status == 1){
                                                    echo "Hiển thị";
                                                } else{
                                                    echo "Ẩn";
                                                }
                                            ?>
                                        </option>
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection