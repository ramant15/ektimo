@extends('app')
@section('content')
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
					<div class="col-md-6">
					  <dl class="">
					<dt>Job Title</dt>
					<dd>{{$job->title}}</dd>
					<dt>Time</dt>
					<dd>Start time: {{ date('d-m-Y',strtotime($job->date_start)) }} {{$job->time_start}}
						{{--<br>
						End time: {{date('d-m-Y',strtotime($job->date_end))}} {{$job->time_end}}--}}
					</dd>
					<dt>Job File</dt>
					@if($job_file == 'exist')
					<dd><a href="{{URL::to('technician/download_files')}}?order={{$job->order_id}}">Download job file</a></dd>
					
					@else
						Job file not exist.
					@endif
					<dt>Other documents</dt>
					<dd>
					<ul class="">
					@if(!empty($documents))
						@foreach($documents as $file)
						<li>
						{{$file['name']}}
						<a href="{{URL::to('technician/download_files')}}?path={{$file['path']}}&name={{$file['name']}}">Download</a></li>
						
						@endforeach
						
					@else
						No other documents.
					@endif
					</ul>
					<input type="file" id="testFile" name="test_files" value="">
					</dd>
					<button class="btn btn-primary" type="submit">Upload</button>
					</dl>
					</div>
					<div class="col-md-6">
					 <dl class="">
						<dt>Location Name</dt>
						<dd>{{$detail['details'][0]['location_name']}}</dd>
						<dt>Booking Time</dt>
						<dd>{{date('d-m-Y h:i',strtotime($detail['created_at']))}}</dd>
						<dt>Location Address</dt>
						<dd>{{$detail->address}}</dd>
						<dt>Location Contact Name  & number</dt>
						<dd>{{$detail->contact}}</dd>
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
						<dt>Job test documents </dt>
						<dd></dd>
						<dt>Job lab documents</dt>
						<dd></dd>
					</dl>
					</div>
					</div>
					<dt>Job Description</dt>
					<dd>{{$job->description}}</dd>
					
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
</style>
