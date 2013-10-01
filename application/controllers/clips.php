<?php

class Clips_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{
		$data['pagetitle'] = "Clips";
		
		// Search filter
		if( Input::get('q') ){
			$search = Input::get('q');
			$data['clips'] = Clip::where('title', 'LIKE', "%$search%")
				->or_where('description', 'LIKE', "%$search%")
				->order_by('created_at', 'DESC')
				->get();
		} else {
			$data['clips'] = Clip::order_by('created_at', 'DESC')->get();
		}

		return View::make('clips.index')->with($data);
	}

	public function get_tagged($slug)
	{
		$data['pagetitle'] = "Tags";
		$data['tag'] = Tag::where_slug($slug)->first();
		$data['clips'] = DB::table('tags')
			->join('clips', 'clips.id', '=', 'tags.clip_id' )
			->where('tags.slug', '=', $slug)
			->get('clips.*');
		Hit::hit_tag($data['tag']->id);
		return View::make('clips.index')->with($data);
	}

	public function get_new()
	{
		$data['pagetitle'] = "Clips / New";
		return View::make('clips.new')->with($data);
	}

	public function post_new()
	{	
		$rules = array(
		    'title'  => 'required|unique:clips',
		    'tags' => 'required',
		    'code' => 'required',
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if( $validation->fails() ){
			Input::flash();
			return Redirect::to('clips/new')->with_errors($validation);
		} 
		else {
			
			$clip = DB::table('clips')->insert_get_id( array(
				'title' => Input::get('title'),
				'slug' => Str::slug(Input::get('title')),
				'code' => Input::get('code'),
				'private' => Input::get('private', 0),
				'active' => 1,
				'description' => Input::get('description'),
			));

			foreach (explode(',', Input::get('tags')) as $tag) {
				Tag::create(array(
					'clip_id' => $clip->id,
					'tag'	=> trim($tag),
					'slug'	=> Str::slug(trim($tag)),
					'active' => true,
				));
			}

			return Redirect::to('clips');
		}
	}

	public function get_view($slug)
	{
		$data['clip'] = Clip::where_slug($slug)->where_active(true)->first();
		$data['pagetitle'] = 'Clips / ' . $data['clip']->title;
		$data['tags'] = Tag::where('clip_id', '=', $data['clip']->id)->get();
		Hit::hit_clip($data['clip']->id);
		return View::make('clips.view')->with($data);
	}

	public function get_raw($slug)
	{
		$clip = Clip::where_slug($slug)->where_active(true)->first();
		return Response::make($clip->code, 200, array('content-type' => 'text/plain'));
	}

	public function get_edit($slug)
	{
		$data['clip'] = Clip::where_slug($slug)->where_active(true)->first();

		$tags = Tag::where('clip_id', '=', $data['clip']->id)->get('tag');
		if ($tags) {
			$data['clip']->tags = Tag::as_csv( $tags );
		}

		$data['pagetitle'] = "Clips / Edit / " . $data['clip']->title;
		return View::make('clips.edit')->with($data);
	}

	public function post_edit($slug)
	{	
		$clip = Clip::where_slug($slug)->first();

		$rules = array(
		    'title'  => "required|unique:clips,title,$clip->id",
		    'tags' => 'required',
		    'code' => 'required',
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if( $validation->fails() ){
			Input::flash();
			return Redirect::to("clips/$clip->slug")->with_errors($validation);
		} 
		else {

			$clip->title 		= Input::get('title');
			$clip->slug 		= Str::slug(Input::get('title'));
			$clip->code 		= Input::get('code');
			$clip->private 		= Input::get('private', 0);
			$clip->description 	= Input::get('description');

			Tag::where_clip_id($clip->id)->delete();

			foreach (explode(',', Input::get('tags')) as $tag) {
				Tag::create(array(
					'clip_id' => $clip->id,
					'tag'	=> trim($tag),
					'slug'	=> Str::slug(trim($tag)),
					'active' => true,
				));
			}

			$clip->save();

			return Redirect::to("clips/$clip->slug");
		}
	}

	public function get_remove($slug)
	{
		$clip = Clip::where_slug($slug)->first();
		$clip->active = false;
		$clip->save();
		return Redirect::to('clips');
	}
}