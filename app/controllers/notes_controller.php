<?php
session_start();

require_once "app/models/Note.php";

class NotesController extends Controller
{

	public $error = NULL;
	public $msg = NULL;
	
	public function index($view = 'notes', $error = NULL, $msg= NULL)
	{
		$this->error = $error;
		$this->msg = $msg;
		$notes = $this->getNotes();
		return $this->setHeader('display/' . "notes", ['error'=>$this->error, 'msg'=>$this->msg, 'notes'=>$notes]);
		//return $this->view('display/' . $view , ['error' =>$this->error, 'msg'=>$this->msg]);
	}

	public function save()
	{
		$content = NULL;
		$title = NULL;
		if (!isset($_POST['note']) || !isset($_POST['noteTitle']))
		{
			$this->error['filled'] = false;
			return $this->view('display/' . "notes", ['error'=>$this->error, 'msg'=>$this->msg]);
		}
		$content = $_POST['note'];
		$title = $_POST['noteTitle'];
		if ($content != NULL && $title != NULL)
		{
			$user = User::where('id', $_SESSION['user_id'])->first()['original'];
			$id = $user['id'];
			$user = new User;
			$user->id = $id;

			$note = new Note;
			$note->setUserId($user->id);
			$note->setTitle($title);
			$note->setContent($content);
			if ($note->addNote())
			{
				return $this->setHeader('display/' . "notes", ['error'=>$this->error, 'msg'=>$this->msg]);
			} else{
				$this->error['not_saved'] = true;
				return $this->setHeader('display/' . "notes", ['error'=>$this->error, 'msg'=>$this->msg]);
			}
		// 	$notes = $user->notes();
		// 	echo $notes->count();

		// 	$x = 15;
		// 	var_dump(User::where('id', $_SESSION['user_id'])->first()['original']);
		// 	var_dump($notes[0]->getOriginal()['title']);
		// 	var_dump($notes[1]->getOriginal()['title']);
		 }

	}

	public function deleteNote($id)
	{
		$note = Note::find($id);
		if($note->deleteNote())
		{
			return $this->setHeader('display/' . "notes", ['error'=>$this->error, 'msg'=>$this->msg]);
		}
		$this->error['deletenote'] = false;
		return $this->setHeader('display/' . "vault", ['error'=>$this->error, 'msg'=>$this->msg]);

	}

	public function getNotes()
	{
		$user = User::where('id', $_SESSION['user_id'])->first()['original'];
		$user_id = $user['id'];
		$user = new User;
		$user->id = $user_id;
		$notes = $user->notes();
		return $notes;

	}

	
}