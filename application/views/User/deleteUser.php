<h1>Delete User</h1> <br>
<form action="/user/delete/" method="POST">
	<input name="ID" type="hidden" value="<?php echo $userID;?>">
	<p>Password: <input name="password" type="password" size="20" maxlength="20"></p>
	<p><input name="submit" type="submit" value="submit"></p>
</form>