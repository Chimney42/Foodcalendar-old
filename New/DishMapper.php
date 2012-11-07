<?php

require 'DBStatement.php';

class Mapper {

    public function insert(Dish $dish) {
        $query = array();
        $query['tables'] = 'Dish';
        $columns = array('name', 'cost', 'rating', 'eateryID', 'vegetarian', 'vegan', 'lactosefree', 'glutenfree', 'created', 'edited');
        $query['columns'] = $columns;
        $values = array($dish->getName(), $dish->getCost(), $dish->getRating(), $dish->getEateryID(), $dish->getVegetarian(), $dish->getVegan(), $dish->getLactosefree(), $dish->getGlutenfree(), $dish->getCreated(), $dish->getEdited());
        $query['values'] = $values;
        $statement = new Statement($query);
        $statement->insert();
        $dish->setID(mysql_insert_id());
        return $dish;
    }

    public function delete(Dish $dish) {
        $query = array();
        $query['tables'] = 'Dish';
        $conditions = array();
        $conditions['column'] = 'ID';
        $conditions['operator'] = '=';
        $conditions['value'] = $dish->getID();
        $query['conditions'] = array($conditions);
        $statement = new Statement($query);
        $return = $statement->delete();
        return $return;
    }

    public function select($columns, $tables, $conditions) {
        $query = array();
        if (!is_array($tables)) {
            $tables = array($tables);
            $singleTable = true;
        }
        $query['tables'] = $tables;
        if (!is_array($columns)) {
            $columns = array($columns);
        }
        $query['columns'] = $columns;
        if (is_null($conditions[0])) {
            $conditions = array($conditions);
        }
        $query['conditions'] = $conditions;
        $statement = new Statement($query);
        $query_output = $statement->select();

        $return = array();
		if ($singleTable === true) {
			while($row = mysql_fetch_assoc($query_output)){
				$return[] = new Dish($row);
			}
		} else {
			 while ($row = mysql_fetch_array($query_output)) {
				$return[$row['ID']] = $row;
			}
		}
		return $return;
    }

    public function update(Dish $dish) {
        $query = array();
        $query['tables'] = 'Dish';
        $columns = array('name', 'cost', 'rating', 'eateryID', 'vegetarian', 'vegan', 'lactosefree', 'glutenfree', 'created', 'edited');
        $query['columns'] = $columns;
        $values = array($dish->getName(), $dish->getCost(), $dish->getRating(), $dish->getEateryID(), $dish->getVegetarian(), $dish->getVegan(), $dish->getLactosefree(), $dish->getGlutenfree(), $dish->getCreated(), $dish->getEdited());
        $query['values'] = $values;
        $conditions = array();
        $conditions['column'] = 'ID';
        $conditions['operator'] = '=';
        $conditions['value'] = 49;
        $query['conditions'] = $conditions;

        $statement = new Statement($query);
        $return = $statement->select();
        if ($return == true) {
            return $dish;
        } else {
            return false;
        }
    }
}