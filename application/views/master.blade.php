<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Code2</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link href="/theme/grey/css/style.css" rel="stylesheet">
	<link href="/theme/grey/css/layout.css" rel="stylesheet">
	@yield('head')
</head>
<body class="master-template" >
<div id="page">
	<div id="container">
		@include('partials.nav')
		<div id="main" role="main">
			<h1>{{ isset($pagetitle) ? $pagetitle : '' }}</h1>
			<div class="actions">
				<a class="btn new" id="new-clip" href="/clips/new/"><span>Add a Clip</span></a>
				<a class="btn {{ (URI::segment(1) == 'clips') ? 'active' : 'inactive' }}" id="viewlist" href="/clips" title="Clips"><img src="/theme/grey/gfx/list.png" alt="Clips"/></a>
				<a class="btn {{ (URI::segment(1) == 'tags') ? 'active' : 'inactive' }}" id="viewgrid" href="/tags" title="Tags"><img src="/theme/grey/gfx/grid.png" alt="Tags"/></a>
				<form id="filter" action="/clips/" method="get">
					<input class="rounded" name="q" type="text" id="filter-keyword" placeholder="Filter" value="{{ Input::get('q') }}"/>
				</form>
			</div>
			@yield('primary')
		</div>
		<div id="secondary">
			<div class="inner">
				@yield('secondary')
			</div>
		</div>
	</div>
</div>
@include('partials.footer')
<div id="modal" class="rounded"></div>
<div id="modal-cover"></div>
</body>
</html>
	