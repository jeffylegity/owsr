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
        <img src="{{URL::asset('assets/images/shinetsu.png.png')}}" alt="Shin-Etsu" style="width: 70%; height:60%;">
    </div><br>
    <div class="m-t-40 card-box">
       <div class="form-group">
          <h4>Why get premium?</h4>
          <p>get unlimited requests to you favorite support group anytime anywhere!</p>
       </div>
      <div class="form-group">
         <label>Card Number</label>
         <input type="text" class="form-control" placeholder="xxx-xx-xxxx">
      </div>
      <div class="form-group">
         <label>Expiry Date</label>
         <div class="row">
            <div class="col-md-4">
               <input type="text" class="form-control" placeholder="MM">
            </div>
            <div class="col-md-4">
               <input type="text" class="form-control" placeholder="YY">
            </div>
            <div class="col-md-4">
               <input type="text" class="form-control" placeholder="CV Code">
            </div>
         </div>
      </div>
      <div class="form-group" style="display:flex">
         <button class="btn btn-primary" style="width:100%;" disabled>Php 200.00 (per month)</button>
      </div>
      <div class="form-group" style="display:flex">
         <button class="btn btn-success" style="width:100%;"><i class="mdi mdi-credit-card"></i> Pay</button>
      </div>
    </div>
</div> 
@endsection
