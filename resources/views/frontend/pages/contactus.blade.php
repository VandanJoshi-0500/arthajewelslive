@extends('frontend.layouts.app')

@section('content')
<div class="contact">
    <div class="container">
        <h2>Contact Us</h2>
        <div class="contact_inr">
            <div class="contact_inr_left">
                <div class="d-flex contact_info">
                    <div class="w-50 contact_info_left d-flex">
                        <i class="fa-solid fa-location-dot me-2"></i>
                        <p> Artha Jewelry S.L. <br/>
                            Calle Gran Via, 40<br/>
                            Planta 7, 3B<br/>
                            28013 Madrid, Spain</p>
                    </div>
                    <ul class="w-50 contact_info_right list-unstyled">
                        <li>
                            <a href="tel:+34910590197" class="d-flex align-items-center"><i class="fa-solid fa-phone me-2"></i> <p>+34 910590197</p></a>
                        </li>
                        <li class="d-flex align-items-center"><i class="fa-solid fa-clock me-2"></i> <p>Mon - Fri / 10:00 AM to 7:00 PM</p></li>
                        <li>
                            <a href="https://mail.google.com/mail/u/0/?fs=1&to=sales@arthajewels.com&tf=cm" target='_blank' class="d-flex align-items-center contactemail"><i class="fa-solid fa-envelope me-2"></i><p>sales@arthajewels.com</p></a>
                        </li>
                    </ul>
                </div>
                <div class="contact_map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12149.913870195229!2d-3.704897!3d40.420403!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42287d077490e3%3A0x582071e22c429e18!2sGran%20V%C3%ADa%2C%2040%2C%20Centro%2C%2028013%20Madrid%2C%20Spain!5e0!3m2!1sen!2sus!4v1730899064344!5m2!1sen!2sus" width="100%" height="300" frameborder="0" style="border: 0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="contact_inr_right">

                @if (session('success'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Display error messages -->
                @if ($errors->any())
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                @endif

                <form action="{{route('submit.contact.form')}}" method="post">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="Your Name *" required >
                    @if ($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                    <input type="text" name="email" class="form-control" placeholder="Enter Email Address *" aria-label="Email">
                    @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                    <textarea name="message" id="" cols="30" rows="7" placeholder="Message *" class="form-control"></textarea>
                    @if ($errors->has('message'))
                        <p class="text-danger">{{ $errors->first('message') }}</p>
                    @endif
                    
                    <button type="submit" class="artha-product-list-btn register-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: '{{route("reload-captcha")}}',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
@endsection
