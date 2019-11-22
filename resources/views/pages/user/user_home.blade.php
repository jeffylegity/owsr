@extends('layouts.user-layout')
@section('content')
    <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12">
              <div class="card-box">
                <h4 class="header-title mt-0 m-b-30">Request Routing</h4>
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
                    {{AsyncWidget::UserPendingForApproval()}}
                  </table>
                </div><br><br>
              </div>
            </div>
          </div>
      </div>
   </div>
@endsection