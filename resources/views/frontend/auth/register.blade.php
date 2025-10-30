@extends('frontend.layouts.app')

@section('content')
<div class="register">
    <div class="container">
        <div class="register_inr">
            <h3>Register/Sign Up</h3>
            <form action="{{route('register.post')}}" method="post">
                @csrf
                <div class="row register_inr_row">
                    <div class="col-md-6">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name *" value="{{old('first_name')}}" aria-label="First name">
                        @if ($errors->has('first_name'))
                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name *" value="{{old('last_name')}}" aria-label="Last name">
                        @if ($errors->has('last_name'))
                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" id="inputEmail4" value="{{old('email')}}" placeholder="Email Address *">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="url" name="website" class="form-control" id="website" value="{{old('website')}}" placeholder="Website">
                        @if ($errors->has('website'))
                            <span class="text-danger">{{ $errors->first('website') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="company" class="form-control" id="company" value="{{old('company')}}" placeholder="Company">
                        @if ($errors->has('company'))
                            <span class="text-danger">{{ $errors->first('company') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="streetaddress" class="form-control" id="streetaddress" value="{{old('streetaddress')}}" placeholder="Street Address *">
                        @if ($errors->has('streetaddress'))
                            <span class="text-danger">{{ $errors->first('streetaddress') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="city" class="form-control" id="city" placeholder="City *" value="{{old('city')}}">
                        @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                        @endif
                    </div>
                  <div class="col-md-6">
                        <select id="Country" name="country" class="form-control">
                            <option value="0" selected>Select Country *</option>
                            @if(!blank($countries))
                                @foreach ($countries as $country)
                                    <option value="{{$country['id']}}" @if(old('country') == $country['id']) selected @endif>{{$country['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('country'))
                            <span class="text-danger">{{ $errors->first('country') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <select id="State" name="state" class="form-control">
                            <option value="0" selected>State / Provience *</option>
                            @if(!blank($states))
                                @foreach ($states as $state)
                                    <option value="{{$state['id']}}" @if(old('state') == $state['id']) selected @elseif($state['id'] == '236') selected @endif>{{$state['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="Zip Code *" value="{{old('zipcode')}}">
                        @if ($errors->has('zipcode'))
                            <span class="text-danger">{{ $errors->first('zipcode') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="phone" class="form-control" id="telephone" placeholder="Telephone" value="{{old('phone')}}">
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password *">
                    </div>
                    <div class="col-md-6">
                        <input type="password" name="confirm_password" class="form-control" id="password1" placeholder="Confirm Password *">
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control mb-0" placeholder="Enter Verification Code *" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">gCna6n8</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="artha-product-list-btn register-btn">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('change','#Country',function(){
                var country = $(this).val();
                $.ajax({
                    url : "{{route('stateByCountry', '')}}"+"/"+country,
                    type : 'GET',
                    dataType:'json',
                    success : function(data) {
                        $('#State').html(data);
                    }
                });
            });
        });
    </script>
@endsection
