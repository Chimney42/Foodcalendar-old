<style type="text/css">
    div#profileList, div#right { float:left;
                                width : 50%}
    div#Action { clear:both; }
</style>
<div id="Notice">
<?php
if (is_array($notifications) && !empty($notifications)) {
	foreach ($notifications as $notice) {
		echo $notice;
		echo '<br />';
	}
}
?>
</div>

<div id="profileList">
    
    <p><a href="/criteria/createprofile/"><img src="../../Icons/add.png"></a></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
            <th></th>
        </tr>

<?php
        foreach ($profiles as $profile) {
            echo '<tr>
            <td><a href="/criteria/index?id='.$profile->getID().'">'.$profile->getID().'</td>
            <td>'.$profile->getName().'</td>';
            if ($profile->getID() == $profileInfo->getID()) {
                echo '<td><a href="/criteria/editprofile?id='.$profile->getID().'"><img src="../../Icons/edit.png"></a></td>
                <td><a href="/criteria/deleteprofile?id='.$profile->getID().'"><img src="../../Icons/trash-empty.png"></a></td>';
            }
            echo '</tr>';
        }
?>  
    </table>    
</div>
    

<div id="right">


<?php
    echo '<p><form action ="/criteria/savebool?id'.$profileInfo->getID().'" method="POST">
          <input type="checkbox" name="vegetarian" value="true" ';
        if($profileInfo->getVegetarian() == 1) {
            echo 'checked';
        }
    echo '>Vegetarian ';

    echo '<input type="checkbox" name="vegan" value="true" ';
        if($profileInfo->getVegan() == 1) {
            echo 'checked';
        }
        echo '>Vegan ';

    echo '<input type="checkbox" name="lactosefree" value="true" ';
        if($profileInfo->getLactosefree() == 1) {
            echo 'checked';
        }
    echo '>Lactosefree ';

    echo '<input type="checkbox" name="glutenfree" value="true" ';
        if($profileInfo->getGlutenfree() == 1) {
            echo 'checked';
        }
    echo '>Glutenfree ';
    echo '<input type ="hidden" name="profileID" value="'.$profileInfo->getID().'">';
    echo '<input type="submit" name="submit" value="Save">';
    echo '</form></p>';


    echo '<table><tr>
            <th>ID</th>
            <th>Criterion</th>
            <th>Operator</th>
            <th>Value</th>
            <th></th>
            <th></th></tr>';

    if (!empty($criteriaList)) {
        foreach ($criteriaList as $criteria) {
            echo '<tr>
                    <td>'.$criteria->getID().'</td>
                    <td>'.$criteria->getCriterion().'</td>
                    <td>'.$criteria->getOperator().'</td>
                    <td>'.$criteria->getValue().'</td>
                    <td><a href="/criteria/editcriteria?pid='.$profileInfo->getID().'&cid='.$criteria->getID().'"><img src="../../Icons/edit.png"></a></td>
                    <td><a href="/criteria/deletecriteria?pid='.$profileInfo->getID().'&cid='.$criteria->getID().'"><img src="../../Icons/trash-empty.png"></a></td>
            </tr>';
        }
    }
    echo '</table>';

    echo '<a href="/criteria/createcriteria?id='.$profileInfo->getID().'">NEW</a>';
    echo ' ';
    echo '<a href="/criteria/addcriteria?id='.$profileInfo->getID().'">EXISTING</a>';
?>
</div>

<?php


if($action !== 'index' && !isset($_POST['submit'])) {

echo '<div id="Action">';

}
?>
