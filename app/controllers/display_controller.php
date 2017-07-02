<?php
//require_once 'app/core/Validate.php';

session_start();

class DisplayController extends Controller
{

	public $error = NULL;
	public $msg = NULL;
	
	public function index($view = 'vault', $error = NULL, $msg= NULL)
	{
		//get data and set it
		$data = $this->getData($view);
		//var_dump($data->count());
		$view = 'browse_' . $view;

		$this->error = $error;
		$this->msg = $msg;
		return $this->view('display/' . $view , ['error' =>$this->error, 'msg'=>$this->msg, 'data'=>$data]);
	}

	private function getData($view)
	{
		$user = new User;
		$user->id = $_SESSION['user_id'];
		$method = $view;
		$data = call_user_func_array([$user, $method], []);
		return $data;
	}

	
}