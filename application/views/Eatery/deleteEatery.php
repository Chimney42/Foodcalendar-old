<h1>Delete Eatery</h1>

<?php
echo 'You want to delete Eatery '.$eatery->getID().' '.$eatery->getName().'!';
echo '<br \>';
echo 'This will delete the eatery and all connected dishes!';
echo '<p>Are you sure?</p>';
echo ' <form action="/eatery/deleteeatery/" method="POST">';
echo '<input type="hidden" name="eateryID" value="'.$eatery->getID().'">';
echo '<input type="submit" name="submit" value="Yes">';
echo '<input type="submit" name="cancel" value="No">';
echo '</form>';
?>