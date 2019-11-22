@extends('layouts.error-layout')
@section('content')

<div class="topbar">
        <div class="topbar-left" style="border-top: 7px solid #034ea2; background:#ebeff2;">
        </div>
        <div class="navbar navbar-default" style="border-top: 7px solid #01939e; background-color:#ebeff2;">
          <div class="container-fluid" style="background-color: #ebeff2;">
          </div>
        </div>
      </div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="text-center">
        <img src="assets/images/shinetsu.png.png" alt="Shin-Etsu" style="width: 70%; height:60%;">
    </div><br>
    <div class="m-t-40 card-box">
        <div class="ex-page-content text-center">
            <div style="color: #00929e;font-size: 98px;font-weight: 700;line-height: 150px; margin-top:-30px;">419</div>
            <h3 class="font-600" style="color:#034ea2">Page Expired</h3>
            <p class="text-muted">
                It looks like you have idled the page too long. Don't worry it happens for
                the best of us. You might have to re-login in order to get you back.
            </p>
            <br>
            <a class="btn" href="/" style="background-color:#00929e;color:white;"> <i class="mdi mdi-arrow-left-bold-circle-outline"></i> Back to login</a>
        </div>
    </div>
</div>
 
@endsection
