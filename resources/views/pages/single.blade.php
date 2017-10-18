@extends('master')

@section('title', 'Homepage')

@section('content')
	<div class="container">
		<div class="col-sm-12"> 
			
				<div class="panel-default panel">
					<div class="panel-heading text-center">
						<h5>{{ $post[0]['title'] }}</h5>
					</div>
					<div class="panel-body">
						<h1>{{ $post[0]['title'] }}</h1>

						<p>{{ $post[0]['body'] }}<</p>

						
						<img src="{{ url('/') ."/".$post[0]['image']['image']  }}" alt="{{ $post[0]['title'] }}" />

						
					</div>
				</div>
			
		</div>
	</div>
@endsection