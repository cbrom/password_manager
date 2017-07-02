<?php

class Controller
{
	public $msg;
	public $errors;
	public function model($model)
	{
		require_once 'app/models/' . $model . '.php';
		return new $model();
	}

	public function view($view, $data = [])
	{
		require_once 'app/views/' . $view . '.php';		
		
	}
	public function setHeader($view, $data = [])
	{
		header("Location: /cbs_projects/password_manager_clean/" . $view);
	}
}