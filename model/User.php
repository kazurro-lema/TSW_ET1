<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class User
{

	private $email;

	private $username;

	private $passwd;

	public function __construct($username = null, $email = null, $passwd = null)
	{
		$this->email = $email;
		$this->username = $username;
		$this->passwd = $passwd;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}
	public function getUsername()
	{
		return $this->username;
	}

	public function setUsername($username)
	{
		$this->username = $username;
	}

	public function getPasswd()
	{
		return $this->passwd;
	}

	public function setPassword($passwd)
	{
		$this->passwd = $passwd;
	}

	public function checkIsValidForRegister()
	{
		$errors = array();
		if (strlen($this->username) < 5) {
			$errors["username"] = "Username must be at least 5 characters length";
		}
		if (str_contains($this->username, ' ')) {
			$errors["username"] = "Username must not contain spaces";
		}
		if (strlen($this->email) < 5) {
			$errors["email"] = "Email must be at least 5 characters length";
		}
		if (strlen($this->passwd) < 5) {
			$errors["passwd"] = "Password must be at least 5 characters length";
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, "user is not valid");
		}
	}
}
