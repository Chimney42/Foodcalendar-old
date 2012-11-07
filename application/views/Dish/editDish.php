  <h1>Edit Dish Information</h1> <br>
<form action="/dish/editdish/" method="POST">
	<input name="dishID" type="hidden" value="<?php echo $dish->getID(); ?>">
	<input name="eateryID" type="hidden" value="<?php echo $dish->getEateryID(); ?>">
	<p>Name: <input name="name" type="text" maxlength="20" value="<?php echo $dish->getName(); ?>"></p>
		
	<p>Cost: <input name="costEuro" type="text" maxlength="5" value="<?php echo $dishCost[0]; ?>">,
				<input name="costCent" type="text" maxlength="2" value="<?php echo $dishCost[1]; ?>"> �</p>
	<p>Rating: <select name="rating" size="5">
					<?php
					switch($dish->getRating()) {
						
						case 1:
							echo '<option selected>1</option>';
							echo '<option>2</option>';
							echo '<option>3</option>';
							echo '<option>4</option>';
							echo '<option>5</option>';
							break;
						
						case 2:
							echo '<option>1</option>';
							echo '<option selected>2</option>';
							echo '<option>3</option>';
							echo '<option>4</option>';
							echo '<option>5</option>';
							break;
						
						case 3:
							echo '<option>1</option>';
							echo '<option>2</option>';
							echo '<option selected>3</option>';
							echo '<option>4</option>';
							echo '<option>5</option>';
							break;
						
						case 4:
							echo '<option>1</option>';
							echo '<option>2</option>';
							echo '<option>3</option>';
							echo '<option selected>4</option>';
							echo '<option>5</option>';
							break;
						
						case 5:
							echo '<option>1</option>';
							echo '<option>2</option>';
							echo '<option>3</option>';
							echo '<option>4</option>';
							echo '<option selected>5</option>';
							break;
					}
					?>

				</select></p>

	<p><input name="vegetarian" type="checkbox" value="true"
					<?php 
					if ($dish->getVegetarian() == 1) {
						echo 'checked';
					}
					?>>Vegetarian</p>
	<p><input name="vegan" type="checkbox" value="true"
					<?php 
					if ($dish->getVegan() == 1) {
						echo 'checked';
					}
					?>>Vegan</p>
	<p><input name="lactosefree" type="checkbox" value="true"
					<?php 
					if ($dish->getLactosefree() == 1) {
						echo 'checked';
					}
					?>>Lactosefree</p>
	<p><input name="glutenfree" type="checkbox" value="true"
					<?php 
					if ($dish->getGlutenfree() == 1) {
						echo 'checked';
					}
					?>>Glutenfree</p>
	
	<p><input type="hidden" name="created" value="<?php echo $dish->getCreated(); ?>"></p>
    <p><input name="submit" type="submit" value="Save">
    <input name="cancel" type="submit" value="Cancel"></p>
</form>