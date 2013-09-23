<?php

class Hit extends Eloquent 
{
	public static function hit_clip($id)
	{
		self::add_hit($id, 'clips');	
	}

	public static function hit_tag($id)
	{
		self::add_hit($id, 'tags');	
	}

	private static function add_hit($id, $section)
	{
		$hits = Hit::where_item_id($id)->first();
		if( count($hits) < 1 ){
			Hit::create(array(
				'item_id' => $id,
				'section' => $section,
				'hits' => 1
			));
		} else {
			$hits->hits += 1;
			$hits->save();
		}
	}
}