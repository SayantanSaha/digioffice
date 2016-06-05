@extends('layout')

@section('title', 'Tasks')

@section('pageheader', 'Tasks')

@section('breadcumb')
	@parent
	<li><a href="/"> Dashboard</a></li>
	<li><i class="active"></i> Tasks</li>
@endsection
@section('content')
<table class="table table-hover table-striped table-bordered">
	<thead>
		<tr>
			<th>File No.</th>
			<th>Subject</th>
			<th>To</th>
			<th>Created Date</th>
			<th>End Date</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($tasks as $task)
			<tr>
				<td><a href="/task/{{$task->id}}">{{$task->fileno}}</a></td>
				<td>{{$task->subject}}</td>
				<td>{{$task->to}}</td>
				<td>{{$task->created_at}}</td>				
				<td>{{$task->enddate}}</td>
				<td>@if ($task->closed==1)<span class="label label-danger">Closed</span> @else <span class="label label-success">Open</span> @endif</td>
			</tr>
		@endforeach
	</tbody>
</table>
   
@endsection
@section('script')


@endsection
