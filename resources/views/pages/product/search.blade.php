 @extends('welcome')
 @section('content')
                <div class="col-sm-12 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Kết quả tìm kiếm: <?php $mes = Session::get('ssKey');
                            echo "$mes";
                         ?>
                         </h2>
                        @foreach($search_product as $key => $product)
                        <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}" title="">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" height="200" />
                                                    <form action="{{ URL::to('/save-cart') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <span class="product_Infor">
                                                            <p>Tên: <b style="display: block;text-overflow: ellipsis;">{{($product->product_name) }}</b></p>
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
                                                    </form>
                                                </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        
                    </div><!--features_items-->
                </div><!--features_items-->
@endsection







