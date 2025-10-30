@include('frontend.partials.header')
<section class="wishlist">
    <div class="container">
        <div class="wishlist_outer">
            <div class="wishlist_left">
                <h6>My Account</h6>
                <ul class="list-unstyled">
                    <li>
                       <a href="{{route('my_account')}}"><h5 @if(isset($page)) @if($page == 'my_account') class="active" @endif @endif><i class="fa-solid fa-caret-right"></i>Account Dashboard</h5></a>
                    </li>
                    <li>
                        <a href="{{route('account_information')}}"><h5 @if(isset($page)) @if($page == 'account_information') class="active" @endif @endif><i class="fa-solid fa-caret-right"></i>Account Information</h5></a>
                     </li>
                     <li>
                        <a href="{{route('address_book')}}"><h5 @if(isset($page)) @if($page == 'address_book') class="active" @endif @endif><i class="fa-solid fa-caret-right"></i>Address Book</h5></a>
                     </li>
                     <li>
                        <a href="{{route('wishlist')}}"><h5 @if(isset($page)) @if($page == 'my_wishlist') class="active" @endif @endif><i class="fa-solid fa-caret-right"></i>My Wishlist</h5></a>
                     </li>
                     <li>
                        <a href="{{route('wishlist_history')}}"><h5 @if(isset($page)) @if($page == 'wishlist_history') class="active" @endif @endif><i class="fa-solid fa-caret-right"></i>My Wishlist History</h5></a>
                     </li>
                </ul>
            </div>
            <div class="wishlist_right">
                @yield('content')
            </div>
        </div>
    </div>
</section>
@include('frontend.partials.footer')
