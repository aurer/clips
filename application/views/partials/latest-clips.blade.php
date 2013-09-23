<div class="attached">
	<h3>Latest clips</h3>
	<ul id="latest-clips" class="reset">
	 @foreach (Clip::take(10)->order_by('created_at', 'desc')->get() as $item)
	 	<li><a href="/clips/{{ $item->slug }}">{{ $item->title }}</a></li>
	 @endforeach
	</ul>
</div>