 @extends('welcome')
 @section('content')
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Sản phẩm mới nhất</h2>
                        @foreach($all_product as $key => $product)
                        {{-- <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}" title=""> --}}
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center" style="height: 370px">
                                                <form>
                                                    @csrf
                                                <input type="hidden" class="cart_product_id_{{ $product->product_id }}" name="" value="{{ $product->product_id }}">

                                                <input type="hidden" class="cart_product_name_{{ $product->product_id }}" name="" value="{{ $product->product_name }}">

                                                <input type="hidden" class="cart_product_image_{{ $product->product_id }}" name="" value="{{ $product->product_image }}">

                                                <input type="hidden" class="cart_product_price_{{ $product->product_id }}" name="" value="{{ $product->product_price }}">

                                                <input type="hidden" value="{{ $product->product_qty }}" class="cart_product_qty_{{ $product->product_id }}">

                                                <input type="hidden" class="cart_product_quantity_{{ $product->product_id }}" name="" value="1">
                                                
                                                <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}" title="">
                                                <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" height="200" />
                              {{--   <form action="{{ URL::to('/save-cart') }}" method="post">
                                                    {{ csrf_field() }} --}}
                                                        <span>
                                                            <h2>{{ number_format($product->product_price) }} VND</h2>
                                                            <p><b>{{($product->product_name) }}</b></p>
                                                            <p>Tồn kho: {{($product->product_qty) }}</p>
                                                            <?php
                                                                if($product->product_qty != '0'){
                                                            ?>
                                                            <input name="productid_hidden" type="hidden" value="{{ $product->product_id }}" />
                                                            <input name="qty" type="hidden" min="1" value="1" />
                                                            </a>
                                                            {{-- <button type="submit"  class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button> --}}
                                                            <button type="button" name="add-to-cart" class="btn btn-default add-to-cart" data-id_product="{{ $product->product_id }}">Thêm giỏ hàng</button>
                                                            <?php 
                                                        }else{
                                                            ?>
                                                            <button class="btn btn-danger add-to-cart"><i class="fa fa-shopping-cart"></i>Hết hàng</button>
                                                            <?php
                                                        }
                                                            ?>
                                                        </span>
                                                    {{-- </form> --}}</form>
                                                </a>
                                                </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        {{-- </a> --}}
                        @endforeach
                    </div><!--features_items-->
                    <div class="phantrang" style="margin-left: 495px">
                         {{ $all_product -> links() }}
                    </div>
               
@endsection