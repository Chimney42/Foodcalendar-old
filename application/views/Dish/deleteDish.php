<h1>Delete Dish</h1>
    You want to delete Dish <?php echo $dish->getName(); ?>. Are you sure?
    <form action="deletedish/" method="POST">
        <input type="hidden" name="ID" value="<?php echo $dish->getID(); ?>">
        <input type="hidden" name="name" value="<?php echo $dish->getName(); ?>">
        <input type="submit" name="submit" value="Delete">
        <input type="submit" name="cancel" value="Cancel">
    </form>