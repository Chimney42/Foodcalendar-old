<h1>Edit Eatery</h1>

<?php

echo 'You want to edit Eatery '.$eatery->getID().' '.$eatery->getName().'!';
echo '<form action="/eatery/editeatery/" method="POST">';
echo '<table>';
echo '<tr><td>Name:</td><td><input type="text" name="name" maxlength="20" value="'.$eatery->getName().'"></td></tr>';
echo '<tr><td>Description:</td><td><textarea name="description" cols="30" rows ="5">'.$eatery->getDescription().'</textarea></td></tr>';
echo '</table>';
echo '<input type="hidden" name="eateryID" value="'.$eatery->getID().'">';
echo '<input type="submit" name="submit" value="Save">';
echo '<input type="submit" name="cancel" value="Cancel">'
?>