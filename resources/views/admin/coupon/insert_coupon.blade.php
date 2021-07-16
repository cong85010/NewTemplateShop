@extends('admin_layout')
@section('admin_content')
<div class="">
            <div style="margin: 45px;" class="dashboard">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            <p class="title_thongke">
                                Tạo mã giảm giá
                            </p>
                            <br>
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
                                <div style="margin-top: 30px;" class="form-group form-pad">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" value="{{-- {{ old('category_name') }} --}}">
                                    {{-- @if($errors->has('category_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('category_name') }}</alert></span> 
                                    @endif --}}
                                </div>

                                <div class="form-group form-pad">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1"  value="{{-- {{ old('category_name') }} --}}">
                                    {{-- @if($errors->has('category_name'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('category_name') }}</alert></span> 
                                    @endif --}}
                                </div>

                                <div class="form-group form-pad">
                                    <label for="exampleInputPassword1">Số lượng mã</label>
                                    <input type="number" name="coupon_time" class="form-control" id="exampleInputEmail1"  value="{{-- {{ old('category_decs') }} --}}">
                                    {{-- @if($errors->has('category_decs'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('category_decs') }}</alert></span> 
                                    @endif --}}
                                </div>

                                <div class="form-group form-pad">
                                    <label for="exampleInputPassword1">Tính năng</label>
                                    <select name="coupon_condition" class="form-control m-bot15">
                                        <option style="font-size: 18px;" value="1">Giảm theo %</option>
                                        <option style="font-size: 18px;" value="0">Giảm theo số tiền</option>
                                    </select>
                                </div>

                                <div class="form-group form-pad">
                                    <label for="exampleInputPassword1">Số % hoặc số tiền muốn giảm</label>
                                    <input type="number" name="coupon_discount" class="form-control" id="exampleInputEmail1"  value="{{-- {{ old('category_decs') }} --}}"> </textarea>
                                   {{--  @if($errors->has('category_decs'))
                                        <span class="help-block"><alert class="text-danger">{{ $errors->first('category_decs') }}</alert></span> 
                                    @endif --}}
                                </div>

                                <button type="submit" class="btn btn-info">Thêm mã giảm giá </button>
                            </form>
                            </div>
                            <a href="{{ URL::to('list-coupon') }}" title="">List giảm giá</a>

                        </div>
                    </section>

            </div>
@endsection