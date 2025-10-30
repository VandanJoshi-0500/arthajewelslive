<!DOCTYPE html>

<html lang="en">

<head>

    <title>Arthajewels - Fashion Wholesale Jewelry, Handmade Jewelry, Best Indian Jewelry Stores</title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('/') }}/settings/{{ $setting->favicon }}">

    <link href="{{ url('/') }}/front/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ url('/') }}/front/css/style.css" rel="stylesheet">

    <link href="{{ url('/') }}/front/css/responsive.css" rel="stylesheet">

    <link href="{{ url('/') }}/front/css/mega-menu.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('/') }}/assets1/sweetalert/sweetalert.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link rel="stylesheet" href="{{ url('/') }}/front/css/owl.carousel.min.css" />

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- Font Awesome (for arrow icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />



    @yield('style')

</head>

<body>

    <header class="dekstop-menu">

        <div class="artha-header-logo">

            <a href="{{ route('home') }}"><img src="{{ url('/') }}/front/images/logo.png"></a>

        </div>

        <div class="artha-header-menu-outer">

            <div class="artha-header-menu">

                <div class="navbar navbar-expand-md navbar-light">

                    <div class="container">

                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbar-content">

                            <div class="hamburger-toggle">

                                <div class="hamburger">

                                    <span></span>

                                    <span></span>

                                    <span></span>

                                </div>

                            </div>

                        </button>

                        <div class="collapse justify-content-center navbar-collapse" id="navbar-content">

                            <ul class="navbar-nav">

                                <li class="nav-item">

                                    <a class="nav-link " aria-current="page" href="{{ route('home') }}">Home</a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" aria-current="page" href="{{ url('/') }}/aboutus">About
                                        Us</a>

                                </li>



                                <li class="nav-item dropdown artha-dropdown-mega position-static">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside">Jewellery</a>
                                    <div class="dropdown-menu shadow artha-features">
                                        <div class="mega-content px-4">
                                            <div class="artha-padding-global">
                                                <div class="artha-container-medium">
                                                    <div class="row">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <ul class="nav nav-pills bg-info" id="pills-tab"
                                                                        role="tablist" data-mouse="hover">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                                                                                id="pills-products-tab-1"
                                                                                data-toggle="pill"
                                                                                data-reference="#pills-products-1"
                                                                                href="{{ url('/shop') }}"
                                                                                role="tab"
                                                                                aria-controls="pills-products-1"
                                                                                aria-selected="{{ request()->is('/') ? 'true' : 'false' }}">
                                                                                All Collections
                                                                            </a>
                                                                        </li>
                                                                        
                                                                        @if (!blank($categories))
                                                                            @php
                                                                                $i = 2;
                                                                            @endphp
                                                                            @foreach ($categories as $category)
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link
            {{ request()->is($category->slug) || request()->is('category/*/' . $category->id) ? 'active' : '' }}"
                                                                                        id="pills-products-tab-{{ $i }}"
                                                                                        data-toggle="pill"
                                                                                        data-reference="#pills-products-{{ $i }}"
                                                                                        href="{{ url($category->slug) }}"
                                                                                        role="tab"
                                                                                        aria-controls="pills-products-{{ $i }}"
                                                                                        aria-selected="{{ request()->is($category->slug) || request()->is('category/*/' . $category->id) ? 'true' : 'false' }}">
                                                                                        {{ $category->name }}
                                                                                    </a>
                                                                                </li>
                                                                                @php $i++; @endphp
                                                                            @endforeach
                                                                        @endif
                                                                    </ul>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="tab-content p-3" id="pills-tabContent">
                                                                        @php
                                                                            $isDefaultTab = request()->segment(3) ? false : true;
                                                                        @endphp

                                                                        <div class="tab-pane {{ $isDefaultTab ? 'show active' : '' }}" id="pills-products-1" role="tabpanel">

                                                                        <!-- <div class="tab-pane show active"
                                                                            id="pills-products-1" role="tabpanel"
                                                                            aria-labelledby="pills-products-tab-1"> -->
                                                                            <div class="artha-list-group-outer">
                                                                                <div
                                                                                    class="desktop-menu-slider owl-carousel owl-theme">

                                                                                    @if ($collections)
                                                                                        @foreach ($collections as $collection)
                                                                                            @if ($collection->status == 1)
                                                                                                <div class="item">
                                                                                                    <div
                                                                                                        class="artha-list-group">

                                                                                                        <div
                                                                                                            class="artha-list-group-left testhere">

                                                                                                            <a
                                                                                                                href="{{ url('/') }}/{{ $collection->slug }}">

                                                                                                                <?php
                                                                                                                
                                                                                                                $collection_image = '';
                                                                                                                
                                                                                                                if (substr($collection->image, 0, 7) == 'http://' || substr($collection->image, 0, 8) == 'https://') {
                                                                                                                    $collection_image = $collection->image;
                                                                                                                } else {
                                                                                                                    $collection_image = URL::asset('/categories/' . $collection->menu_image);
                                                                                                                }
                                                                                                                
                                                                                                                ?>

                                                                                                                <img src="{{ $collection_image }}"
                                                                                                                    alt=""
                                                                                                                    class="img-fluid"
                                                                                                                    width="140">

                                                                                                            </a>

                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="artha-list-group-right">

                                                                                                            <a
                                                                                                                href="{{ url('/') }}/{{ $collection->slug }}">

                                                                                                                <h2>{{ $collection->name }}
                                                                                                                </h2>

                                                                                                            </a>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach

                                                                                    @endif

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                        @if (!blank($categories))

                                                                            @php

                                                                                $i = 2;

                                                                            @endphp

                                                                            @foreach ($categories as $category)
                                                                            @php
                                                                                $isActiveTab = request()->segment(3) == $category->id;
                                                                            @endphp
                                                                            <div class="tab-pane {{ $isActiveTab ? 'show active' : '' }}"
     id="pills-products-{{ $i }}" role="tabpanel"
     aria-labelledby="pills-Necklaces-tab-{{ $i }}">
                                                                                <!-- <div class="tab-pane"
                                                                                    id="pills-products-{{ $i }}"
                                                                                    role="tabpanel"
                                                                                    aria-labelledby="pills-Necklaces-tab-{{ $i }}"> -->

                                                                                    <div
                                                                                        class="artha-list-group-outer">

                                                                                        <div
                                                                                            class="desktop-menu-slider owl-carousel owl-theme">



                                                                                            @foreach ($category[$category->slug] as $collection)

                                                                                                @php
                                                                                                    $isActiveCollection = request()->segment(2) === $collection['slug'] && request()->segment(3) == $category->id;
                                                                                                @endphp
                                                                                            
                                                                                                <!-- <div class="item"> -->
                                                                                                <div class="item {{ $isActiveCollection ? 'active-collection' : '' }}">

                                                                                                    <div
                                                                                                        class="artha-list-group">

                                                                                                        <div
                                                                                                            class="artha-list-group-left testhere2">

                                                                                                            <a
                                                                                                                href="{{ route('show_page_category_collection', ['coll' => $collection['slug'], 'id' => $category->id]) }}">

                                                                                                                @php

                                                                                                                    $product_image = URL::asset(
                                                                                                                        '/assets1/Images/no_image/no_image.jpg',
                                                                                                                    );

                                                                                                                    if (
                                                                                                                        $category->slug ==
                                                                                                                            'rings' &&
                                                                                                                        isset(
                                                                                                                            $collection[
                                                                                                                                'ring_image'
                                                                                                                            ],
                                                                                                                        )
                                                                                                                    ) {
                                                                                                                        $product_image = URL::asset(
                                                                                                                            '/ring_image/' .
                                                                                                                                $collection[
                                                                                                                                    'ring_image'
                                                                                                                                ],
                                                                                                                        );
                                                                                                                    }

                                                                                                                    if (
                                                                                                                        $category->slug ==
                                                                                                                            'necklaces' &&
                                                                                                                        isset(
                                                                                                                            $collection[
                                                                                                                                'necklace_image'
                                                                                                                            ],
                                                                                                                        )
                                                                                                                    ) {
                                                                                                                        $product_image = URL::asset(
                                                                                                                            '/necklace_image/' .
                                                                                                                                $collection[
                                                                                                                                    'necklace_image'
                                                                                                                                ],
                                                                                                                        );
                                                                                                                    }

                                                                                                                    if (
                                                                                                                        $category->slug ==
                                                                                                                            'earrings' &&
                                                                                                                        isset(
                                                                                                                            $collection[
                                                                                                                                'ear_jewelry_mage'
                                                                                                                            ],
                                                                                                                        )
                                                                                                                    ) {
                                                                                                                        $product_image = URL::asset(
                                                                                                                            '/ear_jewelry_mage/' .
                                                                                                                                $collection[
                                                                                                                                    'ear_jewelry_mage'
                                                                                                                                ],
                                                                                                                        );
                                                                                                                    }

                                                                                                                    if (
                                                                                                                        $category->slug ==
                                                                                                                            'bracelets' &&
                                                                                                                        isset(
                                                                                                                            $collection[
                                                                                                                                'bracelets_image'
                                                                                                                            ],
                                                                                                                        )
                                                                                                                    ) {
                                                                                                                        $product_image = URL::asset(
                                                                                                                            '/bracelets_image/' .
                                                                                                                                $collection[
                                                                                                                                    'bracelets_image'
                                                                                                                                ],
                                                                                                                        );
                                                                                                                    }

                                                                                                                @endphp

                                                                                                                <img src="{{ $product_image }}"
                                                                                                                    alt="{{ $collection['name'] }}"
                                                                                                                    class="img-fluid">

                                                                                                            </a>

                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="artha-list-group-right">

                                                                                                            <a
                                                                                                                href="{{ route('product.details', $collection['id']) }}">

                                                                                                                <h2>{{ $collection['name'] }}
                                                                                                                </h2>

                                                                                                            </a>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </div>
                                                                                            @endforeach

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                                @php

                                                                                    $i++;

                                                                                @endphp
                                                                            @endforeach

                                                                        @endif





                                                                        <div class="tab-view-all">

                                                                            <a class="nav-item"
                                                                                href="{{ route('all_product.details') }}">View
                                                                                all</a>

                                                                        </div>

                                                                    </div>



                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </li>



                                {{-- <li class="nav-item">

                                        <a class="nav-link active" aria-current="page"
                                            href="{{ url('/') }}/contactus">Contact Us</a>

                                    </li> --}}

                            </ul>

                            {{-- <div class="artha-header-search">

                                    <a href="#search">

                                        <i class="fa-solid fa-magnifying-glass"></i>

                                    </a>

                                    <div id="search-box">

                                        <div class="container">

                                            <a class="close" href="#close"></a>

                                            <div class="search-main">

                                                <div class="search-inner">
                                                    <form action="{{ route('products.search') }}" method="GET">
                                                        <input type="text" id="inputSearch" name="query"
                                                            placeholder="Search Here"
                                                            value="{{ old('query', request('query')) }}" required>
                                                    </form>
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                </div> --}}

                            {{-- <ul class="list-unstyled d-flex login_wishlist ">

                                    <li class="header_login_btn"><a
                                            href="@if (auth()->user()) {{ route('logout') }}@else{{ route('login') }} @endif">
                                            @if (auth()->user())
                                                LOGOUT
                                            @else
                                                LOGIN
                                            @endif
                                        </a></li>

                                    <li><a href="{{ route('wishlist') }}">WISHLIST</a></li>

                                </ul> --}}

                            <!-- <div class="HeaderBTN" style="margin-left : 15px;">
                        <button style="background-color:#DFAE60;padding-left:30px; padding-right: 30px;border:none; font-size:12px;padding-top: 7px;padding-bottom : 7px;cursor: pointer;">
                            REQUEST CATALOG
                        </button>
                    </div> -->

                        </div>
                        <div class="contact-catalog-section">
                            <div class="top-links">
                                <a href="{{ url('/') }}/contactus">Contact Us</a> &nbsp;|&nbsp;
                                <a href="{{ url('/') }}/request-catalog">Request Catalog</a>
                            </div>

                            <div class="icons">
                                <div class="artha-header-search">


                                    <a href="#search">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>

                                    <div id="search-box">
                                        <div class="container">
                                            <a class="close" href="#close"></a>
                                            <div class="search-main">
                                                <div class="search-inner">
                                                    <form action="{{ route('products.search') }}" method="GET">
                                                        <input type="text" id="inputSearch" name="query"
                                                            placeholder="Search Here"
                                                            value="{{ old('query', request('query')) }}" required>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    {{-- <a href="#search">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a> --}}
                                    <a href="{{ route('wishlist') }}">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                    <a
                                        href="@if (auth()->user()) {{ route('logout') }} @else {{ route('login') }} @endif">
                                        @if (auth()->user())
                                            {{-- <i class="fa-regular fa-arrow-right-from-bracket"></i> --}}
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            {{-- LOGOUT --}}
                                        @else
                                            <i class="fa-regular fa-user"></i>
                                            {{-- LOGIN --}}
                                        @endif
                                    </a>

                                </div>
                                {{-- <ul class="list-unstyled d-flex login_wishlist">
                                    <li>
                                        <a href="{{ route('wishlist') }}">
                                            <i class="fa-regular fa-heart"></i>
                                        </a>
                                    </li>

                                    <li class="header_login_btn">
                                        <a
                                            href="@if (auth()->user()) {{ route('logout') }} @else {{ route('login') }} @endif">
                                            @if (auth()->user())
                                                <!-- <i class="fa-regular fa-arrow-right-from-bracket"></i> -->
                                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                                <!-- LOGOUT -->
                                            @else
                                                <i class="fa-regular fa-user"></i>
                                                <!-- LOGIN -->
                                            @endif
                                        </a>
                                    </li>

                                </ul> --}}
                            </div>
                        </div>

                        {{-- <div class="HeaderBTN" style="margin-left : 15px;">
                                <a href="{{ url('/') }}/request-catalog"
                                    style="background-color:#DFAE60;padding-left:30px; padding-right: 30px;border:none; font-size:12px;padding-top: 5px;padding-bottom : 5px;cursor: pointer;">
                                    REQUEST CATALOG
                                </a>
                            </div> --}}

                    </div>

                </div>

            </div>

        </div>

    </header>



    <header class="page-header headermenuouter mobile-menu">

        <nav>

            <div class="header-bar">

                <div class="artha-header-logo">

                    <a href="{{ route('home') }}"><img src="{{ url('/') }}/front/images/logo.png"></a>

                </div>

                <div class="header-icon-menu">

                    <div class="artha-header-search">

                        <a href="#search" id="searchToggle1">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>

                        {{-- <div id="search-box1" style="display: none;">
                            <div class="container mobile-search-input-field">
                                <a class="close" href="javascript:void(0);" id="searchClose1">&times;</a>
                                <div class="search-main">
                                    <div class="search-inner">
                                        <input type="search" id="inputSearch" name="search"
                                            placeholder="Search Here">
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                    </div>

                    <div class="header_login_btn"><a href="{{ route('login') }}"> <i class="fa-solid fa-user"></i>
                        </a></div>

                    <div><a href="{{ route('wishlist') }}"><i class="fa-solid fa-heart"></i></a></div>

                    <button class="toggle-menu" type="button">

                        <i class="fa-solid fa-bars"></i>

                    </button>

                </div>

            </div>

            <div class="menu-wrapper">

                <div class="list-wrapper">

                    <ul class="menu level-1">

                        <li>

                            <a href="{{ route('home') }}" class="nested">

                                Home </a>



                        </li>

                        <li>

                            <a href="{{ url('/') }}/aboutus" class="nested">

                                About us</a>



                        </li>

                        <li class="dropdowns">

                            <a class="nested">

                                Jewellery<i class="fa fa-angle-right"></i> </a>

                            <ul class="sub-menu level-1">

                                <li class="dropdowns">

                                    <a class="nested">

                                        All Collections <i class="fa fa-angle-right"></i></a>

                                    <ul class="sub-menu level-3">

                                        <div class="img-text-section">

                                            @if ($collections)

                                                @foreach ($collections as $collection)
                                                    <div class="img-text-inner">

                                                        <a href="{{ url('/') }}/{{ $collection->slug }}">

                                                            <div class="image-section">

                                                                <?php
                                                                
                                                                $collection_image = '';
                                                                
                                                                if (substr($collection->image, 0, 7) == 'http://' || substr($collection->image, 0, 8) == 'https://') {
                                                                    $collection_image = $collection->image;
                                                                } else {
                                                                    $collection_image = URL::asset('/categories/' . $collection->menu_image);
                                                                }
                                                                
                                                                ?>

                                                                <img src="{{ $collection_image }}" alt=""
                                                                    class="img-fluid">

                                                            </div>

                                                            <h4>{{ $collection->name }}</h4>

                                                        </a>

                                                    </div>
                                                @endforeach

                                            @endif

                                        </div>

                                    </ul>



                                </li>



                                @foreach ($categories as $category)
                                    <li class="dropdowns">

                                        <a class="nested">

                                            {{ $category->name }} <i class="fa fa-angle-right"></i></a>

                                        <ul class="sub-menu level-3">

                                            <div class="img-text-section">

                                                @foreach ($category[$category->slug] as $collection)
                                                    <a
                                                        href="{{ route('show_page_category_collection', ['coll' => $collection['slug'], 'id' => $category->id]) }}">

                                                        @php

                                                            $product_image = URL::asset(
                                                                '/assets1/Images/no_image/no_image.jpg',
                                                            );

                                                            if (
                                                                $category->slug == 'rings' &&
                                                                isset($collection['ring_image'])
                                                            ) {
                                                                $product_image = URL::asset(
                                                                    '/ring_image/' . $collection['ring_image'],
                                                                );
                                                            }

                                                            if (
                                                                $category->slug == 'necklaces' &&
                                                                isset($collection['necklace_image'])
                                                            ) {
                                                                $product_image = URL::asset(
                                                                    '/necklace_image/' . $collection['necklace_image'],
                                                                );
                                                            }

                                                            if (
                                                                $category->slug == 'earrings' &&
                                                                isset($collection['ear_jewelry_mage'])
                                                            ) {
                                                                $product_image = URL::asset(
                                                                    '/ear_jewelry_mage/' .
                                                                        $collection['ear_jewelry_mage'],
                                                                );
                                                            }

                                                            if (
                                                                $category->slug == 'bracelets' &&
                                                                isset($collection['bracelets_image'])
                                                            ) {
                                                                $product_image = URL::asset(
                                                                    '/bracelets_image/' .
                                                                        $collection['bracelets_image'],
                                                                );
                                                            }

                                                        @endphp




                                                        <div class="img-text-inner">

                                                            <div class="image-section">

                                                                <img src="{{ $product_image }}"
                                                                    alt="{{ $collection['name'] }}"
                                                                    class="img-fluid">

                                                            </div>

                                                            <h4>{{ $collection['name'] }}</h4>

                                                        </div>

                                                    </a>
                                                @endforeach

                                            </div>

                                        </ul>

                                    </li>
                                @endforeach

                                <div class="tab-view-all">

                                    <a class="nav-item" href="{{ route('all_product.details') }}">View all</a>

                                </div>

                            </ul>







                        </li>

                        <li>

                            <a href="{{ url('/') }}/contactus" class="nested">

                                Contact Us</a>

                            <!-- <ul class="sub-menu level-2">

                                <li>

                                    <a href="">History</a>

                                </li>

                                <li>

                                    <a href="">Team</a>

                                </li>

                                <li>

                                    <a href="" class="nested">Careers</a>

                                    <ul class="sub-menu level-3">

                                        <li>

                                            <a href="">Sales Assistant</a>

                                        </li>

                                        <li>

                                            <a href="">Graphic Designer</a>

                                        </li>

                                        <li>

                                            <a href="">Marketing Specialist</a>

                                        </li>

                                        <li>

                                            <a href="">Storekeeper</a>

                                        </li>

                                    </ul>

                                </li>

                            </ul> -->

                        </li>

                    </ul>

                </div>

                <div class="list-wrapper">

                    <button type="button" class="back-one-level">

                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24">

                            <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"
                                fill="#272727" />

                        </svg>

                        <span>Back</span>

                    </button>

                    <div class="sub-menu-wrapper"></div>

                </div>

                <div class="list-wrapper">

                    <button type="button" class="back-one-level">

                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24">

                            <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"
                                fill="#272727" />

                        </svg>

                        <span>Back</span>

                    </button>

                    <div class="sub-menu-wrapper"></div>

                </div>

            </div>

        </nav>

    </header>

    
    <div id="search-box1" style="">
        <div class="container mobile-search-input-field">
            <a class="close" href="#close" id="searchClose1">&times;</a>
            <div class="search-main">
                <div class="search-inner">
                    <form action="{{ route('products.search') }}" method="GET">
                        <input type="text" id="inputSearch" name="query" placeholder="Search Here"
                            value="{{ old('query', request('query')) }}" required>
                    </form>
                    {{-- <input type="search" id="inputSearch" name="search" placeholder="Search Here"> --}}
                </div>
            </div>
        </div>
    </div>
