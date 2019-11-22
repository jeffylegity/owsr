@foreach ($for_approval_requests as $requests)
<tr style="text-align:center;">
   <td>
      <a href="{{route('user.req_details',$requests->request_id)}}" class="btn btn-primary btn-sm">
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
  <td><span class="badge badge-danger">{{$requests->request_status}}</span></td>
  <td>{{ Carbon\Carbon::parse($requests->date_requested)->diffForHumans()}}</td>
</tr>
@endforeach