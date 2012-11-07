<?php
require 'DishMapper.php';
require '../application/models/Dish.php';

$mapper = new Mapper;
$values = array();
$values['ID'] = 40;
$values['name'] = 'TEST';
$values['cost'] = 5.4;
$values['rating'] = 3;
$values['eateryID'] = 5;
$values['vegetarian'] = 1;
$values['vegan'] = 1;
$values['lactosefree'] = 1;
$values['created'] = 3;
$values['edited'] = 3;
$dish = new Dish($values);
$return = $mapper->update($dish);
var_dump($return);



