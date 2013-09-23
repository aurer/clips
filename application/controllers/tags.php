<?php

class Tags_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{
		$data['pagetitle'] = "Tags";
		$data['tags'] = Tag::distinct()->order_by('tag', 'ASC')->get(array('tag', 'slug'));
		$data['tags_initials'] = array();
		foreach ($data['tags'] as $tag) {
			$initial = strtoupper((substr($tag->tag, 0, 1)));
			if( isset($data['tags_initials'][$initial]) ){
				array_push($data['tags_initials'][$initial], $tag);
			} else {
				$data['tags_initials'][$initial] = array( $tag );
			}
		}
		return View::make('tags.index')->with($data);
	}

	public function get_view($slug)
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
}