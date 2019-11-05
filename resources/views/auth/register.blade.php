@extends('layouts.app')

@section('content')
 <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>{{ __('Register') }}</b></a>
            <small>Admin BootStrap Based - Material Design</small>
        </div>
        <div class="card">
            <div class="body">
                @if (count($errors) > 0)

                  <div class="alert alert-danger">
                     <strong>Oh snap! </strong> {{ $errors->first() }}.

                     {{--  <ul>
                          @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                          @endforeach
                      </ul> --}}
                  </div>

                @endif
                <form id="sign_up" method="POST" action="{{ route('register') }}" novalidate="true">
                    @csrf
                    <div class="msg">Register a new membership</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}"  required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="8" placeholder="{{ __('Password') }}" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password_confirmation" minlength="8" placeholder="{{ __('Confirm Password') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">{{ __('Register') }}</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="{{ route('login') }}">You already have a membership?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('class','signup-page')
{{-- add tile section  --}}
@section('title','Register')

{{-- add meta in html --}}
@push('meta')
<meta name="robots" content="index,follow">
@endpush


{{-- add css for this page --}}
@push('styles')
<link rel="stylesheet" href="#">
@endpush


{{-- and js from child page --}}
@push('scripts')
<script src="{{ asset('admin123/plugins/jquery-validation/jquery.validate.js') }}"></script>
{{-- @endpush --}}


{{-- @push('scripts') --}}

<script type="text/javascript">
   $(function () {
        $('#sign_up').validate({
            rules: {
                'terms': {
                    required: true
                },
                'password_confirmation': {
                    equalTo: '[name="password"]'
                }
            },
            highlight: function (input) {
                console.log(input);
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
                $(element).parents('.form-group').append(error);
            }
        });
    })
</script>
@endpush