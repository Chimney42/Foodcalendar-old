<?php

class CriteriaController {

    protected function _renderOverview($notifications = array(), $profileID = NULL) {
        $profileMapper = new ProfileMapper();
        $profiles = $profileMapper->select(array('userID'=>$_SESSION['userid']));
        if($profileID == NULL) {
            $profileID = $profiles[0]->getID();
                }
        $return = $profileMapper->select(array('ID'=>$profileID));
        $profileInfo = $return[0];

        $criteriaMapper = new CriteriaMapper();
        $criteriaList = $criteriaMapper->select(array('ProfileCriteria.profileID'=>$profileID, 'ProfileCriteria.criteriaID'=>'Criteria.ID'), array('Criteria.ID', 'Criteria.criterion', 'Criteria.operator', 'Criteria.value'), array('ProfileCriteria', 'Criteria'));
        include 'Criteria/CriteriaView.php';
    }

    public function indexAction() {
        $profileID = $_GET['id'];
        $this->_renderOverview(array(), $profileID);

    }

    public function createprofileAction() {
        if (isset($_POST['submit'])) {
            $profileMapper = new ProfileMapper;
            $profileValues = array();
            $profileValues['name'] = $_POST['name'];
            $profileValues['userID'] = $_SESSION['userid'];
            $profile = new Profile($profileValues);
            $return = $profileMapper->insert($profile);
            if($return instanceof Profile) {
                $this->_renderOverview(array('You have successfully created Profile '.$return->getID().' '.$return->getName().'!'), $return->getID());
            } else {
                $this->_renderOverview(array('DB failure on insert'));
            }
        } elseif (isset($_POST['cancel'])) {
            $this->_renderOverview();
        } else {
            $this->_renderOverview(array());
            include 'Criteria/createProfile.php';
        }
    }

    public function editprofileAction() {
        $profileMapper = new ProfileMapper;
        if (isset($_POST['submit'])) {
            $profileID = $_POST['profileID'];
            $return = $profileMapper->select(array('ID'=>$profileID));
            $profile = $return[0];
            $profile->setName($_POST['name']);
            $success = $profileMapper->update($profile);
            if ($success === true) {
                $this->_renderOverview(array('You have successfully edited Profile '.$profile->getID()."'s name to ".$profile->getName()), $profile->getID());
            } else {
                $this->_renderOverview(array('DB failure on update'), $profile->getID());
            }
        } elseif (isset($_POST['cancel'])) {
            $profileID = $_POST['profileID'];
            $this->_renderOverview(array(), $profileID);
        } else {
            $profileID = $_GET['id'];
            $return = $profileMapper->select(array('ID'=>$profileID));
            $profile = $return[0];
            $this->_renderOverview(array(), $profileID);
            include 'Criteria/editProfile.php';
        }
    }

    public function deleteprofileAction() {
        $profileMapper = new ProfileMapper;
        if (isset($_POST['submit'])) {
            $profileID = $_POST['profileID'];
            $profileCriteriaMapper = new ProfileCriteriaMapper;
            $profileCriteria = $profileCriteriaMapper->select(array('profileID'=>$profileID));
            if (!empty($profileCriteria)) {
                foreach ($profileCriteria as $profileCriterion) {
                    $profileCriteriaMapper->delete($profileCriterion);
                }
            }
            $return = $profileMapper->select(array('ID'=>$profileID));
            $profile = $return[0];
            $success = $profileMapper->delete($profile);
            $notifications = array();
            if ($success === true) {
                $notifications[] = 'You have successfully deleted Profile '.$profileID.' '.$profile->getName().'!';
            } else {
                $notifications[] = 'DB failure on delete';
            }
            $this->_renderOverview($notifications);
        } elseif(isset($_POST['cancel'])) {
            $profileID = $_POST['profileID'];
            $this->_renderOverview(array(), $profileID);
        } else {
            $profileID = $_GET['id'];
            $return = $profileMapper->select(array('ID'=>$profileID));
            $profile = $return[0];
            $this->_renderOverview(array(), $profileID);
            include 'Criteria/deleteProfile.php';
        }
    }

    public function saveboolAction() {
        $profileID = $_POST['profileID'];
        $profileMapper = new ProfileMapper;
        $return = $profileMapper->select(array('ID'=>$profileID));
        $profile = $return[0];
        $profile->setVegetarian($_POST['vegetarian']);
        $profile->setVegan($_POST['vegan']);
        $profile->setLactosefree($_POST['lactosefree']);
        $profile->setGlutenfree($_POST['glutenfree']);
        $success = $profileMapper->update($profile);
        if ($success === true) {
            $this->_renderOverview(array('You have successfully updated Profile '.$profile->getID().' '.$profile->getName().'!'), $profileID);
        } else {
            $this->_renderOverview(array('DB failure on update'), $profileID);
        }
    }

    public function createcriteriaAction() {
        if (isset($_POST['submit'])) {
            $profileID = $_POST['profileID'];
            $values = array();
            $values['criterion'] = $_POST['criterion'];
            $values['operator'] = $_POST['operator'];
            $values['value'] = $_POST['value'];
            if ($values['criterion'] == 'ingredient' && $values['operator'] == '<=' || $values['criterion'] == 'ingredient' && $values['operator'] == '>=') {
                $this->_renderOverview(array('Invalid Operator for Criterion "Ingredient'), $profileID);
                include 'Criteria/createCriteria.php';
            } elseif ($values['criterion'] == 'eatery' && $values['operator'] == '<=' || $values['criterion'] == 'eatery' && $values['operator'] == '>=') {
                $this->_renderOverview(array('Invalid Operator for Criterion "Eatery"'));
                include 'Criteria/createCriteria.php';
            } else {
                $criteria = new Criteria($values);
                $criteriaMapper = new CriteriaMapper;
                $criteria = $criteriaMapper->insert($criteria);
                $notifications = array();
                if ($criteria instanceof Criteria) {
                    $notifications[] = 'You have successfully created a new Entry '.$criteria->getCriterion().' '.$criteria->getOperator().' '.$criteria->getValue().'!';
                } else {
                    $notifications[] = 'DB failure on insert';
                }
                $profileCriteriaMapper = new ProfileCriteriaMapper;
                $values['profileID'] = $profileID;
                $values['criteriaID'] = $criteria->getID();
                $profileCriteria = new ProfileCriteria($values);
                $success = $profileCriteriaMapper->insert($profileCriteria);
                if ($success instanceof ProfileCriteria) {
                    $notifications[] = 'and added it to Profile '.$profileID;
                } else {
                    $notifications[] = 'DB failure on insert';
                }
                $this->_renderOverview($notifications, $profileID);
            }
        } elseif (isset($_POST['cancel'])) {
            $profileID = $_POST['profileID'];
            $this->_renderOverview(array(), $profileID);
        } else {
            $profileID = $_GET['id'];
            $this->_renderOverview(array(), $profileID);
            include 'Criteria/createCriteria.php';
        }
    }

