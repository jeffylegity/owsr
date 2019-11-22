<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserPendingForApproval extends AbstractWidget
{
   public $reloadTimeout = 30;
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $for_approval = DB::table('requests')->select('*')->whereIn('requestor',[Auth::id()])->whereIn('request_status',['pending to supervisor','pending to manager'])->get();
        return view('widgets.user_pending_for_approval', ['config' => $this->config,'for_approval_requests'=>$for_approval]);
    }

    public function container()
    {
       return [
          'element'       => 'tbody',
          'attributes'    => 'class="myTbody"',
       ];
    }
}
