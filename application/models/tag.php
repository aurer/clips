<?php

class Tag extends Eloquent
{
	public function clips()
	{
		return $this->belongs_to_many('Clip');
	}

	public static function as_csv($tags)
	{
		$tag_array = array();
		foreach ($tags as $tag) {
			array_push($tag_array, $tag->tag);
		}
		return implode(', ', $tag_array);
	}

	public static function get_distinct()
	{
		return self::select(
			array(
				'tag',
				'slug',
				DB::raw('count(tag) as count')
			)
		)
		->group_by('tag')
		->order_by('count', 'DESC')
		->get();
	}
}