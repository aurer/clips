<?php $pages = array(
	"clips"=>"Clips",
	"tags"=>"Tags",
); ?>

<nav id="nav1">
	<ul>
	@foreach($pages as $link=>$title)
		<li class="{{ (URI::segment(1) == $link) ? 'active' : 'inactive' }}"><a href="/{{ $link }}">{{ $title }}</a></li>
	@endforeach
	</ul>
</nav>