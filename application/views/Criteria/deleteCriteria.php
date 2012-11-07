<h1>Delete/Remove Entry</h1>
<?php
echo '<p>You want to remove Entry '.$criteria->getID().' '.$criteria->getCriterion().' '.$criteria->getOperator().' '.$criteria->getValue().' from Profile '.$profile->getName().'!</p>';
echo '<p>You can either only remove the entry from the profile or delete the entry and all existing connections.</p>';
echo '<form action="/criteria/deletecriteria" method="POST">
        <input type="hidden" name="profileID" value="'.$profileID.'">
        <input type="hidden" name="criteriaID" value="'.$criteriaID.'">
        <input type="submit" name="delete" value="Delete Entry">
        <input type="submit" name="remove" value="Remove Entry from Profile">
        <input type="submit" name="cancel" value="Cancel">
</form>'

?>