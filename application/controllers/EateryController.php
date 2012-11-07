<?php

class EateryController {

    protected function _renderOverview($notifications = array(), $eateryID = NULL) {
        $eateryMapper = new EateryMapper();
        $eateries = $eateryMapper->select(array());
        if ($eateryID == NULL) {
            $eateryID = $eateries[0]->getID();
        }
        $return = $eateryMapper->select(array('ID'=>$eateryID));
        $eateryInfo = $return[0];

        $dishMapper = new DishMapper();

        $eateryDishes = $dishMapper->select(array('eateryID'=>$eateryID));
        if ($eateryDishes == NULL) {
            $eateryDishes = array();
        }

        include 'Eatery/EateryView.php';

    }

    public function indexAction() {

        $eateryID = $_GET['id'];
        $this->_renderOverview(array(), $eateryID);

    }

    public function createeateryAction() {
        if(isset($_POST['submit']))  {
            $eateryValue = array();
            $eateryValue['name'] = $_POST['name'];
            $eateryValue['description'] = $_POST['description'];
            $eatery = new Eatery($eateryValue);
            $eateryMapper = new EateryMapper;
            $eatery = $eateryMapper->insert($eatery);
            if ($eatery instanceof Eatery) {
                $this->_renderOverview(array('You have successfully created Eatery '.$eatery->getID().' '.$eatery->getName().'!'), $eatery->getID());
            } else {
                $this->_renderOverview('DB failure on insert');
            }
        } elseif(isset($_POST['cancel'])) {
            $this->_renderOverview();
        } else {
            $this->_renderOverview();
            include 'Eatery/createEatery.php';
        }
    }

    public function editeateryAction() {
        $eateryMapper = new EateryMapper();
        if(isset($_POST['submit'])) {
            $eateryValue = array();
            $eateryValue['ID'] = $_POST['eateryID'];
            $eateryValue['name'] = $_POST['name'];
            $eateryValue['description'] = $_POST['description'];
            $eatery = new Eatery($eateryValue);
            $success = $eateryMapper->update($eatery);
            if ($success === true) {
                $this->_renderOverview(array('You have successfully edited Eatery '.$eatery->getID().' '.$eatery->getName().'!'), $eatery->getID());
            } else {
                $this->_renderOverview(array('DB failure on update'), $eatery->getID());
            }
        } elseif(isset($_POST['cancel'])) {
            $eateryID = $_POST['eateryID'];
            $this->_renderOverview(array(), $eateryID);
        } else {
            $eateryID = $_GET['id'];
            $this->_renderOverview(array(), $eateryID);
            $return = $eateryMapper->select(array('ID'=>$eateryID));
            $eatery = $return[0];
            include 'Eatery/editEatery.php';
        }
    }

    public function deleteeateryAction() {
        $eateryMapper = new EateryMapper;
        if(isset($_POST['submit'])) {
            $eateryID = $_POST['eateryID'];
            $notifications = array();
            $dishMapper = new DishMapper();
            $dishes = $dishMapper->select(array('eateryID'=>$eateryID));
            if (!empty($dishes)) {
                foreach ($dishes as $dish) {
                    $success = $dishMapper->delete($dish);
                    if ($success === true) {
                        $notifications[] = 'You have successfully deleted Dish '.$dish->getName().'!';
                    } else {
                        $notifications[] = 'DB failure on delete';
                    }
                }
            }
            $return = $eateryMapper->select(array('ID'=>$eateryID));
            $eatery = $return [0];
            $success = $eateryMapper->delete($eatery);
            if ($success === true) {
                $notifications[] = 'You have successfully deleted Eatery '.$eatery->getID().' '.$eatery->getName().'!';
            } else {
                $notifications[] = 'DB failure on delete';
            }
            $this->_renderOverview($notifications);
        } elseif(isset($_POST['cancel'])) {
            $eateryID = $_POST['eateryID'];
            $this->_renderOverview(array(), $eateryID);
        } else {
            $eateryID = $_GET['id'];
            $return = $eateryMapper->select(array('ID'=>$eateryID));
            $eatery = $return[0];
            $this->_renderOverview(array(), $eateryID);
            include 'Eatery/deleteEatery.php';
        }
    }

    public function createdishAction() {
        if (isset($_POST['submit'])) {
            $eateryID = $_POST['eateryID'];
            $fieldCount = (int) $_POST['fieldCount'];
            $dishMapper = new DishMapper();
            $dishValues = array();
            for ($i = 1; $i <= $fieldCount; $i++) {
                $dishValues['name'] = $_POST['name'.$i];
                $dishValues['cost'] = (float) implode('.', array($_POST['costEuro'.$i], $_POST['costCent'.$i]));
                $dishValues['rating'] = $_POST['rating'.$i];
                $dishValues['eateryID'] = $_POST['eateryID'];

                if($_POST['vegetarian'.$i] == 'true') {
                    $dishValues['vegetarian'] = 1;
                } else {
                    $dishValues['vegetarian'] = 0;
                }

                if($_POST['vegan'.$i] == 'true') {
                    $dishValues['vegan'] = 1;
                } else {
                    $dishValues['vegan'] = 0;
                }

                if($_POST['lactosefree'.$i] == 'true') {
                    $dishValues['lactosefree'] = 1;
                } else {
                    $dishValues['lactosefree'] = 0;
                }

                if($_POST['glutenfree'.$i] == 'true') {
                    $dishValues['glutenfree'] = 1;
                } else {
                    $dishValues['glutenfree'] = 0;
                }

                $dish = new Dish($dishValues);
                $dish = $dishMapper->insert($dish);
                $notifications = array();
                $eateryMapper = new EateryMapper();
                $return = $eateryMapper->select(array('ID'=>$eateryID));
                $eatery = $return[0];
                if ($dish instanceof Dish) {
                    $notifications[] = 'You have successfully created Dish '.$dish->getID().' '.$dish->getName().' @ '.$eatery->getName().'!';
                } else {
                    $notifications[] = 'DB failure on insert';
                }
            }
            $this->_renderOverview($notifications, $eateryID);
        } elseif(isset($_POST['fieldCount']) && !isset($_POST['cancel'])) {
            $fieldCount = (int) $_POST['fieldCount'];

            if(!isset($names)) {
                $names = array();
            }

            if (!isset($costsEuro)) {
                $costsEuro = array();
            }

            if (!isset($costsCent)) {
                $costsCent = array();
            }

            if (!isset($ratings)) {
                $ratings = array();
            }

            if (!isset($vegetarians)) {
              $vegetarians = array();
            }

            if (!isset($vegans)) {
              $vegans = array();
            }

            if (!isset($lactosefrees)) {
              $lactosefrees = array();
            }

            if (!isset($glutenfrees)) {
               $glutenfrees = array();
            }

            for ($i = 1; $i <= $fieldCount; $i++) {
                $names[] = $_POST['name'.$i];
                $costsEuro[] = $_POST['costEuro'.$i];
                $costsCent[] = $_POST['costCent'.$i];
                $ratings[] = $_POST['rating'.$i];

                if($_POST['vegetarian'.$i] == 'true') {
                    $vegetarians[] = 1;
                } else {
                    $vegetarians[] = 0;
                }

                if($_POST['vegans'.$i] == 'true') {
                    $vegans[] = 1;
                } else {
                    $vegans[] = 0;
                }

                if($_POST['lactosefree'.$i] == 'true') {
                    $lactosefrees[] = 1;
                } else {
                    $lactosefrees[] = 0;
                }

                if($_POST['glutenfree'.$i] == 'true') {
                    $glutenfrees[] = 1;
                } else {
                    $glutenfrees[] = 0;
                }
            }

            $eateryID = $_POST['eateryID'];
            $fieldCount++;
            $this->_renderOverview(array(), $eateryID);
            include 'Eatery/createDish.php';
        } elseif(isset($_POST['cancel'])) {
            $eateryID = $_POST['eateryID'];
            $this->_renderOverview(array(), $eateryID);
        } else {
            $eateryID = $_GET['id'];
            $this->_renderOverview(array(), $eateryID);
            include 'Eatery/createDish.php';
        }
    }

    public function adddishAction() {
        $dishMapper = new DishMapper();
        if(isset($_POST['submit'])) {
            $eateryID = (int)$_POST['eateryID'];
            $dishes = $_POST['dishes'];
            foreach ($dishes as $dishID) {
                $return = $dishMapper->select(array('ID'=>$dishID));
                $dish = $return[0];
                $dish->setEateryID($eateryID);
                $success = $dishMapper->update($dish);
                $notifications = array();

                if($success === true) {
                    $notifications[] = 'You have successfully edited Dish '.$dish->getID().' '.$dish->getName()."'s Eatery!";
                } else {
                    $notifications[] = 'DB failure on update';
                }
            }
            $this->_renderOverview($notifications, $eateryID);
        } elseif(isset($_POST['cancel'])) {
            $eateryID = $_POST['eateryID'];
            $this->_renderOverview(array(), $eateryID);
        } else {
            $eateryID = $_GET['id'];
            $dishes = $dishMapper->select(array());
            $this->_renderOverview(array(), $eateryID);
            include 'Eatery/addDish.php';
        }
    }

    public function deletedishAction() {
        $eateryMapper = new EateryMapper;
        $dishMapper = new DishMapper;
        if(isset($_POST['submit'])) {
            $eateryID = $_POST['eateryID'];
            $dishID = (int)$_POST['dishID'];
            $return = $dishMapper->select(array('ID'=>$dishID));
            $dish = $return[0];
            $success = $dishMapper->delete($dish);
            if($success === true) {
                $this->_renderOverview(array('You have successfully deleted Dish '.$dish->getID().' '.$dish->getName().'!'), $eateryID);
            } else {
                $this->_renderOverview(array('DB failure on delete'), $eateryID);
            }
        } elseif(isset($_POST['cancel'])) {
            $eateryID = $_POST['eateryID'];
            $this->_renderOverview(array(), $eateryID);
        } else {
            $eateryID = $_GET['eid'];
            $return = $eateryMapper->select(array('ID'=>$eateryID));
            $eatery = $return[0];
            $dishID = $_GET['did'];
            $return = $dishMapper->select(array('ID'=>$dishID));
            $dish = $return[0];
            $this->_renderOverview(array(), $eateryID);
            include 'Eatery/deleteDish.php';
        }
    }

}