<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
require_once 'app/Exceptions/Exceptions.php';

class Note extends Eloquent
{

	// public $user_id = NULL;
	// public $title = NULL;
	// public $content = NULL;

	protected $fillable = ['user_id', 'title', 'content'];

	public function getUserId()
	{
		return $this->user_id;
	}

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

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title='')
	{
		if ($title == NULL)
		{
			throw new InputEmptyException;
		}

		$title = Validator::validateStr($title);
		if ($title == NULL)
		{
			throw new InvalidInputException;
		} else if (strlen($title) > 35)
		{
			throw new AboveLimitException;
		}
		$this->title = ucFirst($title);
		
	}

	public function getContent()
	{
		return $this->content;
	}

	public function setContent($content='')
	{
		if ($content == NULL)
		{
			throw new InputEmptyException;
		}
		$content = Validator::validateStr($content);
		if ($content == NULL)
		{
			throw new InvalidInputException;
		}
		$this->content = $content;
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function addNote()
	{
		//if($this->create(['user_id'=>$this->getUserId(), 'title'=>$this->getTitle(), 'content'=>$this->getContent()]))
		$note = new Note;
		$note->user_id = $this->getUserId();
		$note->title = $this->getTitle();
		$note->content = $this->getContent();
		if($this->save())
		{
			return true;
		}
		return false;
	}

	public function editNote()
	{
		if($this->save())
		{
			return true;
		}

		return false;
	}

	public function deleteNote()
	{
		if($this->delete())
		{
			return true;
		}

		return false;
	}

}