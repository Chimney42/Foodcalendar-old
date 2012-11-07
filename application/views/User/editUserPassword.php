  <h1>Edit Password</h1> <br>
<form action="/user/editpassword/" method="POST">
	<input name="ID" type="hidden" value="<?php echo $userID;?>">
	<p>Old password: <input name="oldPassword" type="password"></p>
	<p>New password: <input name="newPassword" type="password"></p>
	<p>Confirm new password: <input name="newPasswordConfirm" type="password"></p>
	<p><input name="submit" type="submit" value="submit"></p>
</form>