@extends('client.layout.master')
@section('content')
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            @foreach ($product_categories as $product_category)
                            <li><a href="" >{{ $product_category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form method="get" action="{{ route('shop.index') }}">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do you need to go?" value="{{ $keyword }}" name="keyword">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                               <a href="{{ route('send-sms') }}"> <i class="fa fa-phone"></i></a>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                   @foreach ($slide1 as $slide)
                    @php
                        $imagesLink = is_null($slide->image) || !file_exists('images/'.$slide->image)
                        ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                        : asset('images/'. $slide->image);
                    @endphp
                    <div class="hero__item set-bg" data-setbg="{{ $imagesLink }} ">
                            <div class="hero__text text-white">
                                <span>{{ $slide->name }}</span>
                                <h2 class="text-white">Shop <br />{!! $slide->description !!}</h2>
                                <p>Free Pickup and Delivery Available</p>
                                <a href="{{ route('shop.index') }}" class="primary-btn">SHOP NOW</a>
                            </div>
                        </div>
                   @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($products as $product)
                        <div class="col-lg-3">
                            @php
                                $imagesLink = is_null($product->image) || !file_exists('images/'.$product->image)
                                ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                : asset('images/'. $product->image);
                            @endphp
                            <div class="categories__item set-bg" data-setbg="{{ $imagesLink }}"  >
                                <h5><a href="#">{{ $product->name }}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">One</li>
                            <li data-filter=".fresh-meat">Two</li>
                            <li data-filter=".vegetables">Three</li>
                            <li data-filter=".fastfood">Four</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                        <div class="featured__item">
                            @php
                                $imagesLink = is_null($product->image) || !file_exists('images/'.$product->image)
                                ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                : asset('images/'. $product->image);
                            @endphp
                            <div class="featured__item__pic set-bg" data-setbg="{{ $imagesLink }}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a data-url="{{route('product.add-to-cart',['productId' => $product->id])}}" href="#" class="add-to-cart"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#">{{$product->name}}</a></h6>
                                <h5>${{ number_format($product->price,2) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                               @foreach ($productop as $product)
                               <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        @php
                                            $imagesLink = is_null($product->image) || !file_exists('images/'.$product->image)
                                            ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                            : asset('images/'. $product->image);
                                        @endphp
                                        <img src="{{ $imagesLink }}" alt="{{ $product->name}}" width="50" height="50" />
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        <span>${{ $product->price }}</span>
                                    </div>
                                </a>
                               @endforeach

                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($productop1 as $product)
                                <a href="#" class="latest-product__item">
                                     <div class="latest-product__item__pic">
                                         @php
                                             $imagesLink = is_null($product->image) || !file_exists('images/'.$product->image)
                                             ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                             : asset('images/'. $product->image);
                                         @endphp
                                         <img src="{{ $imagesLink }}" alt="{{ $product->name}}" width="50" height="50" />
                                     </div>
                                     <div class="latest-product__item__text">
                                         <h6>{{ $product->name }}</h6>
                                         <span>${{ $product->price }}</span>
                                     </div>
                                 </a>
                                @endforeach

                             </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                               @foreach ($productop as $product)
                               <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        @php
                                            $imagesLink = is_null($product->image) || !file_exists('images/'.$product->image)
                                            ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                            : asset('images/'. $product->image);
                                        @endphp
                                        <img src="{{ $imagesLink }}" alt="{{ $product->name}}" width="50" height="50" />
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        <span>${{ $product->price }}</span>
                                    </div>
                                </a>
                               @endforeach

                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($productop1 as $product)
                                <a href="#" class="latest-product__item">
                                     <div class="latest-product__item__pic">
                                         @php
                                             $imagesLink = is_null($product->image) || !file_exists('images/'.$product->image)
                                             ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                             : asset('images/'. $product->image);
                                         @endphp
                                         <img src="{{ $imagesLink }}" alt="{{ $product->name}}" width="50" height="50" />
                                     </div>
                                     <div class="latest-product__item__text">
                                         <h6>{{ $product->name }}</h6>
                                         <span>${{ $product->price }}</span>
                                     </div>
                                 </a>
                                @endforeach

                             </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                               @foreach ($productop as $product)
                               <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        @php
                                            $imagesLink = is_null($product->image) || !file_exists('images/'.$product->image)
                                            ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                            : asset('images/'. $product->image);
                                        @endphp
                                        <img src="{{ $imagesLink }}" alt="{{ $product->name}}" width="50" height="50" />
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        <span>${{ $product->price }}</span>
                                    </div>
                                </a>
                               @endforeach

                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($productop1 as $product)
                                <a href="#" class="latest-product__item">
                                     <div class="latest-product__item__pic">
                                         @php
                                             $imagesLink = is_null($product->image) || !file_exists('images/'.$product->image)
                                             ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                             : asset('images/'. $product->image);
                                         @endphp
                                         <img src="{{ $imagesLink }}" alt="{{ $product->name}}" width="50" height="50" />
                                     </div>
                                     <div class="latest-product__item__text">
                                         <h6>{{ $product->name }}</h6>
                                         <span>${{ $product->price }}</span>
                                     </div>
                                 </a>
                                @endforeach

                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
               @foreach ($blogs as $blog)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            @php
                                $imagesLink = is_null($blog->image) || !file_exists('images/'.$blog->image)
                                ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                : asset('images/'. $blog->image);
                            @endphp
                            <img src="{{ $imagesLink }}" alt="{{ $blog->name}}" width="150" height="200" />
                            {{-- <img src="img/blog/blog-2.jpg" alt=""> --}}
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> {{ $blog->created_at }}</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">{{ $blog->name }}</a></h5>
                            <a href="{{ route('blog.index') }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                        </div>
                    </div>
                </div>
               @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
@section('js-custom')
    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function(event) {
                event.preventDefault();
                var url = $(this).data('url');
                $.ajax({
                    method: 'get', //method form
                    url: url, //action form
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            icon: 'success',
                            // title: 'Notification',
                            text: response.message,

                        });
                        $('#total-items-cart').html(response.total_items);
                        $('#total-price-cart').html('$' + response.total_price.toFixed(2)
                            .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                        // alert(response.message);
                    },
                    statusCode:{
                        401:function(){
                            window.location.href = '{{ route('login')}}';

                        },
                        404: function(){
                            Swal.fire({
                                icon: 'error',
                                text: "Can't add product to cart",
                            });
                        },
                    },
                });
            });
        });
    </script>
@endsection
