<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/UserMapper.php");

require_once(__DIR__ . "/../controller/BaseController.php");

class UsersController extends BaseController
{

	private $userMapper;

	public function __construct()
	{
		parent::__construct();

		$this->userMapper = new UserMapper();
		$this->view->setLayout("welcome");
	}

	public function login()
	{
		if (isset($_POST["username"])) {
			if ($this->userMapper->isValidUser($_POST["email"], $_POST["username"], $_POST["passwd"])) {

				$_SESSION["currentuser"] = $_POST["username"];

				$this->view->redirect("gastos", "index");
			} else {
				$errors = array();
				$errors["general"] = "Username is not valid";
				$this->view->setVariable("errors", $errors);
			}
		}
		$this->view->render("users", "login");
	}

	public function register()
	{

		$user = new User();
		$this->view->setFlash("Username ");

		if (isset($_POST["username"])) {
			$user->setUsername($_POST["username"]);
			$user->setEmail($_POST["email"]);
			$user->setPassword($_POST["passwd"]);
			$this->view->setFlash("Please login now");

			try {
				$user->checkIsValidForRegister();

				if (!($this->userMapper->usernameExists($user->getUsername()))) {

					$this->userMapper->save($user);

					$this->view->setFlash("Username successfully added. Please login now");

					$this->view->redirect("users", "login");
					
				} else {
					$errors = array();
					$errors["general"] = "Username already exists";
					$this->view->setVariable("errors", $errors);
				}
			} catch (ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}

		$this->view->setVariable("user", $user);

		$this->view->render("users", "register");
	}

	public function logout()
	{
		session_destroy();
		$this->view->redirect("users", "login");
	}
}
