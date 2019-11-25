@extends('layouts.approver-layout')
@section('content')
<div class="content-page">><br>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8 offset-2">
          <div class="card-box">
            <div class="alert" style="background-color:#01939e;">
               <h5 style="text-align:center;color:white;"><b>Plant Maintenance</b></h5>
            </div>
            <label style="color:red;">Note: All fields with (*) are required</label>
            <form method="POST" action="{{route('approver.submit_request_form')}}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>*Type of Request</label>
                <input type="hidden" name="request_to" value="PLANT MAINTENANCE">
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <div class="checkbox">
                              <input name="tor[]" id="checkbox0" value="Breakdown" type="checkbox">
                              <label for="checkbox0">
                                  Breakdown
                              </label>
                          </div>
                          <div class="checkbox">
                              <input name="tor[]" id="checkbox1" value="Repair" type="checkbox">
                              <label for="checkbox1">
                                  Repair
                              </label>
                          </div>
                          <div class="checkbox">
                              <input name="tor[]" id="checkbox2" value="Setup and Pre-Qualification" type="checkbox">
                              <label for="checkbox2">
                                  Setup and Pre-qualification
                              </label>
                          </div>
                          <div class="checkbox">
                              <input name="tor[]" id="checkbox3" value="Improvement" type="checkbox">
                              <label for="checkbox3">
                                  Improvement
                              </label>
                          </div>
                          <div class="checkbox">
                              <input name="tor[]" id="checkbox4" value="Preventive Maintenance" type="checkbox">
                              <label for="checkbox4">
                                  Preventive Maintenance
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <div class="checkbox">
                              <input name="tor[]" id="checkbox5" value="Machine Change-Over/Conversion" type="checkbox">
                              <label for="checkbox5">
                                  Machine Change-Over/Conversion
                              </label>
                          </div>
                          <div class="checkbox">
                              <input name="tor[]" id="checkbox6" value="New Design" type="checkbox">
                              <label for="checkbox6">
                                  New Design
                              </label>
                          </div>
                          <div class="checkbox">
                              <input name="tor[]" id="checkbox7" value="Design Revision" type="checkbox">
                              <label for="checkbox7">
                                  Design Revision
                              </label>
                          </div>
                          <div class="checkbox">
                              <input name="tor[]" id="checkbox8" value="Re-qualification" type="checkbox">
                              <label for="checkbox8">
                                  Re-qualification
                              </label>
                          </div>
                          <div class="checkbox">
                              <input type="text" id="other_request" class="form-control" name="tor[]" placeholder="Others">
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>*Process Area/Department</label>
                    <select name="area_of_request" id="area_of_request" class="form-control" required>
                      <option value="" disabled selected>--Department--</option>
                           @foreach ($get_all_department as $dept)
                           <option value="{{ $dept->department }}">{{ $dept->department }}</option>  
                           @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>*Plant Designation</label>
                    <select name="plant_designation" id="plant_designation" class="form-control" required>
                      <option value="" disabled selected>--Plant--</option>
                      <option value="MAIN PLANT">(Main) Plant 1/2/3/4</option>
                      <option value="PLANT 5">Plant 5</option>
                      <option value="PLANT 7">Plant 7</option>
                      <option value="PLANT 8/9/10">Plant 8/9/10</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Model</label>
                    <input name="model" id="model" type="text" class="form-control" placeholder="Blank if none">
                  </div>
                  <div class="col-md-6">
                    <label>Lot No./Batch No.</label>
                    <input name="ln_bn" id="ln_bn" type="text" class="form-control" placeholder="Blank if none">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="emailAddress">*Request</label>
                <textarea name="request_concern" id="request_concern" rows="7" class="form-control" placeholder="Compose" required></textarea>
              </div>
                  <div class="form-group">
                     <label>*Route to Manager:</label>
                     <select name="route_to_manager" id="route_to_manager" class="form-control" required>
                        <option value="" disabled selected>--Manager--</option>
                              @foreach ($get_all_manager as $manager)
                              <option value="{{$manager->name}}">{{$manager->name}}</option>   
                              @endforeach
                     </select>
                  </div>
              <div class="form-group">
                <label for="emailAddress">Attach file <p class="text-muted">(Supported files: docx, jpg, jpeg, png, pdf, xls, xlsm, xlsx)</p> </label>
                <input type="file" class="dropify" data-height="150" / name="attached_file">
              </div>
              <div class="form-group text-right m-b-0">
                <button class="btn btn-primary waves-effect waves-light" type="submit" id="submitRequest">
                  Submit
                </button>
                <button type="reset" class="btn btn-secondary waves-effect waves-light m-l-5">
                  Reset
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection