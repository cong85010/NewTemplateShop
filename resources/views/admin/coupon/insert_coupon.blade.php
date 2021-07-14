@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Tạo mã giảm giá
                            <br>
                <a href="{{ URL::to('list-coupon') }}" title="">List giảm giá</a>
                        </header>
                        <div class="panel-body">
                            <?php
                                $mess = Session::get('mess');
                                if($mess){
                                    echo $mess;
                                    Session::put('mess',null);
                                }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{ URL::to('insert-coupon-code') }}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" value="{{-- {{ old('category_name') }} --}}">
                                    {{-- @if($errors->has('category_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('category_name') }}</alert></span> 
                                    @endif --}}
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1"  value="{{-- {{ old('category_name') }} --}}">
                                    {{-- @if($errors->has('category_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('category_name') }}</alert></span> 
                                    @endif --}}
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng mã</label>
                                    <input type="text" name="coupon_time" class="form-control" id="exampleInputEmail1"  value="{{-- {{ old('category_decs') }} --}}">
                                    {{-- @if($errors->has('category_decs'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('category_decs') }}</alert></span> 
                                    @endif --}}
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tính năng</label>
                                    <select name="coupon_condition" class="form-control m-bot15">
                                        <option value="1">Giảm theo %</option>
                                        <option value="0">Giảm theo số tiền</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số % hoặc số tiền muốn giảm</label>
                                    <input type="text" name="coupon_discount" class="form-control" id="exampleInputEmail1"  value="{{-- {{ old('category_decs') }} --}}"> </textarea>
                                   {{--  @if($errors->has('category_decs'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('category_decs') }}</alert></span> 
                                    @endif --}}
                                </div>

                                <button type="submit" class="btn btn-info">Thêm mã giảm giá </button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection