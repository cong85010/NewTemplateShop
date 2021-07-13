@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa danh mục sản phẩm
                        </header>
                            <?php
                                $messge = Session::get('messge');
                                if($messge){
                                    echo $messge;
                                    Session::put('messge',null);
                                }
                            ?>
                            <div class="panel-body">
                                @foreach($edit_category_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{ URL::to('update-category-product/'.$edit_value->category_id) }}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" value="{{ $edit_value->category_name }}" placeholder="Nhập tên danh mục">
                                    @if($errors->has('category_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('category_name') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="category_decs" id="exampleInputPassword1" > {{ $edit_value->category_desc }} </textarea>
                                    @if($errors->has('category_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('category_name') }}</alert></span> 
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thuộc danh mục</label>
                                    <select name="category_parent" class="form-control m-bot15">
                                        <option value="0">------------- Danh mục lớn -------------</option>
                                        @foreach($category as $key => $parent)
                                            @if($parent->category_parent==0)
                                                <option {{ ($parent->category_id==$edit_value->category_id ? 'selected' : '') }} value="{{ $parent->category_id }}">- {{ $parent->category_name }}</option>
                                            @endif
                                            @foreach($category as $key => $parent2)
                                                @if($parent2->category_parent==$parent->category_id)
                                                 <option {{ ($parent2->category_id==$edit_value->category_id ? 'selected' : '') }} value="{{ $parent2->category_id }}">--- {{ $parent2->category_name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tình trạng danh mục</label>
                                    <select name="category_status" class="form-control m-bot15" >
                                        <option value="{{ $edit_value->category_status }}"></var>
                                            <?php
                                                if($edit_value->category_status == 1)
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
                                <button type="submit" name="update_category" class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection