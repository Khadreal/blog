@extends('master')

@section('title', 'Add Category')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					@if(session()->has('message'))
					    <div class="alert alert-success">
					        {{ session()->get('message') }}
					    </div>
					@endif
					<div class="text-center panel-heading"> 
						<h3>Create your Post</h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" >
							{{ csrf_field() }}
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                            <label for="name" class="col-md-4 control-label">Category Name</label>
	                            <div class="col-md-6">
	                                <input id="name" placeholder="Your Post Title" type="text" class="form-control" name="name" value="{{ old('name') }}"  autofocus>
	                                @if ($errors->has('name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('name') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
	                            <label for="description" class="col-md-4 control-label">Post Title</label>
	                            <div class="col-md-6">
	                               
	                                <textarea class="form-control" name="description" rows="4" placeholder="Your Category Description" >{{ old('description') }}</textarea>
	                                @if ($errors->has('description'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('description') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="submit" class="btn btn-primary">
	                                    Save
	                                </button>
	                            </div>
	                        </div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection