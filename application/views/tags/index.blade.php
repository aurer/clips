@layout('master')

@section('primary')

	@foreach($tags_initials as $initial => $tags)
		<dl>
			<dt>{{ $initial }}</dt>
			@foreach($tags as $tag)
				<dd><a href="/clips/tagged/{{ $tag->slug }}">{{ $tag->tag }}</a></dd>
			@endforeach
		</dl>
	@endforeach

@endsection

@section('secondary')
	@include('partials.tags')
	@include('partials.latest-clips')
	@include('partials.popular-clips')
@endsection