<?php


class Validator
{
	public function validateInt($input)
	{
		if (is_string($input))
		{
			$input = trim($input);
			$string = filter_var($input, FILTER_SANITIZE_STRING);
			$int = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
			if (strlen($int) > 0)
			{
				return intval($int);
			}
		} else {
			$validate = filter_var($input, FILTER_VALIDATE_INT);
			if ($validate)
			{
				return $validate;
			}
		}
		
		return NULL;
	}

	public function validateStr($input)
	{
		$input = trim($input);
		$string = filter_var($input, FILTER_SANITIZE_STRING);
		if ($string)
		{
			return $string;
		}
		return NULL;
	}

	public function cleanData($input)
	{
		// $email = filter_var($input, FILTER_SANITIZE_EMAIL);
		// $validate = filter_var($email, FILTER_VALIDATE_EMAIL);
		// return $validate;
	}

	public function validateEmail($input)
	{
		$email = filter_var($input, FILTER_SANITIZE_EMAIL);
		$validate = filter_var($email, FILTER_VALIDATE_EMAIL);
		if ($validate)
		{
			return $validate;
		}
		return NULL;
	}

	public function validateUrl($input)
	{
		$url = filter_var($input, FILTER_SANITIZE_URL);
		$validate = filter_var($url, FILTER_VALIDATE_URL);
		if ($validate)
		{
			return $validate;
		}
		return NULL;
	}
}