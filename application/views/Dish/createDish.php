  <h1>Create New Dish</h1> <br>
<form action="/dish/createdish/" method="POST">
	<p>Name: <input name="dishName" type="text" maxlength="20"></p>
	<p>Cost: <input name="dishCostEuro" type="text" maxlength="5">,
				<input name="dishCostCent" type="text" maxlength="2"> �</p>
	<p>Rating: <select name="dishRating" size="5">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				</select></p>
    
    <p>Eatery: <select name="eateryID">
        <?php
            foreach ($eateries as $eatery) {

                echo '<option value="'.$eatery->getID().'">'.$eatery->getName().'</option>';

            }
        ?>

    </select></p>

	<p><input name="dishVegetarian" type="checkbox" value="true">Vegetarian</p>
	<p><input name="dishVegan" type="checkbox" value="true">Vegan</p>
	<p><input name="dishLactosefree" type="checkbox" value="true">Lactosefree</p>
	<p><input name="dishGlutenfree" type="checkbox" value="true">Glutenfree</p>
	
	<p><input name="submit" type="submit" value="Create">
    <input name="cancel" type="submit" value="Cancel"</p>
</form>