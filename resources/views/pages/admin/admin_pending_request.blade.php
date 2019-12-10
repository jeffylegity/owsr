@extends('layouts.admin-layout')
@section('content')
    <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12">
              <div class="card-box">
                <h4 class="header-title mt-0 m-b-30">Pending Request(s)</h4>
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
                        <th>Completed</th>
                        <th>Deny</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending_requests as $request)
                           <tr style="text-align:center">
                              <td>
                                 <a href="{{route('admin.req_details', $request->request_id)}}" class="btn btn-primary btn-sm"><i class="mdi mdi-eye"></i></a>
                              </td>
                              <td>{{$request->request_id}}</td>
                              <td>{{$request->request_to}}</td>
                              <td title="{{$request->request_concern}}">{{Str::limit($request->request_concern,30)}}</td>
                              <td><span class="badge badge-danger">{{$request->request_status}}</span></td>
                              <td>{{ Carbon\Carbon::parse($request->date_requested)->diffForHumans()}}</td>
                              <td>
                                 <a href="{{route('admin.complete_request',$request->request_id)}}" class="btn btn-success btn-sm"><i class="mdi mdi-check"></i></a>
                              </td>
                              <td>
                                 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyForm{{$request->request_id}}">
                                    <i class="mdi mdi-close"></i>
                                 </button>
                              </td>
                              <div class="modal fade" id="denyForm{{$request->request_id}}" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                       <h4 class="header-title" id="exampleModalLabel">Deny Request No. <b>{{$request->request_id}}</b></h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                       </div>
                                       <form action="{{route('admin.deny_request')}}" method="POST" >
                                          @csrf
                                          <div class="modal-body">
                                             <input type="hidden" name="req_id" value="{{$request->request_id}}">
                                             <textarea name="denyTask" class="form-control" rows="5" placeholder="Reason/Recommendation" required></textarea>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                             <button type="submit" class="btn btn-danger">Deny</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
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