@extends('frontend.layouts.app')

@section('content')
    <div class="contact">
        <div class="container">
            <div class="Heading"
                style="display: block; align-items: center; justify-content: center; flex-direction: column;padding: 10px;">
                <!-- <p style="font-weight: bold;">REQUEST A CATALOG</p> -->
                <div class="SubTitle" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <!-- <p style="text-align: center;">Home</p>
                    <img src="./next.png" alt="" style="height: 15px; width: 15px;margin-top: -12px;"> -->
                    <h2 style="text-align: center;" class="CatalogTitle">REQUEST A CATALOG</h2>
                </div>
            </div>
            <div class="Form" style="display: block;align-items: center;justify-content: center;margin-top: 3%;">
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

                    <div class="">
                        <form action="{{ route('submit.catalog.form') }}" method="post" class="row g-3"
                            enctype="multipart/form-data" style="display: block; align-items: center; justify-content: center; width: 100%; background-color: #F8F9FA !important;
            padding: 20px !important;
            border-radius: 7px !important;">
                            @csrf

                            <div class="col-md-6">
                                <label for="name" class="form-label">Your Name (required)</label>
                                <input type="text" name="name" class="form-control required" required>
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Your Email (required)</label>
                                <input type="email" name="email" class="form-control required" required>
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label for="phone" class="form-label">Your Phone Number (required)</label>
                                <input type="text" name="phone" class="form-control required" required>
                                @if ($errors->has('phone'))
                                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label for="country" class="form-label">Your Country (required)</label>
                                <input type="text" name="country" class="form-control required" required>
                                @if ($errors->has('country'))
                                    <p class="text-danger">{{ $errors->first('country') }}</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="company" class="form-label" style="font-size:15px !important;">Company
                                    Name</label>
                                <input type="text" name="company" class="form-control required" required
                                    style="font-size:15px !important;">
                                @if ($errors->has('company'))
                                    <p class="text-danger">{{ $errors->first('company') }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="category" class="form-label">Category</label>
                                <select name="category[]" class="form-control" multiple>
                                    <option value="All">All</option>
                                    <option value="Necklaces">Necklaces</option>
                                    <option value="Bracelets and Bangles">Bracelets and Bangles</option>
                                    <option value="Earrings">Earrings</option>
                                    <option value="Rings">Rings</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="collection" class="form-label">Collection</label>
                                <select name="collection[]" class="form-control" multiple>
                                    <option value="All">All</option>
                                    <option value="Bloom">Bloom</option>
                                    <option value="Dangle">Dangle</option>
                                    <option value="Glamour">Glamour</option>
                                    <option value="Iconic">Iconic</option>
                                    <option value="Illusion">Illusion</option>
                                    <option value="Infinity">Infinity</option>
                                    <option value="Lumiere">Lumiere</option>
                                    <option value="The One">The One</option>
                                    <option value="Trend">Trend</option>
                                    <option value="Unique">Unique</option>
                                    <option value="Victorian">Victorian</option>
                                </select>
                            </div>



                            <div class="col-md-12">
                                <label for="floatingTextarea2" style="">Comments</label>
                                <textarea name="comments" class="form-control" placeholder="Leave a comment here"
                                    id="floatingTextarea2"
                                    style="height: 150px;padding:25px 20px !important !important;font-size:15px !important;"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="attachment" class="form-label"
                                    style="font-size:15px !important;">Attachment</label>
                                <input type="file" name="attachment" class="form-control"
                                    style="font-size:15px !important;">
                            </div>
                            <div class="col-md-6">&nbsp;</div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-outline-dark" style="padding-left: 50px !important;
            padding-right: 50px !important; background-color:#000000;color:#ffffff">Send</button>
                            </div>
                        </form>
                        <div>

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