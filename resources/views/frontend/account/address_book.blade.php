@extends('frontend.layouts.account')

@section('content')
    <h2 class="text-center">Address Book</h2>
    <div class="items_wishlist">
        <div class="text-start my_dashboard mt-4">
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
