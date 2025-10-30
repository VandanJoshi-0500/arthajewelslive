@extends('frontend.layouts.account')

@section('content')
    <h2 class="text-center">My Dashboard</h2>
    <div class="items_wishlist">
        <div class="text-start my_dashboard mt-4">
            <h6> Hello , {{$user->first_name.' '.$user->last_name}}!</h6>
            <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
            <div class="contact_information">
                <h5>Contact Information</h5>
                <a href="{{route('account_information')}}"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
            </div>
            <p>{{$user->first_name.' '.$user->last_name}}</p>
            <p class="password">{{$user->email}}</p>
            <a href="{{route('account_information')}}?changepassword=1">Change Password</a>
            <div class="contact_information">
                <h5>Address Book</h5>
            </div>
            <h6 class="text-dark">Address</h6>
            <p>{{$user->first_name.' '.$user->last_name}}</p>
            <p>{{$user->streetaddress}}</p>
            <p>{{$user->city}}, {{$state->name ?? 'N/A'}}, {{$user->zipcode}}</p>
            <p>{{$country->name ?? 'N/A'}}</p>
            <p>T: {{$user->phone}}</p>
            <a href="{{route('edit_account_information',$user->id)}}">Edit Address</a>
        </div>
    </div>
@endsection
