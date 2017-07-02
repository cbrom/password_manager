<?php

class UserController extends Controller
{

	public $error = NULL;
	public $msg = NULL;

	public function index($name = '')
	{

		//check session if user is logged in
		
		$user = $this->model('User');
		$user->name = $name;

		$this->view('home/index', ['name' =>$user->name]);

		echo User::find(1)->username;
	}

	public function signout()
	{
		//signout function and return route
	}

	public function vault()
	{
		//display vault
		$error = NULL;
		$msg = NULL;
		$this->view('display/browse_vault', ['error'=>$error, 'msg'=>$msg]);
	}

	public function form_fills()
	{
		//display form fills
	}

	public function notes()
	{
		//display notes
	}

}