@extends('client.layout.master')
@section('content')
  <!-- Breadcrumb Section Begin -->
  @foreach ($slides as $slide)
    @php
    $imagesLink = is_null($slide->image) || !file_exists('images/'.$slide->image)
    ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
    : asset('images/'. $slide->image);
    @endphp
     <section class="breadcrumb-section set-bg" data-setbg="{{ $imagesLink }}">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Blog</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  @endforeach

<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="#" method="get">
                            <input type="text" value="{{ $keyword }}" placeholder="Search..." name="keyword">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="{{ route('blog.index') }}">All</a></li>
                            @foreach ($categoryid as $category)
                                <li><a href="#">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Recent News</h4>
                        <div class="blog__sidebar__recent">
                            @foreach ($blogst as $blog)
                                <a href="#" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        @php
                                        $imagesLink = is_null($blog->image) || !file_exists('images/'.$blog->image)
                                        ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                        : asset('images/'. $blog->image);
                                        @endphp
                                        <img src="{{ $imagesLink }}" alt="{{ $blog->name}}" width="70" height="70" />
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>{{ $blog->name }}</h6>
                                        <span>{{ $blog->created_at }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Search By</h4>
                        <div class="blog__sidebar__item__tags">
                            @foreach ($categoryid as $category)
                                <a href="#">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-6 col-md-6 col-sm-6">
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
                                    <p>{!! $blog->short_description !!}</p>
                                    {{-- <a href="#" class="blog__btn">READ MORE <span class="arrow_right"></span></a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="product__pagination blog__pagination">

                            {{ $blogs->links() }}
                            {{-- <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#"><i class="fa fa-long-arrow-right"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->
@endsection
