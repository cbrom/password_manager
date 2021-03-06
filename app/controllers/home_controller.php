<?php
session_start();

require_once "app/models/Site.php";
require_once "app/models/Folder.php";

class HomeController extends Controller
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

	public function vault()
	{
		//display vault
		$this->view('display/browse_vault', ['error'=>$this->error, 'msg'=>$this->msg]);
	}


	public function addFolder()
	{
		$foldername = NULL;

		if (!isset($_POST['foldername']))
		{
			return $this->setHeader('display/' . "vault", ['error'=>$this->error, 'msg'=>$this->msg]);
		}

		$foldername = $_POST['foldername'];

		if(Folder::create(['foldername'=>$foldername]))
		{
			return $this->setHeader('display/' . "vault", ['error'=>$this->error, 'msg'=>$this->msg]);
		}

	}


}