<div class="attached">
	<h3>Most used tags</h3>
	<ul id="taglist" class="reset">
		@forelse (Tag::get_distinct() as $tag)
			<li><a class="rounded" href="/clips/tagged/{{ Str::slug($tag->tag) }}">{{ ucfirst($tag->tag) }}</a></li>
		@empty
			<li>No tags found, you need to get tagging!</li>
		@endforelse
	</ul>
</div>
