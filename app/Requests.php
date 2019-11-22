<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
   protected $fillable = [
      'request_to',
      'requestor',
      'request_id',
      'type_of_request',
      'area_of_request',
      'plant_designation',
      'model',
      'ln_bn',
      'request_concern',
      'route_to_supervisor',
      'route_to_manager',
      'attached_file',
      'request_status',
      'supervisor_approval',
      'manager_approval',
      'date_requested',
   ];
}
