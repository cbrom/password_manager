<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class SharedSite extends Eloquent
{

	protected $fillable = ['user_id', 'dest_id','site_id'];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function site()
	{
		return $this->belongsTo('Site');
	}

}