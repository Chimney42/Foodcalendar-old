<h1>Edit Profile Name</h1>
<?php
    echo '<p><h2>ID'.$profile->getID().'</h2></p>';
    echo '<form action="/criteria/editprofile" method="POST">';
        echo '<input type="text" name="name" maxlength="20" value="'.$profile->getName().'">';
        echo '<input type="hidden" name="profileID" value="'.$profile->getID().'">';
        echo '<input type="submit" name="submit" value="Save">';
        echo '<input type="submit" name="cancel" value="Cancel">';
    echo '</form>';