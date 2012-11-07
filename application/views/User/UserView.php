<style type="text/css">
div#UserInfo, div#UserList { 
							float: left; 
							width: 50%; 
							}
				
div#UserDelete {
				position: absolute; 
				bottom: 100px;
				right: 60%;
				margin-bottom: 20px;
				}
</style>

<div id="tab">

	<div id="UserNotice">
	<?php
	if (is_array($notifications) && !empty($notifications)) {
		foreach ($notifications as $notice) {
			echo $notice;
			echo '<br />';
		}
	}
	?>
	</div>

<?php
echo '<div id="UserInfo">';
echo '<div><h1>ID:'.$user->getID().'</h1></div>';

$sessionURL = strpos($_SERVER['REQUEST_URI'], 'sid=');

echo '<table>';
echo '<tr>';
echo '<td>Name:</td>';
        echo '<td>';
        $edit = strpos($_SERVER['REQUEST_URI'], 'editname');
        if ($user->getID() == $_SESSION['userid'] && ($sessionURL !== false && $edit !== false)) {
            echo '<form action="/user/editname" method="POST">';
            echo '<input type="text" name="name" value="';
        }
        echo $user->getName();
        if ($user->getID() == $_SESSION['userid'] && ($edit !== false && $sessionURL !== false)) {
            echo '">';
        }
            echo '</td>';

	echo '<td>';
	if ($user->getID() == $_SESSION['userid'] && (($edit == false && $sessionURL !== false) || ($sessionURL == false && $edit !== false) || ($sessionURL == false && $edit == false))) {
		echo '<a href="/user/editname/"><img src="../../Icons/edit.png" alt="Edit"></a>';
	} elseif ($user->getID() == $_SESSION['userid'] && $edit !== false && $sessionURL !== false) {
        echo '<input type="submit" name="submit" value="Save">';
        echo '</form>';
    }
	echo '</td>';
	?>
</tr>
	
	<?php
    echo '<tr>
            <td>About me:</td>';
    echo '<td>';
    $edit = strpos($_SERVER['REQUEST_URI'], 'editdescription');
    if ($user->getID() == $_SESSION['userid'] && $sessionURL !== false && $edit !== false) {
        echo '<form action="/user/editdescription" method="POST">';
        echo '<textarea rows="10" cols="20" name="description">';
    }
    echo $user->getDescription();
    if ($user->getID() == $_SESSION['userid'] && $sessionURL !== false && $edit !== false) {
        echo '</textarea>';
    }
    echo '</td>';

    echo '<td>';
    if ($user->getID() == $_SESSION['userid'] && (($edit == false && $sessionURL !== false) || ($sessionURL == false && $edit !== false))) {
        echo '<a href="/user/editdescription"><img src="../../Icons/edit.png"></a>';
    } elseif ($user->getID() == $_SESSION['userid'] && $edit !== false && $sessionURL !== false) {
        echo '<input type="submit" name="submit" value="Save">';
        echo '</form>';
    }
    echo '</td></tr>';


    if ($user->getID() == $_SESSION['userid']) {
        echo '<tr><td>Password:</td>
            <td>*******</td>
            <td><a href="/user/editpassword"><img src="../../Icons/edit.png"></a></td>
        </tr>';
    }
    echo '</table>';
    if ($user->getID() == $_SESSION['userid']) {
    echo '<a href="/user/delete"><img src="../../Icons/trash-empty.png"></a>';
    }
?>

	</div>
	
	<div id="UserList">
	
	<div><h1>Userlist</h1></div>
	<table>
<?php
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '</tr>';
	foreach($query_output as $user){

        echo '<tr>';
		echo '<td><a href="/user/index?id='.$user->getID().'">';
		
 		echo $user->getID().'</a></td>';
		echo '<td>'.$user->getName() . '</td>';

 		echo '</tr>';
 	}
?>
        </table>
	</div>
</div>

 <?php


if($action !== 'index' && !isset($_POST['submit'])) {

	echo '<div id="UserAction" align="center">';

 }
 ?>