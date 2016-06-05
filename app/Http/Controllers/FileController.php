<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Comment;
use App\Http\Requests;
use App\Models\Message;
use Log;
class FileController extends Controller
{
    public function getTaskAttachment($taskId)
	{
		$task = Task::find($taskId);
		$path = base_path().'/storage/uploads/'.$taskId.".".$task->file_extension;
		Log::info("Downloading ".$path);
		return response()->download($path);
	}
	public function viewTaskAttachment($taskId)
	{
		$task = Task::find($taskId);
		$path = base_path().'/storage/uploads/'.$taskId.".".$task->file_extension;
		Log::info("Downloading ".$path);
		return response()->file($path);
	}
	public function getCommentAttachment($taskId,$commentId)
	{
		$comment = Comment::find($commentId);
		$path = base_path().'/storage/uploads/'.$taskId."_".$commentId.".".$comment->file_extension;
		Log::info("Downloading ".$path);
		return response()->download($path);
	}
	public function viewCommentAttachment($taskId,$commentId)
	{
		$comment = Comment::find($commentId);
		$path = base_path().'/storage/uploads/'.$taskId."_".$commentId.".".$comment->file_extension;
		Log::info("Downloading ".$path);
		return response()->file($path);
	}
	public function viewMessageAttachment($messageId)
	{
		$message = Message::find($messageId);
		$path1 = base_path().'/storage/uploads/M_'.$messageId.".".$message->file_extension;
		Log::info("View ".$path1);
		return response()->file($path1);
	}
}
