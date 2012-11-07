<h1>Generate Calendar</h1>
<?php
echo '<form action="/calendar/generate" method="POST">';
echo '<p>From: <input type="text" name="startYear" maxlength="4" value="YYYY">
        - <input type="text" name="startMonth" maxlength="2" value="MM">
        - <input type="text" name="startDay" maxlength="2" value="DD"></p>
      <p>To: <input type="text" name="endYear" maxlength="4" value="YYYY">
      - <input type="text" name="endMonth" maxlength="2" value="MM">
      - <input type="text" name="endDay" maxlength="2" value="DD"></p>';

echo 'Choose Profile';
echo ' <select name="profileID">
        <option value="0">none...</option>';
foreach ($profiles as $profile) {
    echo '<option value="'.$profile->getID().'">'.$profile->getName().'</option>';
}
echo '</select>';
echo '<input type="submit" name="submit" value="Generate">';
echo '<input type="submit" name="cancel" value="Cancel">';
echo '</form>';
?>