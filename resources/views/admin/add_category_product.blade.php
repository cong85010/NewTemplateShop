@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel panel-default dashboard">
            <header class="panel-heading">
                <p class="title_thongke">
                    Thêm danh mục sản phẩm
                </p>
            </header>
            <div class="panel-body">
                <?php
                $messge = Session::get('messge');
                if ($messge) {
                    echo $messge;
                    Session::put('messge', null);
                }
                ?>
                <div class="position-center">
                    <form role="form" action="{{ URL::to('save-category') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group form-pad">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục" value="{{ old('category_name') }}">
                            @if($errors->has('category_name'))
                            <span class="help-block">
                                <alert class="text-danger">{{ $errors->first('category_name') }}</alert>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-pad">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="category_decs" id="exampleInputPassword1" placeholder="Nhập mô tả" value="{{ old('category_decs') }}"> </textarea>
                            @if($errors->has('category_decs'))
                            <span class="help-block">
                                <alert class="text-danger">{{ $errors->first('category_decs') }}</alert>
                            </span>
                            @endif
                        </div>
                        <div class="form-group form-pad " style="margin-top:70px;">
                            <label for="exampleInputPassword1">Thuộc danh mục</label>
                            <select name="category_parent" class="form-control m-bot15">
                                <option value="0">Danh mục lớn</option>
                                @foreach($category as $key => $parent)
                                <option value="{{ $parent->category_id }}">{{ $parent->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-pad">
                            <label for="exampleInputPassword1">Tình trạng danh mục</label>
                            <select name="category_status" class="form-control m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>
                <a href="{{ URL::to('all-category-product') }}" title="">List Danh mục</a>
            </div>
        </section>

    </div>
    @endsection