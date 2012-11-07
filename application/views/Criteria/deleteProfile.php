<h1>Delete Profile</h1>

<p>You want to delete Profile <?php echo $profile->getID().' '.$profile->getName(); ?> !</p>
      <p>This will delete the Profile and all existing connections.</p>
      <br />
      <p> Are you sure?</p>
<form action ="/criteria/deleteprofile" method ="POST">
    <input type="hidden" name="profileID" value="<?php echo $profile->getID(); ?>">
    <input type="submit" name="submit" value="Yes">
    <input type="submit" name="cancel" value="No">
</form>