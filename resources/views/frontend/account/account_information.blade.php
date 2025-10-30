@extends('frontend.layouts.account')

@section('content')
    <h2 class="text-center">Edit Account Information</h2>
    <div class="items_wishlist">
        <div class="text-start my-4">
            <form action="{{ route('update.user.info') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row register_inr_row">
                    <div class="col-md-6">
                        @php $firstName = old('first_name', $user->first_name); @endphp
                        <input type="text" name="first_name" class="form-control" placeholder="First Name *"
                            aria-label="First name" {{ $firstName ? 'value=' . e($firstName) : '' }}>

                        {{-- <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}" aria-label="First name"> --}}
                        @if ($errors->has('first_name'))
                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @php $lastName = old('last_name', $user->last_name); @endphp
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name *"
                            aria-label="Last name" {{ $lastName ? 'value=' . e($lastName) : '' }}>
                        {{-- <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}"
                            aria-label="Last name"> --}}
                        @if ($errors->has('last_name'))
                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" id="inputEmail4"
                            value="{{ $user->email }}">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" name="change_password" id="flexCheckDefault_pw">
                            <label class="form-check-label fw-bold" for="flexCheckDefault_pw">
                                Change Password
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row change_password register_inr_row mt-4">
                    <div class="col-md-6">
                        <input type="password" name="old_password" class="form-control" placeholder="Current Password *"
                            aria-label="First name">
                        @if ($errors->has('old_password'))
                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 d-none d-md-block"></div>
                    <div class="col-md-6">
                        <input type="password" name="new_password" class="form-control" placeholder="New Password *"
                            aria-label="Last name">
                        @if ($errors->has('new_password'))
                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="password" name="confirm_password" class="form-control" id="inputEmail4"
                            placeholder="Confirm Password *">
                        @if ($errors->has('confirm_password'))
                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mt-3">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button type="submit" class="artha-product-list-btn submit save">Save</button>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('script')
    <script>
        <?php
            if(isset($_REQUEST['changepassword'])){
                if($_REQUEST['changepassword'] == 1){ ?>
        $('#flexCheckDefault_pw').attr('checked', true);
        $('.change_password').css('display', 'block');
        <?php
                }
            }
        ?>
        if ($('#flexCheckDefault_pw').prop('checked')) {
            $('#flexCheckDefault_pw').attr('checked', true);
            $('.change_password').css('display', 'block');
        } else {
            $('#flexCheckDefault_pw').attr('checked', false);
            $('.change_password').css('display', 'none');
        }
        $(document).on('click', '#flexCheckDefault_pw', function() {
            if ($('#flexCheckDefault_pw').prop('checked')) {
                $('#flexCheckDefault_pw').attr('checked', true);
                $('.change_password').css('display', 'block');
            } else {
                $('#flexCheckDefault_pw').attr('checked', false);
                $('.change_password').css('display', 'none');
            }
        });
    </script>
@endsection
