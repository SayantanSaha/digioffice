<?php

namespace App\Http\Controllers;
//use Carbon\Carbon;
use Auth;
use Log;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		//$tasks = Task::open()->orderBy('enddate','desc')->get();
		$tasks = Task::urgent()->get();
		return $tasks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$task = new Task;
		$task->subject = $request->input('subject');
		$task->to = $request->input('to');
		$task->fileno = $request->input('fileno');
		//$enddate = Date::createFromFormat('d/m/Y',$request->input('enddate'));
		$task->enddate = $request->input('enddate');
		$task->details = $request->input('details');
		$task->created_by = Auth::user()->id;
		if ($request->hasFile('attachment')) {
			//
			
			$task->file = 1;
			$task->file_extension = $request->file('attachment')->guessExtension();
		}
		$saved = $task->save();
		Log::info("Saving task with file no. ".$task->fileno." : ".$saved);
		if($saved)
		{
			Log::info("Task with file no. ".$task->fileno." has attachment : ".$request->hasFile('attachment'));
			if ($request->hasFile('attachment')) {
				$dest_path = base_path().'/storage/uploads';
				$dest_name = $task->id.'.'.$request->file('attachment')->guessExtension();
				Log::info("Moving attachment to ".$dest_path."/".$dest_name);
				$request->file('attachment')->move($dest_path, $dest_name );
			}
		}
		 return redirect('/');
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$task = Task::find($id);
		$ed = strtotime($task->enddate);
		$cd = strtotime($task->created_at);
		$task->totdays = ceil(($ed-$cd)/(60*60*24));
		$task->completeddays = ceil((time()-$cd)/(60*60*24));
		$task->daysleft = $task->totdays-$task->completeddays;
		return view('task')->withTask($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	public function search(Request $request)
	{
		$str = $request->input('qry');
		$tasks = Task::where(function ($query) use ($str) {
							$query->where('subject', 'like', '%'.$str.'%')
								  ->orWhere('fileno', '=', $str);
						})->orderBy('closed')->orderBy('enddate')->get();
		//return $tasks;
		return view('tasks')->withTasks($tasks);
	}
}
