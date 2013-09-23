<?php

class Common{
	public static function time_since($from, $to=null){
		$to = is_null($to) ? time() : $to;		
		$from = strtotime($from) ? strtotime($from) : $from;

		// Future or past
		if( $from > $to ){
			$difference = $from - $to;
			$tense = 'in the future';
		} else {
			$difference = $to - $from;
			$tense = 'ago';
		}
		
		$units = array(
			'second' => $difference,
			'minute' => floor($difference / 60),
			'hour' => floor($difference / 3600),
			'day' => floor($difference / 86400),
			'week' => floor($difference / 604800),
			'month' => floor($difference / 2628000),
			'year' => floor($difference / 31536000),
		);

		$duration = 'at some point';
		foreach ($units as $key => $value) {
			if( $value > 0){
				$duration = $value .' '. Str::plural($key, $value) .' '. $tense;
			}
		}
		return $duration;
	}
}