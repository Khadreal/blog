@extends('master')

@section('title', 'Homepage')

@section('content')
	<div class="container">
		<div class="col-sm-12"> 
			@if ( !$posts->count() )
				<div class="none text-center">
					<h1>No category post</h1>
				</div>
			@else
				<div class="panel-default panel">
					<div class="panel-heading text-center">
						<h5>Category Post</h5>
					</div>
					<div class="panel-body">
						<ul class="list-group">
							@foreach( $posts as $post )
								 <li class="list-group-item">
									@if( $post->image )
										<figure class="col-sm-3">
											<img src="{{ url('/post/') ."/".$post['image']['image'] }}" alt="{{ $post->title }}" />
										</figure>
									@endif
									<article>
										<h3>
											<a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
							    		</h3>
									    <span>
									    	{{ $post->created_at->format('M d,Y ') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
									    </span>

									    <p>
									    	{!! str_limit($post->body, $limit = 15, $end = ' <a href='.url("/post/".$post->slug).'>Read More</a>') !!}
									    </p>
									</article>
							    	
								</li>
							@endforeach
						</ul>	
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection