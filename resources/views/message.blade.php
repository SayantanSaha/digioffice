@extends('layout')

@section('title', 'Messages')

@section('pageheader', 'Messages')

@section('breadcumb')
	@parent
	<li><i class="active"></i> Messages</li>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-6 ">
			<form method="POST" action="/message" enctype="multipart/form-data" id="newMessage">
				{{csrf_field()}}
				<div class="box box-danger">
					<div class="box-header">
					  <h3 class="box-title">New Message</h3>
					</div>
					<div class="box-body">
						
						
						
						<div class="form-group">
						  <label>To</label>
						  <select class="form-control" name='to'>
							
							@foreach ($users as $user)
								<option value="{{$user->id}}">{{$user->username}}</option>
							@endforeach
						  </select>
						</div>
						
						
						<br/>
						<div class="box box-info">
							<div class="box-header">
							  <h3 class="box-title">Message
								<small>Body of the message</small>
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
							 
							<textarea id="editor1" name="body" rows="10" cols="80">
													
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
                <div class="panel-heading">Messages</div>

                <div class="panel-body">
                    <table class="table table-hover">
						<thead>
							<tr>
								
								<th>From</th>
								<th>Message</th>
								<th>Time</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach ($messages as $message)
								<tr>
									
									<td>{{$message->frm->username}}</td>
									<td>@if ($message->file>0)<a href="/message/view/{{$message->id}}" target="_blank"><span class="glyphicon glyphicon-paperclip"></span><a>@endif {!! $message->body !!}</td>
									<td>{{$message->created_at}}</td>
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
$( "#qlm" ).addClass( "active" );
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
