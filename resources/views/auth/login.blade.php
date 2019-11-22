@extends('layouts.login-layout')
@section('content')
<body class="fixed-left" style="background-color:#ebeff2;">
<div id="wrapper">
  <div class="topbar">
    <div class="topbar-left" style="border-top: 7px solid #034ea2; background:#ebeff2;">
    </div>
    <div class="navbar navbar-default" style="border-top: 7px solid #01939e; background-color:#ebeff2;">
      <div class="container-fluid" style="background-color: #ebeff2;">
      </div>
    </div>
  </div>
  <div class="wrapper-page">
    <div class="text-center">
      <img src="assets/images/shinetsu.png.png" alt="Shin-Etsu" style="width: 70%; height:60%;">
      <h5 class="text-muted m-t-0 font-600">Online Service Request</h5>
    </div><br>
    <div class="m-t-40 card-box">
      <div class="text-center">
        <h4 class="text-uppercase font-bold m-b-0">Login</h4>
      </div>
      <div class="p-20">
        <form class="form-horizontal m-t-20" method="POST" action="{{route('login')}}">
            @csrf
          <div class="form-group">
            <div class="col-xs-12">
                <input placeholder="Employee Number" id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-12">
                <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group ">
            <div class="col-xs-12">
              <div class="checkbox checkbox-custom">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
              </div>
            </div>
          </div>
          <div class="form-group text-center m-t-30">
            <div class="col-xs-12">
              <button class="btn btn-bordred btn-block waves-effect waves-light" type="submit"
                style="background-color:#00929e; color:white;">Log In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection