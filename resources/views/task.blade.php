@extends('layout')

@section('title', 'Task Details')

@section('pageheader')
	{{$task->fileno}}
@endsection

@section('breadcumb')
	@parent
	<li><a href="/"> Dashboard</a></li>
	<li><i class="active"></i> {{$task->id}}</li>
@endsection
@section('content')
<div class="panel @if ($task->closed==0) panel-success @else panel-danger @endif">
  <div class="panel-heading">
    <h3 class="panel-title">{{$task->subject}}</h3>
  </div>
  <div class="panel-body">
	<div class="row">
		<div class="progress">
		  <div class="progress-bar @if ($task->daysleft<=3) progress-bar-danger @elseif ($task->daysleft<=7) progress-bar-warning @elseif($task->daysleft>7) progress-bar-success @endif progress-bar-striped active text-primary" role="progressbar" aria-valuenow="{{$task->completeddays}}" aria-valuemin="0" aria-valuemax="{{$task->totdays}}" style="width: {{--*/echo round($task->completeddays/$task->totdays*100);/*--}}%">
			{{$task->completeddays}} / {{$task->totdays}} days over.
		  </div>
		</div>
	</div>
    <div class="row">
	  <div class="col-sm-4" style="text-align:right;">To</div>
	  <div class="col-sm-8">{{$task->to}}</div>
	</div>
	<div class="row">
	  <div class="col-sm-4" style="text-align:right;">Details</div>
	  <div class="col-sm-8">{!! $task->details !!}</div>
	</div>
	<div class="row">
	  <div class="col-sm-4" style="text-align:right;">End Date</div>
	  <div class="col-sm-8">{{$task->enddate}}</div>
	</div>
	<div class="row">
	  <div class="col-sm-4" style="text-align:right;">Created by</div>
	  <div class="col-sm-8">{{$task->user->username}}</div>
	</div>
	<div class="row">
	  <div class="col-sm-4" style="text-align:right;">Created at</div>
	  <div class="col-sm-8">{{$task->created_at}}</div>
	</div>
	<div class="row">
	  <div class="col-sm-4" style="text-align:right;">Updated at</div>
	  <div class="col-sm-8">{{$task->updated_at}}</div>
	</div>
	@if ($task->file==1)
	<div class="row">
		<div class="col-sm-4" style="text-align:right;">Attachment</div>
		<div class="col-sm-4">
			<a href="/download/{{$task->id}}" type="button" class="btn btn-primary" aria-label="Left Align">
			  Download <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
			</a>
		</div>
		<div class="col-sm-4">
			<a href="/view/{{$task->id}}" target="_blank" type="button" class="btn btn-primary" aria-label="Left Align">
			  View <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
			</a>
		</div>
	</div>
	@endif
	
  </div>
  
</div>
<div class="row">

<div class="col-md-6">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title">Comment</h3>
		</div>
		<div class="panel-body">
			@if (count($errors) > 0)
				@foreach ($errors->all() as $error)
				<div class="alert alert-danger" role="alert">
					{{ $error }}
				</div>
				@endforeach
			@endif
			<form method="POST" action="/task/{{$task->id}}/comment" enctype="multipart/form-data" id="newTask">
				{{csrf_field()}}
				<div class="box box-info">
					<div class="box-header">
					  <h3 class="box-title">Comment
						<small></small>
					  </h3>
					  <!-- tools box -->
					  <div class="pull-right box-tools">
						<button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						  <i class="fa fa-minus"></i>
						</button>
						
					  </div>
					  <!-- /. tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body pad">
					 
						<textarea id="editor1" name="comment" rows="10" cols="80">
												
						</textarea>
						
					</div>
				</div>
				<br/>
				<div class="input-group">
					<span class="input-group-addon">Upload File:</span>
					<input type="text" class="form-control" readonly >
					<label class="input-group-btn">
						<span class="btn btn-default">
							Browse <input type="file" style="display: none;" name="attachment">
						</span>
					</label>
					
				</div>
				<br/>
				@if ($task->closed==0)
				<input type="submit" class="btn btn-primary btn-block" value="Save" name="submit">
				<input type="submit" class="btn btn-danger btn-block" value="Close" name="submit">
				@else
				<div class="input-group date">
				  <span class="input-group-addon">End Date:</span>
				  <input type="text" class="form-control pull-left" id="datepicker" name="enddate" value="{{$task->enddate}}">
				  <div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				  </div>
				</div>
				<br/>
				<input type="submit" class="btn btn-success btn-block" value="Reopen" name="submit">
				@endif
			</form>
		</div>
	</div>
</div>

@if ($task->comments->count()>0)
	<div class="col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Comments</h3>
			</div>
			<table class="table">
			@foreach ($task->comments as $comment)
				<tr>
					<td>
						<h4>{{$comment->user->username}}</h4> {{$comment->created_at}}
					</td>
					<td style="width:70%;">
						{!! $comment->txt !!}
						@if ($comment->file!=0)
						<br/>
						Attachment : 
						<a href="/download/{{$task->id}}/{{$comment->id}}" >
							 <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
						</a>
						
						<a href="/view/{{$task->id}}/{{$comment->id}}" >
							 <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
						</a>
						@endif
					</td>				
				</tr>
			@endforeach
			</table>
		</div>
	</div>
@endif
</div>
@endsection
@section('script')
$(function() {
CKEDITOR.replace('editor1');
$("#datepicker").datepicker({
	format: 'yyyy-mm-dd',
    autoclose: true
});
// We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
  
});

@endsection
