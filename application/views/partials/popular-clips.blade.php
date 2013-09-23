<?php $clips = DB::table('clips_vw')->take(10)->where('hits', '>', 0)->order_by('hits', 'DESC')->get() ?>
@if( count($clips) > 0 )	
	<div class="attached">
		<h3>Most viewed clips</h3>
		<ul id="popular-clips" class="reset">
		 @foreach($clips as $item)
		 	<li><a href="/clips/{{ $item->slug }}">{{ $item->title }}</a></li>
		 @endforeach
		</ul>
	</div>
@endif