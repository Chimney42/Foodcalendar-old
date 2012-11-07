<h1>Delete/Remove Ingredient</h1>

<?php
echo 'You want to remove Ingredient '.$ingredient->getID().' '.$ingredient->getName().' from Dish '.$dish->getName().'!';
echo '<br \>';
echo 'You can remove the ingredient from the dish or delete the ingredient and all existing connections.';
echo '<form action="/dish/deleteingredient/" method="POST">';
echo '<input type="hidden" name="dishID" value="'.$dishID.'">';
echo '<input type="hidden" name="dName" value="'.$dish->getName().'">';
echo '<input type="hidden" name="ingredientID" value="'.$ingredientID.'">';
echo '<input type="hidden" name="iName" value="'.$ingredient->getName().'">';
echo '<input type="submit" name="delete" value="Delete Ingredient">';
echo '<input type="submit" name="remove" value="Remove Ingredient from Dish">';
echo '<input type="submit" name="cancel" value="Cancel">';
echo '<p>Connected to: </p>';
if (!empty($connections)) {
    foreach ($connections as $connection) {
        $dish = $connection[0];
        $eatery = $connection[1];
        echo $dish->getID().' '.$dish->getName().' @ '.$eatery->getName().'<br />';
    }
}
echo '</form>';
?>