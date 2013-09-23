@layout('master')

@section('head')
	<link href="/theme/grey/google-prettify/prettify.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="/theme/grey/css/autocomplete.css" />
@endsection

@section('scripts')
	<script type="text/javascript" src="/theme/grey/js/clips.js"></script>
	<script type="text/javascript" src="/theme/grey/js/activefilter.js"></script>
	<script type="text/javascript" src="/theme/grey/google-prettify/prettify.js"></script>
	<script src="/theme/grey/js/jquery.validate.min.js" type="text/javascript"></script>
	<script src='/theme/grey/js/jquery.autocomplete-min.js'></script>
	<script src='/theme/grey/js/apng.js'></script>
	<script type="text/javascript">
	$(function(){

		prettyPrint();
		
	    cf.handleClipViewing();
		cf.mapKeys();
		cf.handleDelete();
		cf.handleViewOptions();
		cf.loadViewPreference();
	    cf.handleModalForms();
	    
		$.activeFilter({
			needle: '#filter-keyword',
			haystack: '.clip h3 a',
			hideEle: '.clip',
			fxHide: 'slideUp',
			fxShow: 'slideDown',
			hideSpeed: 200,
			showSpeed: 200,
			regex: true
		});
	    
	});
	</script>
@endsection

@section('primary')
	
	@include('clips.partials.clips-list')
	
@endsection

@section('secondary')
	@include('partials.tags')
	@include('partials.latest-clips')
	@include('partials.popular-clips')
@endsection