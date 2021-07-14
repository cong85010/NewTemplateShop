@extends('admin_layout')
@section('admin_content')
                        <header class="panel-heading">
                            Thông tin Admin
                        </header>
                        <?php
                                $messge = Session::get('messge');
                                if($messge){
                                    echo $messge;
                                    Session::put('messge',null);
                                }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_admin as $key => $edit_value)
                            <div class="form">
                                <form class="cmxform form-horizontal " id="signupForm" method="get" action="{{ URL::to('update_admin/'.$edit_value->admin_id) }}" novalidate="novalidate">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Tên Admin</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="firstname" value="{{ $edit_value->admin_name }}" name="firstname" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Số điện thoại</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="phone" value="{{ $edit_value->admin_phone }}" name="phone" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Email</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="email" name="email" value="{{ $edit_value->admin_email }}" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="password" class="control-label col-lg-3">Mật khẩu</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="password" name="password" value="{{ $edit_value->admin_password }}" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="confirm_password" class="control-label col-lg-3">Xác nhận mật khẩu</label>
                                        <div class="col-lg-6">
                                            <input class="form-control" id="confirm_password" value="{{ $edit_value->admin_password }}" name="confirm_password" type="password">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </div>
@endsection