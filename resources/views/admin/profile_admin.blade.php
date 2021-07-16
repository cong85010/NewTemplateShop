@extends('admin_layout')
@section('admin_content')
        <div class="panel  panel-default dashboard">
        <header class="panel-heading">
                            <p class="title_thongke">
                            Thông tin Admin
                            </p>
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
                            <div class="form" style="padding: 100px 0;">
                                <form class="cmxform form-horizontal " id="signupForm" method="get" action="{{ URL::to('update_admin/'.$edit_value->admin_id) }}" novalidate="novalidate">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-5">Tên Admin</label>
                                        <div class="col-lg-3">
                                            <input class=" form-control" id="firstname" value="{{ $edit_value->admin_name }}" name="firstname" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-5">Số điện thoại</label>
                                        <div class="col-lg-3">
                                            <input class=" form-control" id="phone" value="{{ $edit_value->admin_phone }}" name="phone" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-5">Email</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="email" name="email" value="{{ $edit_value->admin_email }}" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="password" class="control-label col-lg-5">Mật khẩu</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="password" name="password" value="{{ $edit_value->admin_password }}" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="confirm_password" class="control-label col-lg-5">Xác nhận mật khẩu</label>
                                        <div class="col-lg-3">
                                            <input class="form-control" id="confirm_password" value="{{ $edit_value->admin_password }}" name="confirm_password" type="password">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-lg-offset-6 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Lưu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </div>
        </div>
@endsection