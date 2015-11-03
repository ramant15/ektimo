@extends('app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Job Detail</div>
				<div class="panel-body">
					<h3>Job Title</h3>
					<p>{{$job->title}}</p>
					<h3>Job Description</h3>
					<p>{{$job->description}}</p>
					<h3>Time</h3>
					<p>Start time: {{$job->date_start}} {{$job->time_start}}
					<br>
					End time: {{$job->date_end}} {{$job->time_end}}</p>
					<h3>Job File</h3>
					@if($job_file == 'exist')
					<p><a href="{{URL::to('technician/download_files')}}?order={{$job->order_id}}">Download job file</a></p>
					
					@else
						Job file not exist.
					@endif
					<h3>Other documents</h3>
					<p>
					
					@if(!empty($documents))
						@foreach($documents as $file)
						<a href="{{URL::to('technician/download_files')}}?path={{$file['path']}}&name={{$file['name']}}">{{$file['name']}}</a><br>
						@endforeach
					@else
						No other documents.
					@endif
					</p>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection
