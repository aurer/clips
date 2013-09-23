<div id="clips">
	<ol class="cliplist reset">
		@forelse($clips as $clip)
			<li class="clip" id="clip-{{ $clip->id }}">
				<h3 class="clip-title"><a class="rounded" href="/clips/{{ $clip->slug }}/">{{ $clip->title }}</a></h3>
				<div class="clip-options">
					<a class="view-clip" href="/clips/{{ $clip->slug }}/">View details</a>
					<a class="edit-clip" href="/clips/{{ $clip->slug }}/edit/">Edit</a>
					<a class="delete-clip" href="/clips/{{ $clip->slug }}/delete/">Delete</a>
					<a class="raw-clip" href="/clips/{{ $clip->slug }}/raw/">Raw</a>
				</div>
				<pre class="clip-code hidden"><code class="prettyprint">{{ HTML::entities($clip->code) }}</code></pre>
			</li>
		@empty
			<p>Sorry no clips could be found.</p>
		@endforelse
	</ol>
</div>