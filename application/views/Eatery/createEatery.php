<h1>Create new Eatery</h1>

    You want to create a new Eatery!

<form action="/eatery/createeatery" method="POST">
<table>
    <tr><td>Name:</td><td><input type="text" name="name" maxlength="20"></td></tr>
    <tr><td>Description:</td><td><textarea name="description" cols="30" rows ="5"></textarea></td></tr>
</table>
    <input type="submit" name="submit" value="Create">
    <input type="submit" name="cancel" value="Cancel">

</form>