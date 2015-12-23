@extends('app')
@section('content')
<script>
$(document).ready(function(){

	  $('#upload_button').attr('disabled',true);
	        $('#testFile').change(function(){
	                if ($(this).val()) {
	                    $('#upload_button').attr('disabled',false);
	                } 
	            }
	            );
	    });
</script>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h4 class="field">Field Technician</h4></div>
				<div class="panel-body">
				<form class="form-horizontal" role="form" method="post" action="{{URL::to('technician/job_detail')}}/{{$job->order_id}}" enctype="multipart/form-data" id="testForm">
					<input type="hidden" name="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
					<div class="col-md-4 div_main" style="margin-left: 3%;">
					  <dl class="">
					<dt>Job Title</dt>
					<dd>{{$job->title}}</dd>
					<dd>  <p> </p></dd>
					<dt>Time</dt>
					<dd>Start time: {{ date('d-m-Y',strtotime($job->date_start)) }} {{$job->time_start}}
						{{--<br>
						End time: {{date('d-m-Y',strtotime($job->date_end))}} {{$job->time_end}}--}}
					</dd>
					<dd>  <p> </p></dd>
					<dt>Job Documents</dt>
					<dd>  <p> </p></dd>
					<dd>  <p> </p></dd>
					@if($job_file == 'exist')
					<dd><a href="{{URL::to('technician/download_files')}}?order={{$job->order_id}}">Ektimo Flows Spreadsheet.xlsm</a></dd>
					
					@else
						{{--Job file not exist.--}}
						<dd><a href="{{URL::to('technician/download_files')}}?order={{$job->order_id}}">Ektimo Flows Spreadsheet.xlsm</a></dd>
					@endif
					<dd>  <p> </p></dd>
					
					<dd>  <p> </p></dd>
					<input type="file" id="testFile" name="test_files" value="">
					<dd>  <p> </p></dd>
					<span><strong>Upload Documents:</strong></span>
					
					<button class="btn btn-primary" type="submit" id="upload_button" >+ Upload</button>
					</dd>
					<dd>  <p> </p></dd>
					<dd>  <p> </p></dd>
					<dd>
					<dd>  <p> </p></dd>
					<dd>  <p> </p></dd>
					<dd>  <p> </p></dd>
					<ul class="" style="list-style-type:none;">
					@if(!empty($documents))
						@foreach($documents as $num => $file)
						<li style="color:#009933;">
						Stack {{$num+1}} -
						<a href="{{URL::to('technician/download_files')}}?path={{$file['path']}}&name={{$file['name']}}" style="color:#009933;">{{$file['name']}}</a></li>
						
						@endforeach
						
					@else
						No other documents.
					@endif
					</ul>
					</dl>
					</div>
					<div class="col-md-3 div_main" >
					 <dl class="">
						<dt>Location Name</dt>
						<dd>{{$detail['details'][0]['location_name']}}</dd>
						<dd>  <p> </p></dd>
						<dt>Booking Time</dt>
						<dd>{{date('d-m-Y h:i',strtotime($job->create_date))}}</dd>
						<dd>  <p> </p></dd>
						<dt>Location Address</dt>
						<dd>{{$detail->address}}</dd>
						<dd>  <p> </p></dd>
						<dt>Location Contact Name  & number</dt>
						<dd>{{$detail->contact}}</dd>
						<dd>  <p> </p></dd>
						<dt>Laboratory Booking Time</dt>
						<?php if(isset($job->lstart) && !empty($job->lstart)){ ?> 
						<dd>{{date('d-m-Y',strtotime($job->lstart))}} {{date("H:i", strtotime($job->lstart_time))}}</dd>
						<?php } ?>
						<dd>  <p> </p></dd>
						<dt>Reporting Booking Time</dt>
						<?php if(isset($job->rstart) && !empty($job->rstart)){ ?> 
						<dd>{{date('d-m-Y',strtotime($job->rstart))}} {{date("H:i", strtotime($job->rstart_time))}}</dd>
						<?php } ?>
						{{--<dt>Job test documents </dt>
						<dd></dd>
						<dt>Job lab documents</dt>
						<dd></dd>--}}
					</dl>
					</div>
					<div class="col-md-3 div_main" style="float: right;">
					<dl class="">
						<dt>Job consumables</dt>
						<dd>
						@if(!empty($test_material))
							@foreach($test_material as $material)
								@foreach($material as $item)
								@if($item->type == "conusmable")
									{{$item->name}}
									 <br>
								@endif
								
								 @endforeach
							@endforeach
						@endif
						</dd>
						<dd>  <p> </p></dd>
						<dt>Job materials list</dt>
						<dd>
							@if(!empty($test_material))
							@foreach($test_material as $material)
								@foreach($material as $item)
								@if($item->type == "equipment")
									{{$item->name}}
									<br>
								@endif
								
								 @endforeach
							@endforeach
							@endif
						</dd>
					</dl>
					</div>
					</div>
					<dt>Job Description</dt>
					<dd>{{$job->description}}</dd>
					</form>
					<form class="form-horizontal" role="form" method="post" action="{{URL::to('technician/job_submit')}}/{{$job->order_id}}" enctype="multipart/form-data" id="testForm">
					<input type="hidden" name="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<?php 
					$num_files= count($documents);
					?>
					<input type="hidden" name="file_added" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-success pull-right">Success</button>
					</form>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection
<style>
.field{
	text-align:center;
}
.col-md-6 dd{
margin-bottom : 10px;
}
.div_main {
  
    display: -webkit-flex; /* Safari */
    -webkit-justify-content: space-around; /* Safari 6.1+ */
    display: flex;
    justify-content: space-around;
}
</style>
