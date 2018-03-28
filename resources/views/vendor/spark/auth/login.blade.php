@extends('spark::layouts.app')

@section('content')
    <div class="login-box-body">
        <p align="center"> {{ __('Sign in to start your session') }}</p>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">

                <div class=""> <!-- panel-body -->
                    @include('spark::shared.errors')

                    <form class="form-horizontal" role="form" method="POST" action="/login">
                    {{ csrf_field() }}

                    <!-- E-Mail Address -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                       autofocus>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa m-r-xs fa-sign-in"></i> {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">{{ __('Forgot Your Password?') }}</a>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/login/github') }}" class="btn btn-default"><i class="fa fa-github"></i> Github</a>
                                <a href="{{ url('/login/twitter') }}" class="btn btn-default"><i class="fa fa-twitter"></i> Twitter</a>
                                <a href="{{ url('/login/facebook') }}" class="btn btn-default"><i class="fa fa-facebook"></i> Facebook</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
