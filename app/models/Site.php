<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Site extends Eloquent
{

	protected $fillable = ['user_id', 'folder_id', 'url', 'username', 'password'];

	public function setUserId($user_id='')
	{
		if ($user_id == NULL)
		{
			throw new InputEmptyException;
		}
		$user_id = Validator::validateInt($user_id);
		if ($user_id <= 0)
		{
			throw new NegativeUserIdException;
		} else if ($user_id == NULL)
		{
			throw new InvalidInputException;
		} else if ($user_id > 99999999999)
		{
			throw new AboveLimitException;
		} else if($user_id == 0)
		{
			throw new IdZeroException;
		}
		$this->user_id = $user_id;
	}

	public function getUserId()
	{
		return $this->user_id;
	}

	public function setFolderId($folder_id='')
	{
		if ($folder_id == NULL)
		{
			throw new InputEmptyException;
		}
		$folder_id = Validator::validateInt($folder_id);
		if ($folder_id <= 0)
		{
			throw new NegativeUserIdException;
		} else if ($folder_id == NULL)
		{
			throw new InvalidInputException;
		} else if ($folder_id > 99999999999)
		{
			throw new AboveLimitException;
		} else if($folder_id == 0)
		{
			throw new IdZeroException;
		}
		$this->folder_id = $folder_id;
	}

	public function getFolderId()
	{
		return $this->folder_id;
	}

	public function setUrl($url='')
	{
		if ($url == NULL)
		{
			throw new InputEmptyException;
		}

		$url = Validator::validateUrl($url);
		if ($url == NULL)
		{
			throw new InvalidInputException;
		} else if (strlen($url) > 35)
		{
			throw new AboveLimitException;
		}
		$this->url = $url;
	}

	public function getUrl()
	{
		return $this->url;
	}

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
		$this->username = $username;
	}

	public function getUserName()
	{
		return $this->username;
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
		} else if (strlen($password) > 35)
		{
			throw new AboveLimitException;
		}
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function folder()
	{
		return $this->belongsTo('Folder');
	}

	public function addSite()
	{
		// if($this->create(['url'=>$this->url, 'user_id'=>$this->user_id, 'folder_id'=>$this->folder_id, 'username'=>$this->username, 'password'=>$this->password]))
		if($this->save())
		{
			return true;
		}
		return false;
	}

	public function editSite()
	{
		if($this->save())
		{
			return true;
		}

		return false;
	}

	public function deleteSite()
	{
		if ($this->delete())
		{
			return true;
		}
		return false;
	}

}