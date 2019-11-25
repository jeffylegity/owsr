@extends('layouts.manager-layout')
@section('content')
<div class="content-page">><br>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8 offset-2">
          <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Work Request and Troubleshooting Details</h4>
            @foreach ($get_request_details as $request)
            <form>
             <hr>
             <div class="form-group">
                <div class="row">
                   <div class="col-md-6">
                        <label>Request Number:</label>
                        <input type="text" class="form-control" value="{{$request->request_id}}" disabled>
                   </div>
                   <div class="col-md-6">
                        <label>Request to:</label>
                        <input type="text" class="form-control" value="{{$request->request_to}}" disabled>
                   </div>
                </div>
              </div>
              <div class="form-group">
                <label for="userName">Type of Request</label>
                <input type="text" class="form-control" value="{{$request->type_of_request}}" disabled>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label for="userName">Process Area/Department</label>
                    <input type="text" class="form-control" value="{{$request->area_of_request}}" disabled>
                  </div>
                  <div class="col-md-6">
                    <label for="userName">Plant Designation</label>
                    <input type="text" class="form-control" value="{{$request->plant_designation}}" disabled>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Model</label>
                    @if ($request->model == null)
                    <input type="text" class="form-control" value="N/A" disabled>
                    @else
                    <input type="text" class="form-control" value="{{$request->plant_designation}}" disabled>
                    @endif
                  </div>
                  <div class="col-md-6">
                    <label>Lot No. / Batch No.</label>
                    @if ($request->ln_bn == null)
                    <input type="text" class="form-control" value="N/A" disabled>
                    @else
                    <input type="text" class="form-control" value="{{$request->ln_bn}}" disabled>
                    @endif
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="emailAddress">Request</label>
                <textarea name="request_concern" id="request_concern" rows="5" class="form-control" disabled>{{$request->request_concern}}</textarea>
              </div>
              <br>
              <hr>
              <div class="form-group">
                  <div class="row">
                     <div class="col-md-9">
                        @if ($request->route_to_supervisor == 'NOT APPLICABLE')
                        <input type="hidden" name="NA">
                        @else
                        <label for="userName">Dept. Head</label>
                        <input type="text" class="form-control" value="{{$request->route_to_supervisor}}" disabled>
                        @endif
                     </div>
                     <div class="col-md-3">
                        @if ($request->supervisor_approval == 1)
                        <label for="userName">Approval</label>
                        <input type="text" class="form-control" style="background-color:#10c469; text-align:center; color:white;" value="APPROVED" disabled>
                        @else
                           @if ($request->route_to_supervisor == 'NOT APPLICABLE')
                           <input type="hidden" name="NA">
                           @else
                           <input type="text" class="form-control" style="background-color:#ff5b5b; text-align:center; color:white;" value="PENDING" disabled>
                           @endif
                        @endif
                     </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                     <div class="col-md-9">
                        <label for="userName">Manager</label>
                        <input type="text" class="form-control" value="{{$request->route_to_manager}}" disabled>
                     </div>
                     <div class="col-md-3">
                        <label for="userName">Approval</label>
                        @if ($request->manager_approval == 1)
                        <input type="text" class="form-control" style="background-color:#10c469; text-align:center; color:white;" value="APPROVED" disabled>
                        @else
                        <input type="text" class="form-control" style="background-color:#ff5b5b; text-align:center; color:white;" value="PENDING" disabled>
                        @endif
                     </div>
                  </div>
                </div>
                <br>
                <hr>
              <div class="form-group">
                <label for="emailAddress">Download Attached file</label><br>
                @if ($request->attached_file == null)
                <button class="btn btn-danger" disabled><i class="fa fa-ban"></i> No attached file</button>
                @else
                
                <a href="{{route('download-attached-files',$request->attached_file)}}" class="btn btn-secondary" target="_blank"><i class="fa fa-download"></i>  Download</a>&ensp;&ensp;
                ({{$request->attached_file}})
                @endif
              </div>
              <div class="form-group text-right m-b-0">
                <a href="javascript:history.back()" class="btn btn-secondary" style="background-color:#01939e">
                  <i class="mdi mdi-arrow-left-bold"></i> Back
                </a>
              </div>
            </form>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection