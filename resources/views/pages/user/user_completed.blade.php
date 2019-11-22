@extends('layouts.user-layout')
@section('content')
    <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12">
              <div class="card-box">
                <h4 class="header-title mt-0 m-b-30">Completed Request(s)</h4>
                <div class="table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr style="text-align:center;">
                        <th>View</th>
                        <th>Req-No.</th>
                        <th>Request To</th>
                        <th>Request</th>
                        <th>Dept. Head</th>
                        <th>Manager</th>
                        <th>Request Status</th>
                        <th>Requested</th>
                      </tr>
                    </thead>
                    <tbody>
                         @foreach ($completed as $requests)
                           <tr style="text-align:center;">
                              <td>
                                 <a href="{{route('user.req_details',$requests->request_id)}}" class="btn btn-primary">
                                    <i class="mdi mdi-eye"></i>
                                 </a>
                              </td>
                             <td>{{$requests->request_id}}</td>
                             <td>{{$requests->request_to}}</td>
                             <td title="{{$requests->request_concern}}">{{Str::limit($requests->request_concern,30)}}</td>
                             @if ($requests->supervisor_approval == null)
                             <td><span class="badge badge-danger" title="{{$requests->route_to_supervisor}}">pending</span></td>
                             @else
                             <td><span class="badge badge-success" title="{{$requests->route_to_supervisor}}">approved</span></td>
                             @endif
                             @if ($requests->manager_approval == null)
                             <td><span class="badge badge-danger" title="{{$requests->route_to_manager}}">pending</span></td>
                             @else
                             <td><span class="badge badge-success" title="{{$requests->route_to_manager}}">approved</span></td>
                             @endif
                             <td><span class="badge badge-success">{{$requests->request_status}}</span></td>
                             <td>{{ Carbon\Carbon::parse($requests->date_requested)->diffForHumans()}}</td>
                           </tr>
                         @endforeach
                    </tbody>
                  </table>
                </div><br><br>
              </div>
            </div>
          </div>
      </div>
   </div>
@endsection