    public function addcriteriaAction() {
        $criteriaMapper = new CriteriaMapper;
        $profileCriteriaMapper = new ProfileCriteriaMapper;
        if (isset($_POST['submit'])) {
            $profileID = $_POST['profileID'];
            $values = array();
            $notifications = array();
            foreach ($_POST['criteriaIDs'] as $criteriaID) {
                $values['profileID'] = $profileID;
                $values['criteriaID'] = $criteriaID;
                $profileCriteria = new ProfileCriteria($values);
                $success = $profileCriteriaMapper->insert($profileCriteria);
                if ($success instanceof ProfileCriteria) {
                    $notifications[] = 'You have successfully added Entry '.$criteriaID.' to Profile '.$profileID.'!';
                } else {
                    $notifications[] = 'DB failure on insert';
                }
            }
        $this->_renderOverview($notifications, $profileID);
        } elseif(isset($_POST['cancel'])) {
            $profileID = $_POST['profileID'];
            $this->_renderOverview(array(), $profileID);
        } else {
            $profileID = $_GET['id'];
            $entries = $criteriaMapper->select(array());
            $connections = $profileCriteriaMapper->select(array('profileID'=>$profileID));
            $criteriaIDs = array();
            foreach ($connections as $connection) {
                $criteriaIDs[] = $connection->getCriteriaID();
            }
            $this->_renderOverview(array(), $profileID);
            include 'Criteria/addCriteria.php';
        }
    }

    public function editcriteriaAction() {
        $criteriaMapper = new CriteriaMapper;
        if (isset($_POST['submit'])) {
            $profileID = $_POST['profileID'];
            $criteriaID = $_POST['criteriaID'];
            $values = array();
            $values['ID'] = $criteriaID;
            $values['criterion'] = $_POST['criterion'];
            $values['operator'] = $_POST['operator'];
            $values['value'] = $_POST['value'];
            $criteria = new Criteria($values);
            $success = $criteriaMapper->update($criteria);
            if ($success === true) {
                $this->_renderOverview(array('You have successfully edited Entry '.$criteria->getID().'!'), $profileID);
            } else {
                $this->_renderOverview(array('DB failure on update'), $profileID);
            }
        } elseif (isset($_POST['cancel'])) {
            $profileID = $_POST['profileID'];
            $this->_renderOverview(array(), $profileID);
        } else {
            $profileID = $_GET['pid'];
            $criteriaID = $_GET['cid'];
            $return = $criteriaMapper->select(array('ID'=>$criteriaID));
            $criteria = $return[0];
            $this->_renderOverview(array(), $profileID);
            include 'Criteria/editCriteria.php';
        }
    }

    public function deletecriteriaAction() {
        $criteriaMapper = new CriteriaMapper;
        $profileMapper = new ProfileMapper;
        if (isset($_POST['delete']) || isset($_POST['remove'])) {
            $profileID = $_POST['profileID'];
            $criteriaID = $_POST['criteriaID'];
            $profileCriteriaMapper = new ProfileCriteriaMapper();
            $values = array();
            $values['profileID'] = $profileID;
            $values['criteriaID'] = $criteriaID;
            $profileCriteria = new ProfileCriteria($values);
            $notifications = array();
            $success = $profileCriteriaMapper->delete($profileCriteria);
            if ($success === true) {
                $notifications[] = 'You have successfully removed Entry '.$criteriaID.' from Profile '.$profileID.'!';
            } else {
                $notifications[] = 'DB failure on delete';
            }
            if (isset($_POST['delete'])) {
                $return = $criteriaMapper->select(array('ID'=>$criteriaID));
                $criteria = $return[0];
                $success = $criteriaMapper->delete($criteria);
                if ($success === true) {
                    $notifications[] = 'You have successfully deleted Entry '.$criteria->getID().' '.$criteria->getCriterion().' '.$criteria->getOperator().' '.$criteria->getValue().'!';
                } else {
                    $notifications[] = 'DB failure on delete';
                }
            }
            $this->_renderOverview($notifications, $profileID);
        } elseif (isset($_POST['cancel'])) {
            $profileID = $_POST['profileID'];
            $this->_renderOverview(array(), $profileID);
        } else {
            $profileID = $_GET['pid'];
            $criteriaID = $_GET['cid'];
            $return = $criteriaMapper->select(array('ID'=>$criteriaID));
            $criteria = $return[0];
            $return = $profileMapper->select(array('ID'=>$profileID));
            $profile = $return[0];
            $this->_renderOverview(array(), $profileID);
            include 'Criteria/deleteCriteria.php';
        }
    }

}