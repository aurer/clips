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
<body class="error-template" >
<div id="page">
	<div id="container">
		@include('partials.nav')
		<div id="main" role="main">
			@yield('primary')
		</div>
	</div>
</div>
@include('partials.footer')
</body>
</html>
	