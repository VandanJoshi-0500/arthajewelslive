@extends('frontend.layouts.app')



@section('content')



<section class="artha-banner-outer-main">

    <div class="artha-banner-outer">

        <div class="container-fluid p-0">

            <div class="">

                <!-- <div class="artha-banner-inner">
                    <img src="{{ URL::asset('assets/images/home-banner/banner1.jpg') }}" class="w-100">
                </div> -->


                <!-- Dynamic Banner 1 -->
                <div class="artha-banner-inner">
                    @if ($banner1)
                    @if ($banner1->image_type == 1)
                    <img src="{{ asset('public/banners/' . $banner1->image) }}" class="w-100">
                    @else
                    <img src="{{ $banner1->image }}" class="w-100">
                    @endif
                    @else
                    <img src="{{ URL::asset('assets/images/home-banner/banner1.jpg') }}" class="w-100">
                    @endif
                </div>

            </div>

        </div>

    </div>

</section>

<section class="artha-collection-content-main">

    <div class="artha-collection-content">

        <div class="container">

            <div class="row">

                <div class="artha-title-div">

                    <h2>Artistry in Every Piece</h2>

                    <p>Celebrate Your Unique Style with Our Handmade Jewelry Collection.</p>

                    <div class="artha-subtitle-div">

                        <h3><a href="{{ env('APP_URL') }}/Bloom">Discover</a></h3>

                    </div>

                </div>

                {{-- <div class="artha-product-list">

                        <div class="artha-collection-navigation">
                            <button class="custom-prev-btn"><i class="fas fa-chevron-left"></i></button>
                            <button class="custom-next-btn"><i class="fas fa-chevron-right"></i></button>
                        </div>

                        <div id="artha-collection-slider" class="owl-carousel owl-theme">


                            @foreach ($collections as $key => $collection)
                                @if (isset($collection->productDetail))
                                    @php

                                        $product = $collection->productDetail;

                                    @endphp

                                    @php

                                        $product_image = '';

                                        if ($product->image_type == 1) {
                                            $product_image = URL::asset('products/' . $product->image);
                                        } else {
                                            if (
                                                substr($product->image, 0, 7) == 'http://' ||
                                                substr($product->image, 0, 8) == 'https://'
                                            ) {
                                                $product_image = $product->image;
                                            }
                                        }

                                    @endphp



                                    @if (!empty($product_image))
                                        <div class="item">

                                            <div class="artha-product-list-div">

                                                <div class="artha-product-list-img">

                                                    <a href="{{ route('product.details', $product->sku) }}"
                class=""><img src="{{ $product_image }}"
                    alt="{{ $product->name }}" class="img-fluid"></a>

                <div class="artha-product-list-img-life">

                    <a href="#">

                        <i class="far fa-heart"></i>

                    </a>

                </div>

            </div>

            <div class="artha-product-list-content">

                <h3><a href="{{ route('product.details', $product->sku) }}"
                        class="">{{ $product->name }}</a></h3>

                <p>{{ $product->description }}</p>

                <div class="artha-product-list-price">

                    <span>€ {{ number_format($product->price, 2) }}</span>

                </div>

            </div>

            <div class="artha-product-list-btn-outer">

                <a href="{{ route('product.details', $product->sku) }}"
                    class="artha-product-list-btn">Discover</a>

            </div>

        </div>

    </div>
    @endif
    @endif
    @endforeach

    </div>

    </div> --}}
    <div class="artha-product-list">

        <!-- Left & Right Navigation Buttons -->
        <div class="artha-collection-navigation">
            <button class="custom-prev-btn"><i class="fas fa-chevron-left"></i></button>
            <button class="custom-next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>

        <!-- Owl Carousel -->
        <div id="artha-collection-slider" class="owl-carousel owl-theme">
            @foreach ($collections as $key => $collection)
            @if (isset($collection->productDetail))
            @php
            $product = $collection->productDetail;
            $product_image = '';

            if ($product->image_type == 1) {
            $product_image = URL::asset('products/' . $product->image);
            } elseif (
            substr($product->image, 0, 7) == 'http://' ||
            substr($product->image, 0, 8) == 'https://'
            ) {
            $product_image = $product->image;
            }
            @endphp

            @if (!empty($product_image))
            <div class="item">
                <div class="artha-product-list-div">
                    <div class="artha-product-list-img">
                        <a href="{{ route('product.details', $product->sku) }}">
                            <img src="{{ $product_image }}" alt="{{ $product->name }}"
                                class="img-fluid">
                        </a>
                        <div class="artha-product-list-img-life">
                            <a href="#"><i class="far fa-heart"></i></a>
                        </div>
                    </div>
                    <div class="artha-product-list-content">
                        <h3><a
                                href="{{ route('product.details', $product->sku) }}">{{ $product->name }}</a>
                        </h3>
                        <p>{{ $product->description }}</p>
                        <div class="artha-product-list-price">
                            <span>€ {{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>
                    <div class="artha-product-list-btn-outer">
                        <a href="{{ route('product.details', $product->sku) }}"
                            class="artha-product-list-btn">Discover</a>
                    </div>
                </div>
            </div>
            @endif
            @endif
            @endforeach
        </div>

    </div>

    </div>

    </div>

    </div>

</section>



<section class="artha-collection-banner-content-main">

    <div class="artha-collection-banner-content">

        <div class="container">

            <div class="row second-banner-section">

                <!-- <div class="second-banner col-md-6">
                    <img src="{{ URL::asset('assets/images/home-banner/banner-2a.jpg') }}" class="img-fluid">
                    <h4 class="second-banner-heading">Heading 1</h4>
                    <p class="second-banner-description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Earum eligendi aperiam libero et optio eaque eum accusamus exercitationem rem. Itaque quidem dolor harum modi quibusdam omnis vero sequi consectetur iusto.</p>
                </div>
                <div class="second-banner col-md-6">
                    <img src="{{ URL::asset('assets/images/home-banner/banner-2b.jpg') }}" class="img-fluid">
                    <h4 class="second-banner-heading">Heading 2</h4>
                    <p class="second-banner-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis quo asperiores dolore rerum quia doloremque cum harum a. Culpa, sunt.</p>
                </div> -->
                <div class="second-banner col-md-6">
                    @if ($banner2)
                    @if ($banner2->image_type == 1)
                    <img src="{{ asset('public/banners/' . $banner2->image) }}" class="img-fluid">
                    @else
                    <img src="{{ $banner2->image }}" class="img-fluid">
                    @endif
                    <h4 class="second-banner-heading">{{ $banner2->heading ?? 'Heading 1' }}</h4>
                    <p class="second-banner-description">{{ $banner2->description ?? 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.' }}</p>
                    @else
                    <img src="{{ asset('assets/images/home-banner/banner-2a.jpg') }}" class="img-fluid">
                    <h4 class="second-banner-heading">Heading 1</h4>
                    <p class="second-banner-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    @endif
                </div>

                <div class="second-banner col-md-6">
                    @if ($banner3)
                    @if ($banner3->image_type == 1)
                    <img src="{{ asset('public/banners/' . $banner3->image) }}" class="img-fluid">
                    @else
                    <img src="{{ $banner3->image }}" class="img-fluid">
                    @endif
                    <h4 class="second-banner-heading">{{ $banner3->heading ?? 'Heading 2' }}</h4>
                    <p class="second-banner-description">{{ $banner3->description ?? 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.' }}</p>
                    @else
                    <img src="{{ asset('assets/images/home-banner/banner-2b.jpg') }}" class="img-fluid">
                    <h4 class="second-banner-heading">Heading 2</h4>
                    <p class="second-banner-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    @endif
                </div>


                <!-- <img src="{{ URL::asset('assets/images/home-banner/banner2.jpg') }}" class="w-100"> -->

            </div>

        </div>

    </div>

    <div class="container artha-title-div-outer">

        <div class="row">

            <div class="col-xl-11 artha-title-div">

                <h2>Experience the unparalleled brilliance of our exquisite diamond jewelry, designed to shine as bright
                    as your love.</h2>

                <div class="artha-subtitle-div">

                    <h3><a href="{{ env('APP_URL') }}/Glamour">Discover</a></h3>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- <section class="artha-collection-card-main">

        <div class="container">

            <div class="row">

                <div class="artha-collection-card-main-inner">

                    <div class="artha-collection-card-main-img-content">

                        <img src="{{url('/')}}/front/images/fine-jewelry-home-page.jpg">

<div class="artha-collection-card-main-content">

    <div class="artha-title-div">

        <h2>Lorem Ipsum is simply dummy text</h2>

        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has

            been the industry'</p>

        <div class="artha-subtitle-div">

            <h3>Discover the collection</h3>

        </div>

    </div>

</div>

</div>

<div class="artha-collection-card-main-img-content">

    <img src="{{url('/')}}/front/images/victorian-jewelry-home-page.jpg">

    <div class="artha-collection-card-main-content">

        <div class="artha-title-div">

            <h2>Lorem Ipsum is simply dummy text</h2>

            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has

                been the industry'</p>

            <div class="artha-subtitle-div">

                <h3>Discover the collection</h3>

            </div>

        </div>

    </div>

</div>

</div>

</div>

</div>

</section> --}}



<section class="artha-collection-banner-content-main">

    <!-- <div class="artha-collection-banner-content w-vw-100"> -->

    {{-- <div class="container-fluid"> --}}

    {{-- <div class="row"> --}}

    <!-- <img src="{{ URL::asset('assets/images/home-banner/banner3.jpg') }}" class="image-fluid" style="width: 100%; height: 100%; object-fit: cover;"> -->

    {{-- </div> --}}

    {{-- </div> --}}

    <!-- </div> -->


    <div class="artha-collection-banner-content w-vw-100">
        @if ($banner4)
        @if ($banner4->image_type == 1)
        <img src="{{ asset('public/banners/' . $banner4->image) }}" class="image-fluid" style="width: 100%; height: 100%; object-fit: cover;">
        @else
        <img src="{{ $banner4->image }}" class="image-fluid" style="width: 100%; height: 100%; object-fit: cover;">
        @endif
        @else
        <img src="{{ asset('assets/images/home-banner/banner3.jpg') }}" class="image-fluid" style="width: 100%; height: 100%; object-fit: cover;">
        @endif
    </div>

    <div class="container artha-title-div-outer">

        <div class="row">

            <div class="col-xl-11 artha-title-div">

                <h2>Radiate elegance with our unique, handcrafted diamond jewelry that tells your story.</h2>

                <div class="artha-subtitle-div">

                    <h3><a href="{{ env('APP_URL') }}/shop">Discover</a></h3>

                </div>

            </div>

        </div>

    </div>

</section>



<section class="artha-newletter-main">

    <div class="container">

        <div class="row">

            <div class="artha-newletter-inner">

                <h2>SUBSCRIBE TO OUR NEWSLETTER</h2>

                <form action="{{ route('newsletter') }}" method="post">

                    @csrf

                    <div class="artha-newsletter-form">

                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">

                        @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif

                        <button type="submit" class="artha-product-list-btn">SUBSCRIBE</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection


@section('script')
<!-- jQuery + Owl Carousel JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
    $(document).ready(function() {
        const owl = $('#artha-collection-slider');

        owl.owlCarousel({
            loop: true,
            margin: 20,
            nav: false, // We use custom buttons
            dots: false,
            autoplay: true, // Enable auto-scroll
            autoplayTimeout: 3000, // Delay between scrolls (ms)
            autoplayHoverPause: true, // Pause on hover
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });

        // Hook custom buttons
        $('.custom-next-btn').click(function() {
            owl.trigger('next.owl.carousel');
        });

        $('.custom-prev-btn').click(function() {
            owl.trigger('prev.owl.carousel');
        });
    });
</script>
@endsection