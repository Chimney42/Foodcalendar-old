<h1>Create New Dish</h1>

<form action="/eatery/createdish/" method ="POST">
<?php

    if(is_null($fieldCount)) {

        $fieldCount = 1;

    }

    if(!isset($names)) {
        $names = array('');
    }

    if (!isset($costsEuro)) {
        $costsEuro = array('');
    }

    if (!isset($costsCent)) {
        $costsCent = array('');
    }

    if (!isset($ratings)) {
        $ratings = array('');
    }

    if (!isset($vegetarians)) {
      $vegetarians = array('');
    }

    if (!isset($vegans)) {
      $vegans = array('');
    }

    if (!isset($lactosefrees)) {
      $lactosefrees = array('');
    }

    if (!isset($glutenfrees)) {
       $glutenfrees = array('');
    }

$index = 1;
$i = 0;
while ($index <= $fieldCount) {

    echo '<p>Name: ';
    echo '<input type ="text" value ="';
    echo $names[$i];
    echo '" name ="';
    echo 'name'.$index.'"';
    echo ' maxlength="20">';
    echo '</p>';
    
    echo '<p>Cost: ';
    echo '<input value="';
    echo $costsEuro[$i];
    echo '" name="';
    echo 'costEuro'.$index.'"';
    echo ' maxlength="5">';

    echo '<input value="';
    echo $costsCent[$i];
    echo '" name="';
    echo 'costCent'.$index.'"';
    echo ' maxlength="2">';
    echo '</p>';

    echo '<p>Rating: ';
    echo '<select name="';
    echo 'rating'.$index.'"';
    echo ' size="5">';
    switch($ratings[$i]) {

        case NULL:
            echo '<option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>';
            break;

       case 1:
             echo '<option selected>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>';
            break;

        case 2:
                    echo '<option>1</option>
                          <option selected>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>';
                    break;

        case 3:
                    echo '<option>1</option>
                          <option>2</option>
                          <option selected>3</option>
                          <option>4</option>
                          <option>5</option>';
                    break;

        case 4:
                    echo '<option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option selected>4</option>
                          <option>5</option>';
                    break;

        case 5:
                    echo '<option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option selected>5</option>';
                    break;
    }

    echo '</select></p>';
    
    echo '<p>Vegetarian: ';
    echo '<input type="checkbox" ';
    if ($vegetarians[$i] == 1) {
        echo 'checked';
    }
    echo ' name="';
    echo 'vegetarian'.$index.'"';
    echo ' value="true">';
    echo '</p>';


    echo '<p>Vegan: ';
    echo '<input type="checkbox" ';
    if ($vegans[$i] == 1) {
        echo 'checked';
    }
    echo ' name="';
    echo 'vegan'.$index.'"';
    echo ' value="true">';
    echo '</p>';


    echo '<p>Lactosefree: ';
    echo '<input type="checkbox" ';
    if ($lactosefrees[$i] == 1) {
        echo 'checked';
    }
    echo ' name="';
    echo 'lactosefree'.$index.'"';
    echo ' value="true">';
    echo '</p>';

    echo '<p>Glutenfree: ';
    echo '<input type="checkbox" ';
    if ($glutenfrees[$i] == 1) {
        echo 'checked';
    }
    echo ' name="';
    echo 'glutenfree'.$index.'"';
    echo ' value="true">';
    echo '</p>';

    $index++;
    $i++;
}

echo '<input type="hidden" name="eateryID" value="'.$eateryID.'">';
echo '<input type="hidden" name="fieldCount" value="'.$fieldCount.'">';
echo '<input type="image" src="../../Icons/add.png" alt ="add input field" value="fc">';
?>
    <br \>
    <input type="submit" name="submit" value="Create">
    <input type="submit" name="cancel" value="Cancel">
    </form>