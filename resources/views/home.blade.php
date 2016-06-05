@extends('layout')

@section('title', 'Dashboard')

@section('pageheader', 'Dashboard')

@section('breadcumb')
	@parent
	<li><i class="active"></i> Dashboard</li>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-6 ">
			<form method="POST" action="/task" enctype="multipart/form-data" id="newTask">
				{{csrf_field()}}
				<div class="box box-danger">
					<div class="box-header">
					  <h3 class="box-title">New Task</h3>
					</div>
					<div class="box-body">
						<div class="input-group">
							<span class="input-group-addon">Subject:</span>
							<input class="form-control" type="text" placeholder="Subject" id="subject" name="subject">
						</div>
						<br/>
						<div class="input-group">
							<span class="input-group-addon">File No.:</span>
							<input class="form-control" type="text" placeholder="File No." id="fileno" name="fileno">
						</div>
						<br/>
						<div class="input-group">
							<span class="input-group-addon">To:</span>
							<input class="form-control" type="text" placeholder="To" id="to" name="to">
						</div>
						<br/>
						
						<div class="input-group date">
						  <span class="input-group-addon">End Date:</span>
						  <input type="text" class="form-control pull-left" id="datepicker" name="enddate">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						</div>
						<br/>
						<div class="box box-info">
							<div class="box-header">
							  <h3 class="box-title">Details
								<small>Details of the task</small>
							  </h3>
							  <!-- tools box -->
							  <div class="pull-right box-tools">
								<button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								  <i class="fa fa-minus"></i></button>
								
							  </div>
							  <!-- /. tools -->
							</div>
							<!-- /.box-header -->
							<div class="box-body pad">
							 
							<textarea id="editor1" name="details" rows="10" cols="80">
													
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
						<input type="submit" class="btn btn-success btn-block" value="Save" >

					</div>
				</div>
			</form>
        </div>
    
	
	
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <div class="panel-heading">Open Tasks</div>

                <div class="panel-body">
                    <table class="table table-hover">
						<thead>
							<tr>
								<th>File No.</th>
								<th>Subject</th>
								<th>To</th>
								<th>End Date</th>
								<th>Days Left</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tasks as $task)
								<tr @if ($task->daysleft<=3) class="danger" @elseif ($task->daysleft<=7) class="warning" @endif>
									<td><a href="/task/{{$task->id}}">{{$task->fileno}}</a></td>
									<td>{{$task->subject}}</td>
									<td>{{$task->to}}</td>
									<td>{{$task->enddate}}</td>
									<td>{{$task->daysleft}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
$(function() {
CKEDITOR.replace('editor1');
$( "li[name='ql']" ).removeClass( "active" );
$( "#qld" ).addClass( "active" );
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
