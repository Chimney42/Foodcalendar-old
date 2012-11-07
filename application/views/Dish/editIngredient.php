<h1>Edit Ingredient</h1>
<?php
    echo 'You want to edit Ingredient '.$ingredient->getID().'!';
    echo '<form action="/dish/editingredient/" method="POST">';
    echo '<input type="text" name="name" maxlength="20" value="'.$ingredient->getName().'">';
    echo '<input type="hidden" name="ingredientID" value="'.$ingredient->getID().'">';
    echo '<input type="hidden" name="dishID" value="'.$dishID.'">';
    echo '<p><input type="submit" name="submit" value="Save">';
    echo '<input type="submit" name="cancel" value="Cancel"></p>';
    echo '</form>';
    echo '<br \>';
    echo 'Connected to:';
    echo '<br \>';
    foreach ($connections as $connection) {
        echo $connection[0].' @ '.$connection['name'];
        echo '<br \>';
    }
    ?>