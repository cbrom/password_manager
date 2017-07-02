<?php
session_start();

require_once "app/models/Site.php";
require_once "app/models/Folder.php";

class SitesController extends Controller
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

	public function addSite()
	{
		$url = NULL;
		$username = NULL;
		$password = NULL;
		$folderid = NULL;

		if (!isset($_POST['url']) || !isset($_POST['username']) || !isset($_POST['folderid']) || !isset($_POST['password']))
		{
			return $this->setHeader('display/' . "vault", ['error'=>$this->error, 'msg'=>$this->msg]);
		}

		$url = $_POST['url'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$folderid = $_POST['folderid'];

		$site = new Site;
		$site->setUrl($url);
		$site->setUserId($_SESSION['user_id']);
		$site->setFolderId($folderid);
		$site->setUserName($username);
		$site->setPassword($password);

		if($site->addSite())
		{
			echo "successfully added";
			return $this->setHeader('display/' . "vault", ['error'=>$this->error, 'msg'=>$this->msg]);
		}
	}

	public function editSite($id)
	{
		$site = Site::find($id);
		$url = NULL;
		$username = NULL;
		$password = NULL;
		$folderid = NULL;

		if (!isset($_POST['url']) || !isset($_POST['username']) || !isset($_POST['password']))
		{
			return $this->setHeader('display/' . "vault", ['error'=>$this->error, 'msg'=>$this->msg]);
		}

		$url = $_POST['url'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		$site->url = $url;
		$site->username = $username;
		$site->password = $password;
		if($site->editSite())
		{
			return $this->setHeader('display/' . "vault", ['error'=>$this->error, 'msg'=>$this->msg]);
		}
	}

	public function deleteSite($id)
	{
		$site = Site::find($id);
		if($site->deleteSite())
		{
			return $this->setHeader('display/' . "vault", ['error'=>$this->error, 'msg'=>$this->msg]);
		}
		$this->error['deletesite'] = false;
		return $this->setHeader('display/' . "vault", ['error'=>$this->error, 'msg'=>$this->msg]);

	}

}