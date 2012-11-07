<h1>Create New Entry</h1>
<?php
echo '<form action="/criteria/createcriteria" method="POST">';
echo '<p><select name="criterion">';
echo '<option value="cost">Overall Cost</option>';
echo '<option value="weeklycost">Cost per Week</option>';
echo '<option value="monthlycost">Cost per Month</option>';
echo '<option value="weekfrequency">Frequency per Week</option>';
echo '<option value="monthfrequency">Frequency per Month</option>';
echo '<option value="ingredient"';
    if ($values['criterion']  == 'ingredient') {
        echo 'selected';
    }
echo '>Ingredient</option>';
echo '<option value="rating">Rating</option>';
echo '<option value="eatery"';
    if ($values['criterion'] == 'eatery') {
        echo 'selected';
    }
echo '>Eatery</option>';
echo '</select>';

echo '<select name="operator">
          <option><=</option>
          <option>>=</option>
          <option>=</option>
          <option>!=</option>
      </select>
            <input type="text" name="value" maxlength="20">
        </p>';


echo '<input type="hidden" name="profileID" value="'.$profileID.'">';


echo '<input type="submit" name="submit" value="Create">
      <input type="submit" name="cancel" value="Cancel">
    </form>';
?>