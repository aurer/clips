@layout('master')
@section('bodyclass', 'one-column')
@section('pagetitle', 'Add a clip')

@section('head')
	<link rel="stylesheet" href="/theme/grey/css/autocomplete.css" />
@endsection

@section('scripts')
	<script src="/theme/grey/js/jquery.validate.min.js" type="text/javascript"></script>
	<script src='/theme/grey/js/jquery.autocomplete-min.js'></script>
	<script type="text/javascript">
	$(function() {
		$('#add-form').validate({
			errorElement : 'div',
			errorPlacement: function(error, element) {
				error.appendTo( element.parents("div.field") );
			},
		});
		$('input[name=tags]').autocomplete({
			serviceUrl:'/tags/autocomplete/',
			delimiter: /(,|;)\s*/
		})
	});
	</script>
@endsection

@section('primary')
	
	{{ Form::open('/clips/new/', 'POST', array('id'=>'add-form', 'class'=>'standard fullwidth') ) }}
		<fieldset class="main">
			<div class="field required field-title">
				{{ Form::label('title', 'Title') }}
				<span class="input">{{ Form::text('title', Input::old('title'), array('class'=>'required', 'autofocus')) }}</span>
				{{ $errors->first('title', '<p>:message</p>'); }}
			</div>
			
			<div class="field required field-tags">
				{{ Form::label('tags','Tags') }}
				<span class="input">{{ Form::text('tags', Input::old('tags'), array('class'=>'required')) }}</span>
				{{ $errors->first('tags', '<p>:message</p>'); }}
			</div>
			
			<div class="field required field-code">
				{{ Form::label('code','Code') }}
				<span class="input">{{ Form::textarea('code', Input::old('code'), array('rows'=>20, 'class'=>'required')) }}</span>
				{{ $errors->first('code', '<p>:message</p>'); }}
			</div>
			
			<div class="field field-private type-checkbox">
				<span class="input">{{ Form::checkbox('private', true) }}</span>
				{{ Form::label('private','Keep this clip private') }}
				{{ $errors->first('private', '<p>:message</p>'); }}
			</div>
			
			<div class="field field-description">
				{{ Form::label('description', 'Description') }}
				<span class="input">{{ Form::textarea('description', Input::old('description'), array('rows'=>20)) }}</span>
				{{ $errors->first('description', '<p>:message</p>'); }}
			</div>
			
			<div class="field submit feild-submit">
				<span class="input">
					<a href="/clips/" class="cancel btn">Cancel</a>
					{{ Form::submit('Add it', array('class'=>'btn')) }}
				</span>
			</div>
		</fieldset>
	{{ Form::close() }}
	
@endsection