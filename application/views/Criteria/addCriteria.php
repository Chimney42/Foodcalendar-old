<h1>Add Existing Criteria</h1>

    <form action="/criteria/addcriteria" method="POST">
        <select name="criteriaIDs[]" multiple>
<?php
    foreach ($entries as $entry) {
        if (!in_array($entry->getID(), $criteriaIDs)) {
            echo '<option value="'.$entry->getID().'">'.$entry->getCriterion().' '.$entry->getOperator().' '.$entry->getValue().'</option>';
        }
    }
    echo '</select>';
    echo '<input type="hidden" name="profileID" value="'.$profileID.'">';
?>
        <p><input type="submit" name="submit" value="Add to Profile">
        <input type="submit" name="cancel" value="Cancel"></p>
    </form>