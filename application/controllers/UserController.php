<?php

class UserController {
	
	public function __construct() {
		
	}

	protected function _renderOverview($notifications = array(), $userID = NULL, $action = NULL) {
        if (is_null($userID)) {
            $userID = $_SESSION['userid'];
        }
		$userMapper = new UserMapper();
		$return = $userMapper->select(array('ID' => $userID));
		if (isset($return[0]) && $return[0] instanceof User) {
			$user = $return[0];
		}
		$query_output = $userMapper->select(array(), array('ID', 'name'));
		include 'User/UserView.php';
		
	}
	
	public function indexAction() {
		$action = 'index';
		$userID = $_GET['id'];
		$this->_renderOverview(array(), $userID, $action);
	}
	
	public function deleteAction() {
		if(isset($_POST['submit'])) {
			$userMapper = new UserMapper();
			$return = $userMapper->select(array('ID' => $_POST['ID']));
			if (isset($return[0]) && $return[0] instanceof User) {
				$user = $return[0];
				if ($_POST['password'] === $user->getPassword()) {
					$success = $userMapper->delete($user);
					if ($success === true) {
						$this->_renderOverview(array('You have successfully deleted User ' . $user->getName() . '!'));
					} else {
						$this->_renderOverview(array('DB failure on delete'));
					}
				} else {
					$this->_renderOverview(array('Wrong Password'));
				}
				
			} else {
				$this->_renderOverview(array('User not found'));
			}
		} else {
			$userID = $_SESSION['userid'];
			$this->_renderOverview();
			include 'User/deleteUser.php';
		}		
	}
	
	public function editnameAction() {
		if(isset($_POST['submit'])) {
            $userID = $_SESSION['userid'];
			$userMapper = new UserMapper();
			$return = $userMapper->select(array('ID' => $userID));
			if (isset($return[0]) && $return[0] instanceof User) {
				$user = $return[0];
				$user->setName($_POST['name']);
				$success = $userMapper->update($user);
				if (isset($success) && $success != false) {
					$this->_renderOverview(array('You have changed your name to ' . $user->getName()), $userID);
				} else {
					$this->_renderOverview(array('DB failure on update'), $userID);
				}
			} else {
				$this->_renderOverview(array('User not found'), $userID);
			}
		} else {
 			$userID = $_SESSION['userid'];
            $this->_renderOverview(array(), $userID);
		}
	}
	
	public function editpasswordAction() {
		if(isset($_POST['submit'])) {
			$userMapper = new UserMapper();
			$return = $userMapper->select(array('ID' => $_POST['ID']));
			if (isset($return[0]) && $return[0] instanceof User) {
				$user = $return[0];
				if($user->getPassword() == $_POST['oldPassword']) {
					if($_POST['newPassword'] == $_POST['newPasswordConfirm']) {
						$user->setPassword($_POST['newPassword']);
						$success = $userMapper->update($user);
						if (isset($success) && $success != false) {
							$this->_renderOverview(array('You have changed your password'));
						} else {
							$this->_renderOverview(array('DB failure on update'));
						}
					} else {
						$this->_renderOverview(array('New passwords do not match'));
					}
				} else {
					$this->_renderOverview(array('Wrong password'));
				}
			} else {
				$this->_renderOverview(array('User not found'));
			}
		} else {
			$this->_renderOverview();
			$userID = $_SESSION['userid'];
			include 'User/editUserPassword.php';
		}
	}

    public function editdescriptionAction() {
        if(isset($_POST['submit'])) {
            $userID = $_SESSION['userid'];
            $userMapper = new UserMapper;
            $return = $userMapper->select(array('ID'=>$userID));
            $user = $return[0];
            $user->setDescription($_POST['description']);
            $success = $userMapper->update($user);
            if ($success === true) {
                $this->_renderOverview(array('You have successfully edited your description'), $userID);
            } else {
                $this->_renderOverview(array('DB failure on update'), $userID);
            }
        } else {
            $userID = $_SESSION['userid'];
            $this->_renderOverview(array(), $userID);
        }
    }
}