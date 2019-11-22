@extends('layouts.manager-layout')
@section('content')
    <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12">
              <div class="card-box">
                <h4 class="header-title mt-0 m-b-30">Approval Request(s)</h4>
                <div class="table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr style="text-align:center;">
                        <th>View</th>
                        <th>Req-No.</th>
                        <th>Request To</th>
                        <th>Request</th>
                        <th>Request Status</th>
                        <th>Requested</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach ($for_approval as $request)
                      <tr style="text-align:center;">
                        <td>
                           <a href="{{route('manager.req_details', $request->request_id)}}" class="btn btn-primary"><i class="mdi mdi-eye"></i></a>
                        </td>
                        <td>{{$request->request_id}}</td>
                        <td>{{$request->request_to}}</td>
                        <td>{{$request->request_concern}}</td>
                        <td><span class="badge badge-danger">{{$request->request_status}}</span></td>
                        <td>{{ Carbon\Carbon::parse($request->date_requested)->diffForHumans()}}</td>
                     </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
   </div>
@endsection