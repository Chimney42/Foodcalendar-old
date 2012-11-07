<h1>Create Eatery</h1>
    <?php
    echo 'You want to create a new Eatery for '.$dish->getName().' @ '.$eatery->getName().'!';
    echo '<br \>';
    echo '<form action="/dish/createeatery/" method="POST">';
    echo 'Name: ';
    echo '<input type="text" name="name" maxlength="20" value="'.$eatery->getName().'">';
    echo '<br \>';
    echo 'Description :';
    echo '<textarea name="description" maxlength="250" cols ="10" rows="7">'.$eatery->getDescription().'</textarea>';
    echo '<input type="hidden" name="dishID" value="'.$dish->getID().'">';
    echo '<input type="hidden" name="eateryID" value="'.$eatery->getID().'">';
    echo '<p><input type="submit" name="create" value="Create New Dish">';
    echo '<input type="submit" name="add" value="Add to Dish">';
    echo '<input type="submit" name="cancel" value="Cancel"></p>';
    echo '</form>';

    ?>