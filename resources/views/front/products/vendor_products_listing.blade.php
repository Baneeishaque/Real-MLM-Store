{{-- Show all Vendor products --}} {{-- This file is 'iclude'-ed in front/products/vendor_listing.blade.php --}} {{-- https://www.youtube.com/watch?v=S8xbldfdLXc&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=111 --}}



<!-- Row-of-Product-Container -->
{{-- <div class="row product-container list-style"> --}}
<div class="row product-container grid-style">



    @foreach ($vendorProducts as $product)
        <div class="product-item col-lg-4 col-md-6 col-sm-6">
            <div class="item">
                <div class="image-container">
                    <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">



                        @php
                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                        @endphp


                        @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                        @else {{-- show the dummy image --}}
                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                        @endif



                    </a>
                    <div class="item-action-behaviors">
                        <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                        <a class="item-mail" href="javascript:void(0)">Mail</a>
                        <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                        <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                    </div>
                </div>
                <div class="item-content">
                    <div class="what-product-is">
                        <ul class="bread-crumb">
                            <li class="has-separator">
                                <a href="shop-v1-root-category.html">{{ $product['product_code'] }}</a>
                            </li>
                            <li class="has-separator">
                                <a href="listing.html">{{ $product['product_color'] }}</a>
                            </li>
                            <li>
                                <a href="listing.html">{{ $product['brand']['name'] }}</a>
                            </li>
                        </ul>
                        <h6 class="item-title">
                            <a href="single-product.html">{{ $product['product_name'] }}</a>
                        </h6>
                        <div class="item-description">
                            <p>{{ $product['description'] }}</p>
                        </div>
                        {{-- <div class="item-stars">
                            <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                <span style='width:67px'></span>
                            </div>
                            <span>(23)</span>
                        </div> --}}
                    </div>



                    {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout    // Check 19:09 in https://www.youtube.com/watch?v=T_CWdKW5he0&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=72 --}}
                    @php
                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                    @endphp


                    @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                        <div class="price-template">
                            <div class="item-new-price">
                                Rs . {{ $getDiscountPrice }} {{-- 'Rs' means Rupees the Indian currency --}}
                            </div>
                            <div class="item-old-price">
                                Rs . {{ $product['product_price'] }}
                            </div>
                        </div>
                    @else {{-- if there's no discount on the price, show the original price --}}
                        <div class="price-template">
                            <div class="item-new-price">
                                Rs . {{ $product['product_price'] }}
                            </div>
                        </div>
                    @endif



                </div>



                {{-- https://www.youtube.com/watch?v=tQNmKdQ-f-s&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=79 --}}
                @php
                    $isProductNew = \App\Models\Product::isProductNew($product['id'])
                @endphp
                @if ($isProductNew == 'Yes')
                    <div class="tag new">
                        <span>NEW</span>
                    </div>
                @endif


                
            </div>
        </div>
    @endforeach



</div>
<!-- Row-of-Product-Container /- -->