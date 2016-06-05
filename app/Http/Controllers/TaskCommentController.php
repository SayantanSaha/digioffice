<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Notification;
use App\Http\Requests;
use Auth;
use Log;
use Validator;
class TaskCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $taskId
     * @return \Illuminate\Http\Response
     */
    public function index($taskId)
    {
        //
		$comments = Task::find($taskId)->comments;
		return $comments;
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
     * @param int $taskId
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $taskId)
    {
		 $validator = Validator::make($request->all(), [
            
            'comment' => 'required',
        ]);
		if ($validator->fails()) {
            return redirect('/task/'.$taskId)
                        ->withErrors($validator)
                        ->withInput();
        }
		$task = Task::find($taskId);
        $comment = new Comment;
		$comment->txt = $request->input('comment');
		$comment->created_by = Auth::user()->id;
		if ($request->hasFile('attachment')) {
			//
			
			$comment->file = 1;
			$comment->file_extension = $request->file('attachment')->guessExtension();
		}
		$saved = $task->comments()->save($comment);
		if($saved)
		{
			
			if ($request->hasFile('attachment')) {
				$dest_path = base_path().'/storage/uploads';
				$dest_name = $task->id.'_'.$comment->id.'.'.$request->file('attachment')->guessExtension();
				Log::info("Moving attachment to ".$dest_path."/".$dest_name);
				$request->file('attachment')->move($dest_path, $dest_name );
			}
			$notification = new Notification;
			$notification->from = Auth::user()->id;
			$notification->task_id = $task->id;
			$notification->action = "Commented";
			if ($request->hasFile('attachment')) {
			//
			
				$notification->action = $notification->action." with Attachment";
			}
			
			if($request->input('submit')=='Close')
			{
				$task->closed = 1;
				if($task->save())
				{
					$notification->action = $notification->action." and Closed";
				}
			}
			else if($request->input('submit')=='Reopen')
			{
				$task->closed = 0;
				$task->enddate = $request->input('enddate');
				if($task->save())
				{
					$notification->action = $notification->action." and Reopened";
				}
			}
			else{
				$notification->action = $notification->action." on";
			}
			$notification->save();
		}
		return redirect('/task/'.$taskId);
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
}
