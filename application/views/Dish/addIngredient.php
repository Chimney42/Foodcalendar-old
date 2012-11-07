<h1>Add Ingredient</h1>
<p>Add existing Ingredient to <?php echo $title[0].'@'.$title['name']; ?></p>

    (multiple choice possible)
<form action="/dish/addingredient/" method="POST">
    <select name="ingredients[]" multiple>

    <?php
        foreach ($ingredients as $ingredient) {
            if(!in_array($ingredient->getID(), $ingredientIDs))
                echo '<option value="'.$ingredient->getID().'">'.$ingredient->getName().'</option>';
                echo '<br \>';
        }

        echo '<input type="hidden" name="dishID" value="'.$dishID.'">';
        echo '<input type="hidden" name="dish" value="'.$title[0].'">';
        echo '<input type="hidden" name="eatery" value="'.$title[1].'">';
    ?>
    </p>

        </select>

    <input type="submit" name="submit" value="Add">
    <input type="submit" name="cancel" value="Cancel">
</form>