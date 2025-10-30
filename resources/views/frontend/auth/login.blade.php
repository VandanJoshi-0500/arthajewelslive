@extends('frontend.layouts.app')

@section('content')
    <div class="login">
        <div class="container">
            @if(Session::has('register'))
                <p class="alert
                            {{ Session::get('alert-class', 'alert-danger') }}">{{Session::get('register') }}
                </p>
            @endif
            <h3>LOGIN OR CREATE AN ACCOUNT</h3>
            <div class="login_otr">
                <div class="login_left">
                    <h5>NEW CUSTOMERS</h5>
                    <div class="login_left_inr">
                        <p>By creating an account with our store, you will be able to move through the checkout process
                            faster, store multiple shipping addresses, view and track your orders in your account and more.
                        </p>
                        <a href="{{route('register')}}" class="artha-product-list-btn"> Create An Account</a>
                    </div>
                </div>
                <div class="login_right">
                    <h5>Login</h5>
                    <div class="login_left_inr">
                        @if(Session::has('message'))
                            <p class="text-danger">{{Session::get('message') }}
                            </p>
                        @endif
                        <form action="{{ route('login.post') }}" method="post">
                            @csrf
                            <input type="email" id="email" name="email" placeholder="Email Address *"
                                value="{{old('email')}}" class="form-control w-50">
                            @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                            <input type="password" id="password" name="password" class="form-control w-50"
                                placeholder="Password *">
                            @if ($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                            <div class="mb-3">
                                <input type="checkbox" onclick="showpw()" id="showPassword" class="me-2"><label
                                    class="d-inline-block" for="showPassword"><small>Show Password</small></label>
                                <div class="error-message text-danger" id="password-error"></div>
                            </div>
                            <a href="{{ route('forget.password') }}">( Forget your Password? )</a>
                            <button type="submit" class="artha-product-list-btn right"> Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function showpw() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection