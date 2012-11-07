<?php

class DishController {
	
	protected function _renderOverview($notifications = array(), $dishID = NULL) {
        $dishMapper = new DishMapper;
        $eateryMapper = new EateryMapper;
        $userMapper = new UserMapper;
        $dishList = $dishMapper->select(array('Dish.eateryID'=>'Eatery.ID'), array('Dish.ID', 'Dish.name', 'Eatery.name'), array('Dish', 'Eatery'));
        ksort($dishList);
		if($dishID == NULL) {
			$first = current($dishList);
            $dishID = $first['ID'];
		}
		$return = $dishMapper->select(array('ID'=>$dishID));
		$dishInfo = $return[0];
        $return = $userMapper->select(array('ID'=>$dishInfo->getCreated()));
        $creator = $return[0];
        $return = $userMapper->select(array('ID'=>$dishInfo->getEdited()));
        $editor = $return[0];
		$dishIngredients = $dishMapper->select(array('DishIngredient.dishID'=>$dishID, 'Ingredient.ID'=>'DishIngredient.ingredientID'), array('Ingredient.ID', 'Ingredient.name'), array('Ingredient', 'DishIngredient'));
        $return = $eateryMapper->select(array('ID'=>$dishInfo->getEateryID()));
        $dishEatery = $return[0];
		include 'Dish/DishView.php';
	}
	
	public function indexAction() {
		$dishID = $_GET['id'];
		$this->_renderOverview(array(), $dishID);
	}
	
	public function createdishAction() {
        $eateryMapper = new EateryMapper();
		if(isset($_POST['submit'])) {
			$dishMapper = new DishMapper();
			$dishValues = array();
			$dishValues['name'] = $_POST['dishName'];
			(float)$dishCost = $_POST['dishCostEuro'].'.'.$_POST['dishCostCent'];
			$dishValues['cost'] = $dishCost;
			$dishValues['rating'] = $_POST['dishRating'];
			$dishValues['eateryID'] = $_POST['eateryID'];
			$dishValues['vegetarian'] = $_POST['dishVegetarian'];
            $dishValues['vegan'] = $_POST['dishVegan'];
            $dishValues['lactosefree'] = $_POST['dishLactosefree'];
			$dishValues['glutenfree'] = $_POST['dishGlutenfree'];
            $dishValues['created'] = $_SESSION['userid'];
            $dishValues['edited'] = $_SESSION['userid'];
			$dish = new Dish($dishValues);
			$dish = $dishMapper->insert($dish);
			if ($dish instanceof Dish) {
				$this->_renderOverview(array('You have successfully created dish ' . $dish->getName().'!'), $dish->getID());
			} else {
				$this->_renderOverview(array('DB failure on insert'));
			}
		} elseif (isset($_POST['cancel'])) {
            $this->_renderOverview();
        } else {
            $eateries = $eateryMapper->select(array());
			$this->_renderOverview();
			include 'Dish/createDish.php'; 
		}
		
	}
	
	public function editdishAction() {
		$dishMapper = new DishMapper;
		if(isset($_POST['submit'])) {
			$dishID = $_POST['dishID'];
			$dishValues = array();
			$dishValues['ID'] = $dishID;
			$dishValues['name'] = $_POST['name'];
			(float)$dishCost = $_POST['costEuro'].'.'.$_POST['costCent'];
			$dishValues['cost'] = $dishCost;
			$dishValues['rating'] = $_POST['rating'];
			$dishValues['eateryID'] = (int)$_POST['eateryID'];
            $dishValues['vegetarian'] = $_POST['vegetarian'];
            $dishValues['vegan'] = $_POST['vegan'];
            $dishValues['lactosefree'] = $_POST['lactosefree'];
            $dishValues['glutenfree'] = $_POST['glutenfree'];
            $dishValues['created'] = $_POST['created'];
            $dishValues['edited'] = $_SESSION['userid'];
            $dish = new Dish($dishValues);
			$success = $dishMapper->update($dish);
			if ($success === true) {
				$this->_renderOverview(array('You have successfully changed the information for Dish ' . $dish->getID().' '.$dish->getName() . '!'), $dishID);
			} else {
				$this->_renderOverview(array('DB failure on update'));
			}
		} elseif (isset($_POST['cancel'])) {
            $dishID = $_POST['dishID'];
            $this->_renderOverview(array(), $dishID);
        } else {
			$dishID = $_GET['id'];
			$this->_renderOverview(array(), $dishID);
			$return = $dishMapper->select(array('ID'=>$dishID));
			$dish = $return[0];
			$dishCost = strval($dish->getCost());
			$dishCost = explode('.', $dishCost);
			include 'Dish/editDish.php';
		}
	}

    public function deletedishAction() {
        $dishMapper = new DishMapper();
        if(isset($_POST['submit'])) {
            $dishID = $_POST['ID'];
            $calendarMapper = new CalendarMapper;
            $connections = $calendarMapper->select(array('dishID' => $dishID));
            if (!empty($connections)){
                foreach ($connections as $connection) {
                    $calendarMapper->delete($connection);
                }
            }
            $return = $dishMapper->select(array('ID'=>$dishID));
            $dish = $return[0];
            $success = $dishMapper->delete($dish);
            if($success === true) {
                $this->_renderOverview(array('You have successfully deleted Dish '.$_POST['name'].'!'));
            } else {
                $this->_renderOverview(array('DB failure on delete'));
            }
        } elseif (isset($_POST['cancel'])) {
            $dishID = $_POST['ID'];
            $this->_renderOverview(array(), $dishID);
        } else {
            $dishID = $_GET['id'];
            $return = $dishMapper->select(array('ID'=>$dishID));
            $dish = $return[0];
            $this->_renderOverview(array(), $dishID);
            include 'Dish/deleteDish.php';
        }
    }

    public function createingredientAction() {
        $dishMapper = new DishMapper();
        $ingredientMapper = new IngredientMapper();
        $dishIngredientMapper = new DishIngredientMapper();
        if(isset($_POST['submit'])) {
            $values = array();
            for ($i = 1; $i <= $_POST['fieldCount']; $i++) {
                $values[] = $_POST['name'.$i];
            }
            $return = array();
            $ingredients = array();
            foreach ($values as $value) {
                $ingredient = new Ingredient(array('name'=>$value));
                $ingredientReturn = $ingredientMapper->insert($ingredient);
                $ingredients[] = $ingredientReturn;
                $dishIngredient = array('dishID'=>$_POST['dishID'], 'ingredientID'=>$ingredientReturn->getID());
                $dishIngredient = new DishIngredient($dishIngredient);
                $dishIngredientMapper->insert($dishIngredient);
                $notifications = array();
                if($ingredientReturn instanceof Ingredient) {
                    $notifications[] = 'You have successfully created Ingredient '.$value.'!';
                } else {
                    $notifications[] = 'DB failure on insert';
                }
            }
            $this->_renderOverview($notifications, $_POST['dishID']);
        } elseif (isset($_POST['cancel'])) {
            $dishID = $_POST['dishID'];
            $this->_renderOverview(array(), $dishID);
        } elseif (isset($_POST['fieldCount']) && !isset($_POST['cancel'])) {
            $dishID = (int) $_POST['dishID'];
            $return = $dishMapper->select(array('Dish.ID'=>$dishID, 'Dish.eateryID'=>'Eatery.ID'), array('Dish.name', 'Eatery.name'), array('Dish', 'Eatery'));
            $title = $return[0];
            $this->_renderOverview(array(), $dishID);
            $fieldCount = (int) $_POST['fieldCount'];
            $values = array();
            for ($i = 1; $i <= $fieldCount; $i++) {
                $values[] = $_POST['name'.$i];
            }
            $fieldCount++;
            include 'Dish/createIngredient.php';

        } else {
            $dishID = $_GET['id'];
            $return = $dishMapper->select(array('Dish.ID'=>$dishID, 'Dish.eateryID'=>'Eatery.ID'), array('Dish.name', 'Eatery.name'), array('Dish', 'Eatery'));
            $title = current($return);
            $this->_renderOverview(array(), $dishID);
            include 'Dish/createIngredient.php';
        }
    }

    public function addingredientAction() {
        $dishMapper = new DishMapper();
        $ingredientMapper = new IngredientMapper();
        $dishIngredientMapper = new DishIngredientMapper();
        if(isset($_POST['submit'])) {
            $notifications = array();
            foreach ($_POST['ingredients'] as $ingredientID) {
                $return = $ingredientMapper->select(array('ID'=>$ingredientID));
                $ingredient = $return[0];
                $values = array('dishID'=>$_POST['dishID'], 'ingredientID'=>$ingredient->getID());
                $dishIngredient = new DishIngredient($values);
                $dishIngredient = $dishIngredientMapper->insert($dishIngredient);
                if($dishIngredient instanceof DishIngredient) {
                    $notifications[] = 'You have successfully added Ingredient '.$ingredient->getName().' to Dish '.$_POST['dish'].'@'.$_POST['eatery'].'!';
                } else {
                    $notifications[] = 'DB failure on insert';
            }
        }
            $this->_renderOverview($notifications, $_POST['dishID']);
        } elseif (isset($_POST['cancel'])) {
            $dishID = $_POST['dishID'];
            $this->_renderOverview(array(), $dishID);
        } else {
            $dishID = $_GET['id'];
            $return = $dishMapper->select(array('Dish.ID'=>$dishID, 'Dish.eateryID'=>'Eatery.ID'), array('Dish.name', 'Eatery.name'), array('Dish', 'Eatery'));
            $title = current($return);
            $ingredients = $ingredientMapper->select(array());
            $connections = $dishIngredientMapper->select(array('dishID'=>$dishID));
            $ingredientIDs = array();
            foreach ($connections as $connection) {
                $ingredientIDs[] = $connection->getIngredientID();
            }
            $this->_renderOverview(array(), $dishID);
            include 'Dish/addIngredient.php';
        }
    }

    public function editingredientAction() {
        $ingredientMapper = new IngredientMapper();
        $dishMapper = new DishMapper;
        if(isset($_POST['submit'])) {
            $ingredientValue = array();
            $ingredientValue['ID'] = $_POST['ingredientID'];
            $ingredientValue['name'] = $_POST['name'];
            $ingredient = new Ingredient($ingredientValue);
            $success = $ingredientMapper->update($ingredient);
            if($success === true) {
                $this->_renderOverview(array('You have successfully edited Ingredient '.$ingredient->getID()), $_POST['dishID']);
            } else {
                $this->_renderOverview(array('DB failure on update'));
            }
        } elseif (isset($_POST['cancel'])) {
            $dishID = $_POST['dishID'];
            $this->_renderOverview(array(), $dishID);
        } else {
            $dishID = $_GET['did'];
            $ingredientID = $_GET['iid'];
            $return = $ingredientMapper->select(array('ID'=>$ingredientID));
            $ingredient = $return[0];
            $connections = $dishMapper->select(array('DishIngredient.ingredientID'=>$ingredientID, 'DishIngredient.dishID'=>'Dish.ID', 'Dish.eateryID'=>'Eatery.ID'), array('Dish.name', 'Eatery.name'), array('Dish, Eatery, DishIngredient'));
            $this->_renderOverview(array(), $dishID);
            include 'Dish/editIngredient.php';
        }
    }

    public function deleteingredientAction() {
        $ingredientMapper = new IngredientMapper();
        $dishMapper = new DishMapper();
        $dishIngredientMapper = new DishIngredientMapper;
        $eateryMapper = new EateryMapper;
        if(isset($_POST['delete']) || isset($_POST['remove'])) {
            $dishID = $_POST['dishID'];
            $dishIngredientValue = array();
            $dishIngredientValue['dishID'] = $_POST['dishID'];
            $dishIngredientValue['ingredientID'] = $_POST['ingredientID'];
            $dishIngredient = new DishIngredient($dishIngredientValue);
            $dIsuccess = $dishIngredientMapper->delete($dishIngredient);
            $notifications = array();
            if ($dIsuccess === true) {
                $notifications[] = 'You have successfully removed Ingredient '. $_POST['ingredientID'].' '.$_POST['iName'].' from Dish '.$_POST['dName'].'!';
            } else {
                $notifications[] = 'DB failure on delete';
            }
            if(isset($_POST['delete'])) {
                $ingredientValue['ID'] = $_POST['ingredientID'];
                $ingredientValue['name'] = $_POST['iName'];
                $ingredient = new Ingredient($ingredientValue);
                $success = $ingredientMapper->delete($ingredient);
                if($success === true) {
                    $notifications[] = 'You have successfully deleted Ingredient '.$_POST['ingredientID'].' '.$_POST['iName'].'!';
                } else {
                    $notifications[] = 'DB failure on delete';
                }
            }
            $this->_renderOverview($notifications, $dishID);
        } elseif (isset($_POST['cancel'])) {
            $dishID = $_POST['dishID'];
            $this->_renderOverview(array(), $dishID);
        } else {
            $dishID = $_GET['did'];
            $ingredientID = $_GET['iid'];
            $return = $dishMapper->select(array('ID'=>$dishID));
            $dish = $return[0];
            $return = $ingredientMapper->select(array('ID'=>$ingredientID));
            $ingredient = $return[0];
            $return = $dishIngredientMapper->select(array('ingredientID'=>$dishID));
            $dishes = array();
            $connections = array();

            foreach ($return as $connection) {
                $array = array();
                $connectionDishID = $connection->getDishID();
                $return = $dishMapper->select(array('ID'=>$connectionDishID));
                $dish = $return[0];
                $array[] = $dish;
                $eatery = $eateryMapper->select(array('ID'=>$dish->getEateryID()));
                $array[] = $eatery[0];
                $connections[] = $array;
            }
            $this->_renderOverview(array(), $dishID);
            include 'Dish/deleteIngredient.php';
        }
    }

    public function createeateryAction() {
        $dishMapper = new DishMapper();
        $eateryMapper = new EateryMapper();
        if(isset($_POST['create']) || isset($_POST['add'])) {
            $dishID = $_POST['dishID'];
            $eateryValue = array();
            $eateryValue['name'] = $_POST['name'];
            $eateryValue['description'] = $_POST['description'];
            $eatery = new Eatery($eateryValue);
            $eatery = $eateryMapper->insert($eatery);
            $notifications = array();
            if($eatery instanceof Eatery) {
                $notifications[] = 'You have successfully created Eatery '.$eatery->getName().'!';
            } else {
                $notifications[] = 'DB failure on insert';
            }
            $return = $dishMapper->select(array('ID'=>$dishID));
            $dish = $return[0];
            $dish->setEateryID($eatery->getID());
            if(isset($_POST['add'])) {
                $success = $dishMapper->update($dish);
                if($success === true) {
                    $notifications[] = 'You have successfully added Eatery '.$eatery->getName().' to Dish '.$dish->getName().'!';
                } else {
                    $notifications[] = 'DB error on update';
                }
            } elseif(isset($_POST['create'])) {
                $dish->setID(NULL);
                $dish = $dishMapper->insert($dish);
                $dishID = $dish->getID();
                if($dish instanceof Dish) {
                    $notifications[] = 'You have successfully created Dish '.$dish->getID().' '.$dish->getName().'and added Eatery '.$eatery->getName(). ' to it!';
                } else {
                    $notifications[] = 'DB failure on insert';
                }
            }
                $this->_renderOverview($notifications, $dishID);
        } elseif (isset($_POST['cancel'])) {
            $dishID = $_POST['dishID'];
            $this->_renderOverview(array(), $dishID);
        } else {
            $dishID = $_GET['id'];
            $return = $dishMapper->select(array('ID'=>$dishID));
            $dish = $return[0];
            $return = $eateryMapper->select(array('ID'=>$dish->getEateryID()));
            $eatery = $return[0];
            $this->_renderOverview(array(), $dishID);
            include 'Dish/createEatery.php';
        }
    }

    public function addeateryAction() {
        $dishMapper = new DishMapper();
        $eateryMapper = new EateryMapper();
        $notifications = array();
        if (isset($_POST['add']) || isset($_POST['create'])) {
            $dishID = (int)$_POST['dishID'];
            $return = $dishMapper->select(array('ID'=>$dishID));
            $dish = $return[0];
            $dish->setEateryID($_POST['eateryID']);
            $return = $eateryMapper->select(array('ID'=>$_POST['eateryID']));
            $eatery = $return[0];
            if (isset($_POST['add'])) {
                $success = $dishMapper->update($dish);
                if ($success === true) {
                    $notifications[] = 'You have successfully edited '.$dish->getID().' '.$dish->getName()."'s Eatery to ".$eatery->getName().'!';
                } else {
                    $notifications[] = 'DB failure on update';
                }
                $this->_renderOverview($notifications, $dishID);
            } elseif(isset($_POST['create'])) {
                $dish->setID(NULL);
                $dish = $dishMapper->insert($dish);
                if($dish instanceof Dish) {
                    $notifications[] = 'You have successfully created Dish '.$dish->getID().' '.$dish->getName().' @ '.$eatery->getName().'!';
                } else {
                    $notifications[] = 'DB failure on insert';
                }
                $this->_renderOverview($notifications, $dishID);
            }
        } elseif (isset($_POST['cancel'])) {
            $dishID = $_POST['dishID'];
            $this->_renderOverview(array(), $dishID);
        } else {
            $dishID = $_GET['id'];
            $return = $dishMapper->select(array('ID'=>$dishID));
            $dish = $return[0];
            $return = $eateryMapper->select(array('ID'=>$dish->getEateryID()));
            $eatery = $return[0];
            $eateries = $eateryMapper->select(array());
            $this->_renderOverview(array(), $dishID);
            include 'Dish/addEatery.php';
        }
    }
}