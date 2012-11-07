<style type="text/css">

div#eateryList, div#eateryRight {
                                float: left;
                                width: 50%;
                                }


div#eateryAction {
                    clear: both;
}

</style>

<div id="eateryNotice">
<?php
if (is_array($notifications) && !empty($notifications)) {
	foreach ($notifications as $notice) {
		echo $notice;
		echo '<br />';
	}
}
?>
</div>

<div id="eateryList">
    <h1>List</h1>
    <br \>

    <a href="/eatery/createeatery/"><img src="../../Icons/add.png"></a>
    <br \>
<?php

    echo '<table>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Name</th>';
    echo '<th></th>';
    echo '</tr>';

    foreach ($eateries as $eatery) {

        echo '<tr>';
        echo '<td><a href="/eatery/index?id='.$eatery->getID().'">'.$eatery->getID().'</a></td>';
        echo '<td>'.$eatery->getName().'</td>';
        if ($eatery->getID() == $eateryInfo->getID()) {
            echo '<td><a href="/eatery/deleteeatery?id='.$eatery->getID().'"><img src="../../Icons/trash-empty.png"></a></td>';
        }
        echo '</tr>';
    }
    echo '</table>'
?></div>
<div id="eateryRight">
    <div id="eateryInfo">
        <?php
            echo '<h1>'.$eateryInfo->getName().'</h1>';

            echo '<br \>';

            echo $eateryInfo->getDescription();

            echo '<div>';

            echo '<br \>';

            echo '<a href="/eatery/editeatery?id='.$eateryInfo->getID().'"><img src="../../Icons/edit.png"></a>';

            echo '</div>';
        ?>
    </div>
    <div id="eateryDishes">

        <h1>Dishes</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Cost</th>
                <th>Rating</th>
                <th>Vegetarian</th>
                <th>Vegan</th>
                <th>Lactosefree</th>
                <th>Glutenfree</th>
                <th></th>
            </tr>
        <?php

            foreach ($eateryDishes as $dish) {

                echo '<tr>';
                echo '<td>'.$dish->getID().'</td>';

                echo '<td>'.$dish->getName().'</td>';

                echo '<td>'.$dish->getCost().'€</td>';

                echo '<td>'.$dish->getRating().'/5</td>';

                if ($dish->getVegetarian() == 1) {
                    echo '<td>x</td>';
                } else {
                    echo '<td></td>';
                }

                if ($dish->getVegan() == 1) {
                    echo '<td>x</td>';
                } else {
                    echo '<td></td>';
                }

                if ($dish->getLactosefree() == 1) {
                    echo '<td>x</td>';
                } else {
                    echo '<td></td>';
                }

                if ($dish->getGlutenfree() == 1) {
                    echo '<td>x</td>';
                } else {
                    echo '<td></td>';
                }

                echo '<td><a href="/eatery/deletedish?eid='.$eateryInfo->getID().'&did='.$dish->getID().'"><img src="../../Icons/trash-empty.png"></a></td>';

                echo '</tr>';
            }

       
        echo '</table>';
        
        echo '<a href="/eatery/createdish?id='.$eateryInfo->getID().'">NEW</a>';
            echo ' ';
        echo '<a href="/eatery/adddish?id='.$eateryInfo->getID().'">EXISTING</a>';

            
            
            ?>
    </div>
</div>
<br \>
<br \>
<?php


if($action !== 'index' && !isset($_POST['submit'])) {

echo '<div id="eateryAction">';

}
?>