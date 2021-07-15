 @extends('welcome')
 @section('content')
     
                <div class="col-sm-12 padding-right">
                    <div class="features_items"><!--features_items-->
                        @foreach($category_name as $key => $name_by_id)
                            <h2 class="title text-center">{{ ($name_by_id->category_name) }}</h2>
                        @endforeach

                         @foreach($category_by_id as $key => $product)
                        {{-- <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}" title=""> --}}
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center">
                                                <form>
                                                    @csrf
                                                <input type="hidden" class="cart_product_id_{{ $product->product_id }}" name="" value="{{ $product->product_id }}">

                                                <input type="hidden" class="cart_product_name_{{ $product->product_id }}" name="" value="{{ $product->product_name }}">

                                                <input type="hidden" class="cart_product_image_{{ $product->product_id }}" name="" value="{{ $product->product_image }}">

                                                <input type="hidden" class="cart_product_price_{{ $product->product_id }}" name="" value="{{ $product->product_price }}">

                                                <input type="hidden" class="cart_product_quantity_{{ $product->product_id }}" name="" value="1">
                                                
                                                <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}" title="">
                                                <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" height="200" />
                              {{--   <form action="{{ URL::to('/save-cart') }}" method="post">
                                                    {{ csrf_field() }} --}}
                                                        <span class="product_Infor">
                                                            <p style="height: 50px;">Tên: <b style="text-overflow: ellipsis;">{{($product->product_name) }}</b></p>
                                                            <p>Tồn kho: {{($product->product_qty) }}</p>
                                                            <?php
                                                                if($product->product_qty != '0'){
                                                            ?>
                                                            <input name="productid_hidden" type="hidden" value="{{ $product->product_id }}" />
                                                            <input name="qty" type="hidden" min="1" value="1" />
                                                            </a>
                                                            <h3 style="color: indianred; text-align: start;">Giá: {{ number_format($product->product_price) }} VND</h3>
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
                                </div>
                            </div>
                        {{-- </a> --}}
                        @endforeach
                    </div>
                    <div class="phantrang" style="margin-left: 390px">
                         {{ $category_by_id -> links() }}
                    </div>
                    </div>
                    
                    
@endsection