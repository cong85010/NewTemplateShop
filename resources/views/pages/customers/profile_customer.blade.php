
 @extends('welcome')
 @section('content')
                        <header class="panel-heading">
                            Thông tin tài khoản
                        </header>
                        <?php
                                $messge = Session::get('messge');
                                if($messge){
                                    echo $messge;
                                    Session::put('messge',null);
                                }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_customer as $key => $edit_value)
                            <div class="form">
                                <form class="cmxform form-horizontal " id="signupForm" method="POST" action="{{ URL::to('update-customer/'.$edit_value->customer_id) }}" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Tên khách hàng</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="firstname" value="{{ $edit_value->customer_name }}" name="firstname" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Số điện thoại</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="phone" value="{{ $edit_value->customer_phone }}" name="phone" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Email</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="email" name="email" value="{{ $edit_value->customer_email }}" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="confirm_password" class="control-label col-lg-3">Xác nhận mật khẩu</label>
                                        <div class="col-lg-6">
                                            <input class="form-control" id="confirm_password" value="{{ $edit_value->customer_password }}" name="confirm_password" type="password">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Thay đổi thông tin</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </div>
@endsection