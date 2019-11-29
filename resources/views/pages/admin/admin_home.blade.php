@extends('layouts.admin-layout-dashboard')
@section('content')
    <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-4 col-md-6">
              <div class="card-box">
                <div class="dropdown pull-right">
                  <a href="/pending_requests" class="btn btn-sm" style="background-color:#01939e;color:white;">
                      <i class="mdi mdi-eye"></i>View
                  </a>
                </div>
                <h4 class="header-title mt-0 m-b-30">Pending Request(s)</h4>
                <div class="widget-box-2">
                  <div class="widget-detail-2">
                    <i class="mdi mdi-comment-alert-outline mdi-48px" style="float:left;color:#ff5b5b;margin-top:-40px;"></i>
                      <h2 class="mb-0">
                        {{$pending_counter}}
                      </h2>
                      <p class="text-muted m-b-25">as of today</p>
                  </div>
                  <div class="progress progress-bar-success-alt progress-sm mb-0">
                      <div class="progress-bar progress-bar-success" role="progressbar"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                            style="width: 100%; background-color:#01939e;">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6">
              <div class="card-box">
                <div class="dropdown pull-right">
                  <a href="/ongoing_requests" class="btn btn-sm" style="background-color:#01939e;color:white;">
                      <i class="mdi mdi-eye"></i>View
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a href="javascript:void(0);" class="dropdown-item">View</a>
                  </div>
                </div>
                <h4 class="header-title mt-0 m-b-30">
                   Ongoing task(s)
                </h4>
                <div class="widget-box-2">
                  <div class="widget-detail-2">
                      <i class="mdi mdi-settings mdi-spin mdi-48px" style="float:left;color:#f9c851;margin-top:-40px;"></i>
                      <h2 class="mb-0">
                           {{$ongoing_counter}}
                      </h2>
                      <p class="text-muted m-b-25">as of today</p>
                  </div>
                  <div class="progress progress-bar-success-alt progress-sm mb-0">
                      <div class="progress-bar progress-bar-success" role="progressbar"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                            style="width: 100%; background-color:#01939e;">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6">
              <div class="card-box">
                <div class="dropdown pull-right">
                  <a href="/completed_requests" class="btn btn-sm" style="background-color:#01939e;color:white;">
                      <i class="mdi mdi-eye"></i>View
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a href="javascript:void(0);" class="dropdown-item">View</a>
                  </div>
                </div>
                <h4 class="header-title mt-0 m-b-30">Completed Task(s)</h4>
                <div class="widget-box-2">
                  <div class="widget-detail-2">
                      <i class="mdi mdi-check-circle mdi-48px" style="float:left;color:#10c469;margin-top:-40px;"></i>
                      <h2 class="mb-0">
                        {{$completed_counter}}
                      </h2>
                      <p class="text-muted m-b-25">as of today</p>
                  </div>
                  <div class="progress progress-bar-success-alt progress-sm mb-0">
                      <div class="progress-bar progress-bar-success" role="progressbar"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                            style="width: 100%; background-color:#01939e;">
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-4">
              <div class="card-box" style="height:370px;">
                <h4 class="header-title mt-0">Tasks Summary</h4>
                <div class="card-box" style="height:300px;">
                     {{-- {!! $taskOverview->container() !!} --}}
                </div>
              </div>
            </div>
            <div class="col-xl-8">
              <div class="card-box" style="height:370px;">
                <h4 class="header-title mt-0">Monthly Activity</h4>
                <div class="card-box" style="height:300px;">
                  {{-- {!! $monthlyActivity->container() !!} --}}
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
@endsection