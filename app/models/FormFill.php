<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class FormFill extends Eloquent
{

	protected $fillable = ['user_id', 'fromtype', 'firstname', 'lastname', 'username', 'email', 'birthdate', 'gender', 'address'];

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

	public function setFormType($formtype='')
	{
		if ($formtype == NULL)
		{
			throw new InputEmptyException;
		}

		$formtype = Validator::validateStr($formtype);
		if ($formtype == NULL)
		{
			throw new InvalidInputException;
		} else if (strlen($formtype) > 35)
		{
			throw new AboveLimitException;
		}
		$this->formtype = ucfirst($formtype);
	}

	public function getFormType()
	{
		return $this->formtype;
	}

	public function setFirstName($firstname='')
	{
		if ($firstname == NULL)
		{
			throw new InputEmptyException;
		}

		$firstname = Validator::validateStr($firstname);
		if ($firstname == NULL)
		{
			throw new InvalidInputException;
		} else if (strlen($firstname) > 35)
		{
			throw new AboveLimitException;
		}
		$this->firstname = ucfirst($firstname);
	}

	public function getFirstName()
	{
		return $this->firstname;
	}

	public function setLastname($lastname='')
	{
		if ($lastname == NULL)
		{
			throw new InputEmptyException;
		}

		$lastname = Validator::validateStr($lastname);
		if ($lastname == NULL)
		{
			throw new InvalidInputException;
		} else if (strlen($lastname) > 35)
		{
			throw new AboveLimitException;
		}
		$this->lastname = ucfirst($lastname);
	}

	public function getLastName()
	{
		return $this->lastname;
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
		$this->username = ucfirst($username);
	}

	public function getUserName()
	{
		return $this->username;
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

	public function getEmail()
	{
		return $this->email;
	}

	public function setAddress($address='')
	{
		if ($address == NULL)
		{
			throw new InputEmptyException;
		}

		$address = Validator::validateStr($address);
		if ($address == NULL)
		{
			throw new InvalidInputException;
		} else if (strlen($address) > 35)
		{
			throw new AboveLimitException;
		}
		$this->address = ucfirst($address);
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setGender($gender='')
	{
		if ($gender == NULL)
		{
			throw new InputEmptyException;
		}
		$gender = Validator::validateInt($gender);

		if ($gender == NULL)
		{
			throw new InvalidInputException;
		}else if ($gender > 1)
		{
			throw new AboveLimitException;
		} else if($gender < 0)
		{
			throw new NegativeUserIdException;
		} else if (($gender == 0) || ($gender == 1))
		{
			$this->gender = $gender;
		}
		
		
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	

}