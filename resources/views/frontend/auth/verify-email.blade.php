@extends('frontend.layouts.app')

@section('content')
<div class="register">
    <div class="container">
        <div class="register_inr">
            <h3>Email Verification</h3>
            <form action="{{route('verification.send')}}" method="post">
                @csrf
                <div class="row register_inr_row">
                    <div class="col-md-12">
                        <p style="font-size:14px;text-align:center;justify-content:center;">Thanks for signing up, {{ Auth::user()->name }}!</p>
                        <p style="font-size:14px;text-align:center;justify-content:center;">We've sent a verification link to {{ Auth::user()->email }}.</p>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <p style="font-size:14px;text-align:center;justify-content:center;padding-top:20px;">Please check your inbox and click the link to activate your account. (If you don't see it, check your spam or junk folder.)</p>
                    </div>


                    <div class="col-md-12 mt-3">
                        <p style="font-size:14px;text-align:center;justify-content:center;padding-top:20px;">Did not get it?</p>
                    </div>
        
                    <div class="d-flex justify-content-center">
                        <button type="btn" class="artha-product-list-btn register-btn">Send again</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection