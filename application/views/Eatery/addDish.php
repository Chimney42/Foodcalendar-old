<h1>Add Existing Dish</h1>

    (multiple choice possible)
<form action="/eatery/adddish" method="POST">
    <select name="dishes[]" multiple size="10">
        <?php
        
        if(is_null($fieldCount)) {
        
            $fieldCount = 1;
        
        }
        
        foreach ($dishes as $dish) {

            if($dish->getEateryID() == $eateryID) {

                echo '<option selected value="'.$dish->getID().'">'.$dish->getID().' '.$dish->getName().'</option>';

            } else {

                echo '<option value="'.$dish->getID().'">'.$dish->getID().' '.$dish->getName().'</option>';
            }
        }
        
        echo '<input type="hidden" name="eateryID" value="'.$eateryID.'">';
        ?>

    </select>
<br \>

    <p>This will edit the Eatery for selected Dishes</p>
    <p>Are you sure?</p>
    <input type="submit" name="submit" value="Yes">
    <input type="submit" name="cancel" value="No">

</form>