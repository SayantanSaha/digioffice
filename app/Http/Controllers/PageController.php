<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Task;
use DB;
class PageController extends Controller
{
    /**
     * Show the homepage for the given user.
     *
     * 
     * @return Response
     */
    public function showHome()
    {
		$tasks = Task::open()->orderBy('enddate')->get();
		foreach($tasks as $task)
		{
			$ed = strtotime($task->enddate);
			$task->daysleft = ceil(($ed-time())/(60*60*24));
		}
		$data = array('tasks'=>$tasks);
        return view('home',$data);
    }
	public function showQueryLog()
	{
		 $queries = DB::getQueryLog();
		 return $queries;
	}
}