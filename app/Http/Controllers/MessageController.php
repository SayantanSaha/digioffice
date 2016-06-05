<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Validator;
use Log;
use App\User;
use App\Models\Message;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$messages = Auth::user()->messages()->orderBy('created_at','desc')->get();
		$users = User::all();
		$data = array('users'=>$users,'messages'=>$messages);
		foreach ($messages as $message)
		{
			$message->read=1;
			$message->save();
		}
		return view('message',$data);
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
		$validator = Validator::make($request->all(), [
            
            'body' => 'required',
        ]);
		if ($validator->fails()) {
            return redirect('/message')
                        ->withErrors($validator)
                        ->withInput();
        }
		$message = new Message;
		$message->to = $request->input('to');
		$message->from = Auth::user()->id;
		$message->body = $request->input('body');
		if ($request->hasFile('attachment')) {
			//
			
			$message->file = 1;
			$message->file_extension = $request->file('attachment')->guessExtension();
		}
		if($message->save())
		{
			if ($request->hasFile('attachment')) {
				$dest_path = base_path().'/storage/uploads';
				$dest_name = 'M_'.$message->id.'.'.$request->file('attachment')->guessExtension();
				Log::info("Moving attachment to ".$dest_path."/".$dest_name);
				$request->file('attachment')->move($dest_path, $dest_name );
			}
		}
		return redirect('/message');
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
