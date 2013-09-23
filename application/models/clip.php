<?php

class Clip extends Eloquent
{
	public static $table = 'public_clips_vw';

	public function tags_array()
	{
		return $this->has_many('Tag');
	}
}