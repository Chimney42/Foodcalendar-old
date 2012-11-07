<h1>Create Ingredient</h1>
<p>Add new Ingredient to <?php echo $title[0].'@'.$title['name']; ?></p>
    
<form action="/dish/createingredient" method="POST">
    <?php
        if(!isset($fieldCount)) {
            $fieldCount = 1;
        }
        if(!isset($values)) {
            $values = array('');
        }
        $index = 1;
        $i = 0;
        while ($index <= $fieldCount) {
            echo '<p><input type ="text" value ="';
            echo $values[$i];
            echo '" name ="';
            echo 'name'.$index.'"';
            echo ' maxlength="20">';
            $index++;
            $i++;
        }
        echo '<input type="hidden" name="dishID" value="'.$dishID.'">';
        echo '<input type="hidden" name="fieldCount" value="'.$fieldCount.'">';
        echo '<input type="image" src="../../Icons/add.png" alt ="add input field" value="fieldCount" \>';
    ?>
    </p>
    <input type="submit" name="submit" value="Create">
    <input type="submit" name="cancel" value="Cancel">
</form>