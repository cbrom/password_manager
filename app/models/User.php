<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
require_once "Note.php";
require_once "FormFill.php";
require_once "Folder.php";
require_once "SharedNote.php";
require_once "Site.php";

class User extends Eloquent
{
	// protected $username;
	// protected $email;
	// protected $password;
	// protected $id;

	protected $fillable = ['username', 'email', 'password'];

	

	public function setUserName($username='')
	{
		if ($username == NULL)
		{
			throw new InputEmptyException;
		}

		$username = Validator::validateStr($username);
		if ($username == NULL)
		{
			throw new InvalidInputException;
		} else if (strlen($username) > 35)
		{
			throw new AboveLimitException;
		}
		$this->username = ucfirst($username);
	}

	public function setEmail($email='')
	{
		if ($email == NULL)
		{
			throw new InputEmptyException;
		}

		$email = Validator::validateEmail($email);
		if ($email == NULL)
		{
			throw new InvalidInputException;
		} else if (strlen($email) > 35)
		{
			throw new AboveLimitException;
		}
		$this->email = trim($email);
	}

	public function setPassword($password='')
	{
		if ($password == NULL)
		{
			throw new InputEmptyException;
		}

		$password = Validator::validateStr($password);
		if ($password == NULL)
		{
			throw new InvalidInputException;
		} else if (strlen(md5($password)) > 50)
		{
			throw new AboveLimitException;
		}
		$this->password = md5($password);
	}

	public function setId($id='')
	{
		$this->id = $id;
	}

	public function getUserName()
	{
		return $this->username;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getId()
	{
		return $this->id;
	}




	public function form_fills()
	{
		if(FormFill::where('user_id', $this->id)->count() > 0)
		{
			return FormFill::where('user_id', $this->id)->get();
		}
		return FormFill::where('user_id', $this->id)->count();
	}

	public function notes()
	{
		//echo $this->id;
		if (Note::where('user_id', $this->id)->count() > 0)
		{
			return Note::where('user_id', $this->id)->get();
		}
		return Note::where('user_id', $this->id)->count();
	}

	public function sites()
	{
		if(Site::where('user_id', $this->id)->count() > 0)
		{
			return Site::where('user_id', $this->id)->get();
		}
		return Site::where('user_id', $this->id)->count();
	}
	public function folders()
	{
		if (Folder::where('user_id', $this->id)->count() > 0)
		{
			return Folder::where('user_id', $this->id)->get();
		}
		return Folder::where('user_id', $this->id)->count();
	}

	public function shared_sites()
	{
		if (SharedSite::where('user_id', $this->id)->count() > 0)
		{
			return SharedSite::where('user_id', $this->id)->get();
		}
		return SharedSite::where('user_id', $this->id)->count();
	}

	public function shared_notes()
	{
		if (SharedNote::where('user_id', $this->id)->count() > 0)
		{
			return SharedNote::where('user_id', $this->id)->get();
		}
		return SharedNote::where('user_id', $this->id)->count();
	}

	public function addUser()
	{
		if($this->save())
		{
			return $this;
		}
		return NULL;
	}

	public function loginUser($email, $password)
	{
		//login
		//set session
		if (User::where('email', $email)->where('password', $password)->count() > 0)
		{
			$user = User::where('email', $email)->where('password', $password)->first()->getOriginal();
			$user_id = $user['id'];
			var_dump($user_id);
			$_SESSION['user_id'] = $user_id;
			return true;
		}
		
		return false;			
	}

	public function vault()
	{
		//select all folders
		$folders = $this->folders();
		$sites = $this->sites();
		$data = NULL;
		$data['folders'] = $folders;
		$data['sites'] = $sites;

		return $data;
		//select all sites and fillit with it's folder id
	}

}