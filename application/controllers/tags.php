<?php

class Tags_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{
		$data['pagetitle'] = "Tags";
		$data['tags'] = Tag::distinct()->order_by('tag', 'ASC')->get(array('tag', 'slug'));

		// Search filter
		if( Input::get('q') ){
			$search = Input::get('q');
			$data['tags'] = Tag::distinct()->where('tag', 'LIKE', "%$search%")
				->order_by('tag', 'ASC')
				->get(array('tag', 'slug'));
		} else {
			$data['tags'] = Tag::distinct()->order_by('tag', 'ASC')->get(array('tag', 'slug'));
		}

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
}