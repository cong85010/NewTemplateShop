@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Hình ảnh mô tả sản phẩm
                        </header>
                        <?php
                                $messge = Session::get('messge');
                                if($messge){
                                    echo $messge;
                                    Session::put('messge',null);
                                }
                            ?>
                            <form action="{{ url('/insert-gallery/'.$pro_id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="row">
                                <div class="col-md-3" align="right">
                                    
                                </div>
                                <div class="col-md-6">
                                    <input type="file" id="file" name="file[]" accept="image/*" class="form-control" value="" multiple>
                                    <span id="error_gallery"></span>
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" name="upload" name="taianh" value="Tải ảnh" class="btn btn-success">
                                </div>
                            </div>
                            </form>
                        <div class="panel-body">
                            
                            <input type="hidden" value="{{ $pro_id }}" name="pro_id" class="pro_id">
                            <form>        
                            @csrf                    
                            <div id="gallery_load">
                                 
                            </div>
                            </form>
                        </div>
                    </section>

            </div>
@endsection