 @extends('welcome')
 @section('content')
            <section id="cart_items">
                <div class="col-sm-12 padding-right">
                    <div class="features_items"><!--features_items-->
                        @foreach($brand_name as $key => $name_by_id)
                            <h2 class="title text-center">{{ ($name_by_id->brand_name) }}</h2>
                        @endforeach
                        <div class="row">
                            <div class="col-md-4">
                                <label for="amount">Sắp xếp theo</label>
                                <form>
                                    @csrf
                                    <select name="sort" id="sort" class="form-control">
                                        <option value="{{ Request::url() }}?sort_by=none">-- Lọc theo --</option>            
                                        <option value="{{ Request::url() }}?sort_by=tang_dan">-- Giá tăng dần --</option>            
                                        <option value="{{ Request::url() }}?sort_by=giam_dan">-- Giá giảm dần --</option>            
                                        <option value="{{ Request::url() }}?sort_by=kytu_az">-- Theo tên A đến Z --</option>            
                                        <option value="{{ Request::url() }}?sort_by=kytu_za">-- Theo tên Z đến A --</option>            
                                    </select>        
                                </form>
                            </div>

                             <div class="col-md-4">
                                <label for="amount">Lọc tầm giá</label>
                                <form>
                                    <div id="slider-range"> </div>  
                                        <div clas="style-range" style="width: 372px">
                                             <input type="text" id="amount_start" readonly style="border:0; color:#f6931f; font-weight:bold; width: 120px">
                                             <input  type="text" id="amount_end" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                        </div>
                                     <input type="hidden" name="start_price" id="start_price">
                                     <input type="hidden" name="end_price" id="end_price">
                                     {{-- <input type="hidden" name="fillter_price" value="true"> --}}
                                     <input type="submit" name="filter_price" value="Lọc giá" class="btn btn-sm btn-default">
                                     {{-- <button type="submit">Lọc giá</button> --}}
                                </form>
                            </div>
                        </div>
                        <br>

                         @foreach($brand_by_id as $key => $product)
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
                        
                    </div>
                    
                    <div class="phantrang" style="margin-left: 390px">
                         {{ $brand_by_id -> links() }}
                    </div>
                    </section>
@endsection