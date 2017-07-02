<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class FormFill extends Eloquent
{

	protected $fillable = ['user_id', 'fromtype', 'firstname', 'lastname', 'username', 'email', 'birthdate', 'gender', 'address'];

	public function user()
	{
		return $this->belongsTo('User');
	}

	

}