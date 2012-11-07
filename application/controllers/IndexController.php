<?php

class IndexController {

    protected function _renderOverview() {
        include 'IndexView.php';
    }

    public function indexAction() {
        $this->_renderOverview();
    }

    public function loginAction() {
        $userMapper = new UserMapper;
        $name = $_POST['name'];
        $password = $_POST['password'];

        $return = $userMapper->select(array('name'=>$name, 'password'=>$password));
        $loggedUser = $return[0];

        if (is_null($loggedUser)) {
            echo 'Wrong Username or Password';
            include 'IndexView.php';
        } else {
            $_SESSION['login'] = true;
            $_SESSION['userid'] = $loggedUser->getID();
            header('Location:/user/index?'.SID);
        }
    }

	public function registerAction() {
	
		if(isset($_POST['submit'])) {
				
			$userMapper = new UserMapper();
			$user = new User(array('name' => $_POST['name'],
								    'password' => $_POST['password']));
				
			$success = $userMapper->insert($user);
				
			if ($success instanceof User) {
                $_SESSION['login'] = true;
                $_SESSION['userid'] = $success->getID();
                header('Location:/user/index?'.SID);
            }
				
		} else {
            echo 'Change Username';
			include 'IndexView.php';
		}
	}

    public function logoutAction() {
        session_unset();
        session_destroy();
        header('Location:http://lli-foodcalendar.bpdevsys-tools.bigpoint.net/');
    }
}