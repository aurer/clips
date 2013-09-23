<?php

AutoSchema::table('clips', function($table){
	$table->increments('id');
	$table->string('title');
	$table->string('slug');
	$table->text('code');
	$table->text('description');
	$table->boolean('private');
	$table->integer('author');
	$table->boolean('active');
	$table->timestamps();
});

AutoSchema::table('tags', function($table){
	$table->increments('id');
	$table->string('tag');
	$table->string('slug');
	$table->integer('clip_id');
	$table->string('category');
	$table->boolean('active');
	$table->timestamps();
});

AutoSchema::table('hits', function($table){
	$table->increments('id');
	$table->integer('item_id');
	$table->string('section');
	$table->integer('hits');
	$table->timestamps();
});

AutoSchema::table('feedback', function($table){
	$table->increments('id');
	$table->string('name');
	$table->string('email');
	$table->text('feedback');
	$table->string('user_agent');
	$table->timestamps();
});

AutoSchema::table('users', function($table){
	$table->increments('id');
	$table->string('username');
	$table->string('email');
	$table->string('password');
	$table->timestamps();
});
	
AutoSchema::view('public_clips_vw', function($view){
	$view->definition("SELECT c.*,
			CASE WHEN h.hits IS NULL THEN 0 ELSE h.hits END AS hits
		FROM clips c
		LEFT JOIN hits h
			ON h.item_id = c.id 
			AND h.section='clips'
		WHERE c.active = 1 
			AND c.private = 0;");
});

AutoSchema::view('clips_vw', function($view){
	$view->definition("SELECT c.*,
			CASE WHEN h.hits IS NULL THEN 0 ELSE h.hits END AS hits
		FROM clips c
		LEFT JOIN hits h
			ON h.item_id = c.id 
			AND h.section='clips'
		WHERE c.active = 1 
			AND c.private = 0
		GROUP BY c.title;");
});

AutoSchema::view('tags_vw', function($view){
	$view->definition("SELECT t.*,
			CASE WHEN h.hits IS NULL THEN 0 ELSE h.hits END AS hits
		FROM tags t
		LEFT JOIN hits h
			ON h.item_id = t.id AND h.section = 'tags'
		JOIN clips c
			ON c.id = t.clip_id
		WHERE t.active = 1
		GROUP BY t.tag;");
});