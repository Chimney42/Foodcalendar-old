<h1>Edit Criteria</h1>
<?php
echo '<h3>ID: '.$criteriaID.'</h3>';
echo '<form action="/criteria/editcriteria" method="POST">
        <select name="criterion">';
switch ($criteria->getCriterion()) {
    case "cost":
        echo   '<option selected value="cost">Overall Cost</option>
                <option value="weeklycost">Cost per Week</option>
                <option value="monthlycost">Cost per Month</option>
                <option value="weekfrequency">Frequency per Week</option>
                <option value="monthfrequency">Frequency per Month</option>
                <option value="ingredient">Ingredient</option>
                <option value="rating">Rating</option>
                <option value="eatery">Eatery</option>';
        break;
    case "weeklycost":
        echo   '<option value="cost">Overall Cost</option>
                <option selected value="weeklycost">Cost per Week</option>
                <option value="monthlycost">Cost per Month</option>
                <option value="weekfrequency">Frequency per Week</option>
                <option value="monthfrequency">Frequency per Month</option>
                <option value="ingredient">Ingredient</option>
                <option value="rating">Rating</option>
                <option value="eatery">Eatery</option>';
        break;
    case "monthlycost":
        echo   '<option value="cost">Overall Cost</option>
                <option value="weeklycost">Cost per Week</option>
                <option selected value="monthlycost">Cost per Month</option>
                <option value="weekfrequency">Frequency per Week</option>
                <option value="monthfrequency">Frequency per Month</option>
                <option value="ingredient">Ingredient</option>
                <option value="rating">Rating</option>
                <option value="eatery">Eatery</option>';
        break;
    case "weekfrequency":
        echo   '<option value="cost">Overall Cost</option>
                <option value="weeklycost">Cost per Week</option>
                <option value="monthlycost">Cost per Month</option>
                <option selected value="weekfrequency">Frequency per Week</option>
                <option value="monthfrequency">Frequency per Month</option>
                <option value="ingredient">Ingredient</option>
                <option value="rating">Rating</option>
                <option value="eatery">Eatery</option>';
        break;
    case "monthfrequency":
        echo   '<option value="cost">Overall Cost</option>
                <option value="weeklycost">Cost per Week</option>
                <option value="monthlycost">Cost per Month</option>
                <option value="weekfrequency">Frequency per Week</option>
                <option selected value="monthfrequency">Frequency per Month</option>
                <option value="ingredient">Ingredient</option>
                <option value="rating">Rating</option>
                <option value="eatery">Eatery</option>';
        break;
    case "ingredient":
        echo   '<option value="cost">Overall Cost</option>
                <option value="weeklycost">Cost per Week</option>
                <option value="monthlycost">Cost per Month</option>
                <option value="weekfrequency">Frequency per Week</option>
                <option value="monthfrequency">Frequency per Month</option>
                <option selected value="ingredient">Ingredient</option>
                <option value="rating">Rating</option>
                <option value="eatery">Eatery</option>';
        break;
    case "rating":
        echo   '<option value="cost">Overall Cost</option>
                <option value="weeklycost">Cost per Week</option>
                <option value="monthlycost">Cost per Month</option>
                <option value="weekfrequency">Frequency per Week</option>
                <option value="monthfrequency">Frequency per Month</option>
                <option value="ingredient">Ingredient</option>
                <option selected value="rating">Rating</option>
                <option value="eatery">Eatery</option>';
        break;
    case "eatery":
        echo   '<option value="cost">Overall Cost</option>
                <option value="weeklycost">Cost per Week</option>
                <option value="monthlycost">Cost per Month</option>
                <option value="weekfrequency">Frequency per Week</option>
                <option value="monthfrequency">Frequency per Month</option>
                <option value="ingredient">Ingredient</option>
                <option value="rating">Rating</option>
                <option selected value="eatery">Eatery</option>';
        break;
}
echo '</select>';

echo '<select name="operator">';
switch ($criteria->getOperator()) {
    case "<=":
        echo '<option selected><=</option>
              <option>>=</option>
              <option>=</option>
              <option>!=</option>';
        break;
    case ">=":
        echo '<option><=</option>
              <option selected>>=</option>
              <option>=</option>
              <option>!=</option>';
        break;
    case "=":
        echo '<option><=</option>
              <option>>=</option>
              <option selected>=</option>
              <option>!=</option>';
        break;
    case "!=":
        echo '<option><=</option>
              <option>>=</option>
              <option>=</option>
              <option selected>!=</option>';
        break;
}
echo '</select>';

echo '<input type="text" name="value" maxlength="20" value="'.$criteria->getValue().'">';
echo '<input type="hidden" name="profileID" value="'.$profileID.'">';
echo '<input type="hidden" name="criteriaID" value="'.$criteriaID.'">';
echo '<input type="submit" name="submit" value="Save">';
echo '<input type="submit" name="cancel" value="Cancel">';
echo '</form>';
?>