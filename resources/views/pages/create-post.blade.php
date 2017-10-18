@extends('master')

@section('title', 'Create New Post')

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
						<form class="form-horizontal" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	                            <label for="title" class="col-md-4 control-label">Post Title</label>
	                            <div class="col-md-6">
	                                <input id="title" placeholder="Your Post Title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
	                                @if ($errors->has('title'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('title') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
	                            <label for="content" class="col-md-4 control-label">Featured Image</label>
	                            <div class="col-md-6">
	                            	<input type="file" name="image">
	                            </div>
	                             @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
	                        </div>

	                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
	                            <label for="content" class="col-md-4 control-label">Select Category</label>
	                            <div class="col-md-6">
	                            	<select name="category" class="form-control">
	                            		<option value=""> --Please Select a Category-- </option>
	                            		@foreach($category as $k)
								            <option value="{{ $k['id'] }}">{{ $k['title'] }}</option>
								        @endforeach
	                            	</select>
		                             @if ($errors->has('category'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('category') }}</strong>
	                                    </span>
	                                @endif
                                </div>
	                        </div>

	                        

	                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
	                            <label for="content" class="col-md-4 control-label">Post Content</label>
	                            <div class="col-md-6">
	                            	<textarea class="form-control"  name="content" rows="4" placeholder="Your post Body here" >{{ old('content') }}</textarea>

	                                @if ($errors->has('content'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('content') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
	                            <label for="status" class="col-md-4 control-label">Post Status</label>
	                            <div class="col-md-6">
	                            	<select class="form-control" name="status">
	                            		<option value="1"> Publish </option>
	                            		<option value="0"> Draft </option>
	                            	</select>
	                                @if ($errors->has('status'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('status') }}</strong>
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