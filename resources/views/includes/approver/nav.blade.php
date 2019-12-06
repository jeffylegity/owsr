<body class="fixed-left" style="background-color:#ebeff2;">
  <div id="wrapper">
    <div class="topbar">
      <div class="topbar-left" style="border-top: 7px solid #034ea2;">
        <a href="{{route('approver.home')}}" class="logo">
          <img src="{{URL::asset('assets/images/shinetsu.png.png')}}" alt="Shin-Etsu" style="width: 70%; height:60%;">
        </a>
      </div>
      <div class="navbar navbar-default" style="border-top: 7px solid #01939e; background-color: white;"
        role="navigation">
        <div class="container-fluid" style="background-color: white;">
          <ul class="nav navbar-nav list-inline navbar-left">
            <li class="list-inline-item">
              <button class="button-menu-mobile open-left">
                <i class="mdi mdi-menu"></i>
              </button>
            </li>
          </ul>
          <nav class="navbar-custom">
            <ul class="list-unstyled topbar-right-menu float-right mb-0">
              <li>
                <div class="notification-box">
                  <ul class="list-inline mb-0">
                    <li>
                      <a href="javascript:void(0);" class="right-bar-toggle">
                        <i class="mdi mdi-account-circle"></i>
                      </a>
                      <div class="noti-dot">
                        <span class="dot"></span>
                        <span class="pulse"></span>
                      </div>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">
         <div id="sidebar-menu">
            <ul>
               <li>
                  <a href="{{route('approver.home')}}" class="waves-effect" ><i class="mdi mdi-clipboard-alert"></i> <span> Approval Request(s) </span> 
                     @if (!$for_approval_counter == 0)
                        <span class="badge badge-danger" style="float:right;">{{$for_approval_counter}}</span>   
                     @endif
                  </a>
               </li>
               <li>
                  <a href="{{route('approver.approved')}}" class="waves-effect" ><i class="mdi mdi-comment-check"></i> <span> Approved Request(s) </span> </a>
               </li>
               <hr>
               <li>
                  <a href="{{route('approver.pending_for_approval')}}" class="waves-effect" ><i class="mdi mdi-comment-alert-outline"></i> <span> Pending for Approval </span> 
                     @if (!$pending_request_counter == 0)
                         <span class="badge badge-danger" style="float:right;">{{$pending_request_counter}}</span>
                     @endif
                  </a>
               </li>
               <li>
                  <a href="{{route('approver.pending_request')}}" class="waves-effect" ><i class="mdi mdi-account-alert"></i> <span> Pending Request(s)</span> 
                     @if (!$pending_counter == 0)
                         <span class="badge badge-danger" style="float:right;">{{$pending_counter}}</span>
                     @endif
                  </a>
               </li>
               <li>
                  <a href="{{route('approver.completed_request')}}" class="waves-effect" ><i class="mdi mdi-clipboard-check"></i> <span> Completed Request(s)</span> </a>
               </li>
               <li class="has_sub">
                  <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-float-none"></i><span>Request Form</span></a>
                  <ul class="list-unstyled">
                     <li><a href="{{route('approver.ee_req_form')}}">Equipment Engineering</a></li>
                     <li><a href="{{route('approver.pm_req_form')}}">Plant Maintenance</a></li>
                     <li><a href="{{route('approver.pe_req_form')}}">Process Engineering</a></li>
                  </ul>
               </li>
            </ul>
            <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
      </div>
     </div><br><br>