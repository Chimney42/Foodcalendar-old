<h1>Delete Dish</h1>

    <?php
    echo '<p>You want to delete Dish '.$dish->getID().' '.$dish->getName().' @ '.$eatery->getName().'!</p>';
    echo '<p>This will delete the Dish and all existing connections.</p>';

    echo '<p>Are you sure?</p>';

echo '<form action="/eatery/deletedish" method="POST">
    <input type="hidden" name="dishID" value="'.$dish->getID().'">
    <input type="hidden" name="eateryID" value="'.$eatery->getID().'">
    <input type="submit" name="submit" value="Yes">
    <input type="submit" name="cancel" value="No">
</form>';
?>
