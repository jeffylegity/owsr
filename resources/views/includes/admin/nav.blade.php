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
                  <div class="alert alert-primary" style="background-color:#01939e;color:white;">
                     <h3 class="header-title" style="text-align:center">
                        @switch(Auth::user()->department)
                              @case('PLANT MAINTENANCE')
                              Plant Maintenance    
                                 @break
                              @case('EQUIPMENT ENGINEERING')
                              Equipment Engineering
                                 @break
                        @endswitch
                     </h3>
                     <h5 class="header-title" style="text-align:center">
                        <span class="badge badge-danger">
                           @switch(Auth::user()->division)
                                 @case('PLANT 8/9/10')
                                 Plant 8
                                    @break
                                 @case('PLANT 7')
                                 Plant 7
                                    @break
                                 @case('MAIN PLANT')
                                 Main Plant
                                    @break
                           @endswitch
                        </span>
                     </h5>
                  </div>
               </li>
               <li>
                  <a href="{{route('admin.home')}}" class="waves-effect" ><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
               </li>
               <li>
                  <a href="{{route('admin.pending_requests')}}" class="waves-effect" ><i class="mdi mdi-comment-alert-outline"></i> <span> Pending Request(s) </span> 
                     @if (!$pending_counter == 0)
                        <span class="badge badge-danger" style="float:right;">{{$pending_counter}}</span>  
                     @endif
                  </a>
               </li>
               <li>
                  <a href="#" class="waves-effect" ><i class="mdi mdi-settings"></i> <span> Ongoing Request(s) </span></a>
               </li>
               <li>
                  <a href="#" class="waves-effect" ><i class="mdi mdi-comment-check"></i> <span> Completed Request(s) </span></a>
               </li>
            </ul>
            <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
      </div>
     </div><br><br>