<footer class="footer" style="left:0;">
   <marquee behavior="scroll" direction="left">2019 © Management Information Systems. Shin-Etsu Magnetics Philippines          --          Contact us: Local 114 / 807 / 
     <a href="mailto:misd@smp.com.ph?subject=Concern title&body=Report a problem">misd@smp.com.ph</a>
   </marquee>
</footer>
</div>
<div class="side-bar right-bar">
 <a href="javascript:void(0);" class="right-bar-toggle">
   <i class="mdi mdi-close-circle-outline"></i>
 </a>
 <h4 class="">Settings</h4>
 <div class="notification-list nicescroll">
   <ul class="list-group list-no-border user-list">
     <li class="list-group-item">
       <a href="/profile" class="user-list-item">
         <div class="avatar">
           <img src="{{URL::asset('assets/images/users/default.png')}}" alt="">
         </div>
         <div class="user-desc">
           <span class="name">{{ Auth::user()->name }}</span>
           <span class="desc">{{ Auth::user()->department }}</span>
           <span class="time">Edit your profile</span>
         </div>
       </a>
     </li>
     <li class="nav-item dropdown">
       <a class="form-control" style="text-align:center;" href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
           {{ __('Logout') }}
       </a>
       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
           @csrf
       </form>
     </li>
   </ul>
 </div>
</div>
</div>
<script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/js/popper.min.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/js/detect.js')}}"></script>
<script src="{{URL::asset('assets/js/fastclick.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.blockUI.js')}}"></script>
<script src="{{URL::asset('assets/js/waves.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/dataTables.select.min.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.core.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.app.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/dropify.min.js')}}"></script>
<script src="{{URL::asset('assets/custom_js/datatableConfig.js')}}"></script>
<script type="text/javascript">
   $('.dropify').dropify({
       messages: {
           'default': 'Drag and drop a file here or click',
           'replace': 'Drag and drop or click to replace',
           'remove': 'Remove',
           'error': 'Ooops, something wrong appended.'
       },
       error: {
           'fileSize': 'The file size is too big (1M max).'
       }
   });
 </script>
 <script>
     $(window).on("unload",function() {
       $.ajax({
           url: '/logout_user',
           method:'GET',
           contentType:false,
           processData:false,
           success:function(data)
           {
               alert("session destroyed");
           }
       });
     });
   </script>

</body>
@toastr_js
@toastr_render
</html>