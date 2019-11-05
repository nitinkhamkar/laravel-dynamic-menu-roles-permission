@extends('layouts.app')

@section('content')
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">{{ __('Login') }}</a>
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

                
                <form id="sign_in" method="POST" action="{{ route('login') }}" novalidate="true">
                        @csrf
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="{{ __('E-Mail Address') }}" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password"   placeholder="{{ __('Password') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="filled-in chk-col-pink">
                            <label for="remember">{{ __('Remember Me') }}</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="{{ route('register') }}">{{ __('Register') }}!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

@endsection

@section('class','login-page')
{{-- add tile section  --}}
@section('title','Login')

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
        $('#sign_in').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8,
                },
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
            }
        });
    });
</script>
@endpush