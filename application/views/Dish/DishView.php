<style type="text/css">
div#DishList, div#DishRight {
							float: left;
							width: 50%;
							}

div#DishEatery {
				clear:both;
				}
				
div#DishInfo, div#DishIngredients {
									float: left;
									width: 50%;
									}
									
div#dishCheck, div#dishAttribute {
									float: left;
									width: 50%;
									}

div#DishAction  {
                clear: both;

  				}
</style>

	<div id="DishNotice">
	<?php
	if (is_array($notifications) && !empty($notifications)) {
		foreach ($notifications as $notice) {
			echo $notice;
			echo '<br />';
		}
	}
	?>
	</div>

<div id="DishList">

	<h1>List</h1>
    <a href="/dish/createdish/"><img src="../../Icons/add.png"></a>

    <table>
	<?php

        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Eatery</th>';
        echo '<th></th>';
        echo '</tr>';

        foreach ($dishList as $dish) {

            echo '<tr>';
            echo '<td><a href="/dish/index?id='.$dish['ID'].'">'.$dish['ID'].'</a></td>';
			echo '<td>'.$dish['1'].'</td>';
			echo '<td>'.$dish['name'].'</td>';
            if ($dish['ID'] == $dishID) {
                echo '<td><a href="/dish/deletedish?id='.$dish['ID'].'">';
                echo '<img src="../../Icons/trash-empty.png"></a></td>';
            }
        }
	?>
</table>
</div>
<div id="DishRight">
	<div id="DishUpperRight">
		<div id="DishInfo">
			<?php
			echo '<h1>' . $dishInfo->getName() . '</h1>';
			echo $dishInfo->getCost() . '�';
			echo '<br \>';
			$index = 0;
			while ($index < (int)$dishInfo->getRating()) {
				echo '<img src="../../Icons/star.png" alt ="Rating">';
				$index++;
			}
			echo '<br \>';
            echo '<table>';
            //vegetarian
			echo '<tr>';
            echo '<td>';
			echo 'vegetarian';
			echo '</td>';
			echo '<td>';
			if ($dishInfo->getVegetarian() == 1) {
				echo '<img src="../../Icons/checkbox.png" alt="yes">';
			} else {
				echo '<img src="../../Icons/checkbox-empty.png" alt="no">';
			}
			echo '</td>';
			echo '</tr>';
			
			//vegan
				
			echo '<tr>';
            echo '<td>';
			echo 'vegan';
			echo '</td>';
			
			echo '<td>';
			if ($dishInfo->getVegan() == 1) {
				echo '<img src="../../Icons/checkbox.png" alt="yes">';
			} else {
				echo '<img src="../../Icons/checkbox-empty.png" alt="no">';
			}
			echo '</tr>';
			echo '</td>';
			
			//lactosefree
				
			echo '<tr>';
            echo '<td>';
			echo 'lactosefree';
			echo '</td>';
			
			echo '<td>';
			if ($dishInfo->getLactosefree() == 1) {
				echo '<img src="../../Icons/checkbox.png" alt="yes">';
			} else {
				echo '<img src="../../Icons/checkbox-empty.png" alt="no">';
			}
			echo '</td>';
			echo '</tr>';
			
			//glutenfree
			echo '<tr>';
            echo '<td>';
			echo 'glutenfree';
			echo '</td>';
			
			echo '<td>';
			if ($dishInfo->getGlutenfree() == 1) {
				echo '<img src="../../Icons/checkbox.png" alt="yes">';
			} else {
				echo '<img src="../../Icons/checkbox-empty.png" alt="no">';
			}
			echo '</td>';
			echo '</tr>';
            echo '</table>';

            echo '<table>
            <tr><td>created by</td>
            <td><a href="/user/index?id='.$creator->getID().'">'.$creator->getName().'</a></td></tr>
            <tr><td>last edited by</td>
            <td><a href="/user/index?id='.$editor->getID().'">'.$editor->getName().'</a></tr></table>';
			
			echo '<div id="DishEdit">';
			
			echo '<a href="/dish/editdish?id=' . $dishInfo->getID() . '">';
			echo '<img src="../../Icons/edit.png" alt="Edit"></a>';
			
			echo '</div>';
			?>
			
		</div>
		
		<div id="DishIngredients">
			<h1>Ingredients</h1>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
            <?php
			if(!empty($dishIngredients)) {
				
				foreach ($dishIngredients as $ingredient) {

                    echo '<tr>';
					echo '<td>'.$ingredient['ID'].'</td>';

					echo '<td>'.$ingredient['name'].'</td>';

                    echo '<td><a href="/dish/editingredient?did='.$dishInfo->getID().'&iid='.$ingredient['ID'].'"><img src="../../Icons/edit.png"></a></td>';

                    echo '<td><a href="/dish/deleteingredient?did='.$dishInfo->getID().'&iid='.$ingredient['ID'].'"><img src="../../Icons/trash-empty.png"></a></td>';
                    echo '</tr>';
				}
			}
            echo '</table>';
            echo '<a href="/dish/createingredient?id='.$dishInfo->getID().'">';
            echo 'NEW';
            echo '</a>';

            echo '<br \>';

            echo '<a href="/dish/addingredient?id='.$dishInfo->getID().'">';
            echo 'EXISTING';
            echo '</a>';
           
			?>
		</div>
		
	</div>
    <br \><br \>
	<div id="DishEatery">
		<?php 
		echo '<h1>' . $dishEatery->getName(). '</h1>';
		echo '<div>' . $dishEatery->getDescription() . '</div>';

        echo '<a href="/dish/createeatery?id='.$dishInfo->getID().'">';
        echo 'NEW';
        echo '</a>';
        echo ' ';
        echo '<a href="/dish/addeatery?id='.$dishInfo->getID().'">';
        echo 'EXISTING';
        echo '</a>';
		?>
	</div>
</div>


<?php


if($action !== 'index' && !isset($_POST['submit'])) {

echo '<div id="DishAction" align="center">';

}
?>