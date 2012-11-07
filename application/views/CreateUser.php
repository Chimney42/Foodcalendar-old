  <h1>Create User</h1> <br>
<form action="/user/create/" method="POST">
  	<p>Name: <input name="name" type="text" size="20" maxlength="20"></p>
	<p>Password: <input name="password" type="text" size="20" maxlength="20"></p>
	<p><input name="submit" type="submit" value="submit"></p>
</form>

<?php

if($success == true) {
	echo 'You created a new user! LOL!';
}
?>