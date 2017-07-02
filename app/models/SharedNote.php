<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class SharedNote extends Eloquent
{

	protected $fillable = ['user_id', 'dest_id', 'note_id'];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function note()
	{
		return $this->belongsTo('Note');
	}

}