@extends('frontend.layouts.account')

@section('content')
<h2 class="text-center">Edit Address Book</h2>
<div class="items_wishlist">
    <div class=" my-4">
        <form action="{{route('updateaddressbook')}}" method="post">
            @csrf
            <div class="row register_inr_row">
                <div class="col-md-6">
                    <input type="text" name="first_name" class="form-control" placeholder="First Name *" aria-label="First name" value="{{$user->first_name}}">
                    @if ($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name *" aria-label="Last name" value="{{$user->last_name}}">
                    @if ($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="url" name="website" class="form-control" id="website" placeholder="Website" value="{{$user->website}}">
                    @if ($errors->has('website'))
                        <span class="text-danger">{{ $errors->first('website') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="text" name="company" class="form-control" id="company" placeholder="Company" value="{{$user->company}}">
                    @if ($errors->has('company'))
                        <span class="text-danger">{{ $errors->first('company') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="text" name="streetaddress" class="form-control" id="streetaddress" placeholder="Street Address *" value="{{$user->streetaddress}}">
                    @if ($errors->has('streetaddress'))
                        <span class="text-danger">{{ $errors->first('streetaddress') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="text" name="city" class="form-control" id="city" placeholder="City *" value="{{$user->city}}">
                    @if ($errors->has('city'))
                        <span class="text-danger">{{ $errors->first('city') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <select id="inputState" name="state" class="form-control">
                        <option selected>State / Provience *</option>
                        @if(!blank($states))
                            @foreach ($states as $state)
                                <option value="{{$state['id']}}" @if(old('state') == $state['id']) selected @elseif($state['id'] == $user->state) selected @endif>{{$state['name']}}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('state'))
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <select id="inputCountry" name="country" class="form-control">
                        <option selected>Select Country *</option>
                        @if(!blank($countries))
                            @foreach ($countries as $country)
                                <option value="{{$country['id']}}" @if(old('country') == $country['id']) selected @elseif($country['id'] == $user->country) selected @endif>{{$country['name']}}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('country'))
                        <span class="text-danger">{{ $errors->first('country') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="Zip Code *" value="{{$user->zipcode}}">
                    @if ($errors->has('zipcode'))
                        <span class="text-danger">{{ $errors->first('zipcode') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="number" name="phone" class="form-control" id="telephone" placeholder="Telephone" value="{{$user->phone}}">
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="number" name="fax" class="form-control" id="fax" placeholder="Fax" value="{{$user->fax}}">
                    @if ($errors->has('fax'))
                        <span class="text-danger">{{ $errors->first('fax') }}</span>
                    @endif
                </div>
                <div class="d-flex mt-2">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <a href="{{route('address_book')}}" class="artha-product-list-btn save_adddress me-3">Back</a>
                    <button type="submit" class="artha-product-list-btn save_adddress">Save Addresss</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $(document).on('change','#inputCountry',function(){
            var country = $(this).val();
            $.ajax({
                url : "{{route('stateByCountry', '')}}"+"/"+country,
                type : 'GET',
                dataType:'json',
                success : function(data) {
                    $('#inputState').html(data);
                }
            });
        });
    });
</script>
@endsection
