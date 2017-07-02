<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Folder extends Eloquent
{

	protected $fillable = ['user_id', 'foldername'];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function sites()
	{
		return $this->hasMany('Site');
	}

}