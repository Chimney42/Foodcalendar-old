<h1>Add Eatery</h1>

<?php
echo 'You want to add an Eatery to Dish '.$dish->getName().' @ '.$eatery->getName().'!';
echo '<form action="/dish/addeatery/" method="POST">';
echo '<p><select  name="eateryID">';
foreach ($eateries as $value) {
    if($value->getID() == $eatery->getID()) {
        echo '<option selected value="'.$value->getID().'">'.$value->getID().' '.$value->getName().'</option>';
    } else {
        echo '<option value="'.$value->getID().'">'.$value->getID().' '.$value->getName().'</option>';
    }
}
echo '</select></p>';
echo '<input type="hidden" name="dishID" value="'.$dishID.'">';
echo '<p><input type="submit" name="create" value="Create New Dish">';
echo '<input type="submit" name="add" value="Add to Dish">';
echo '<input type="submit" name="cancel" value="Cancel"</p>';
echo '</form>';
?>