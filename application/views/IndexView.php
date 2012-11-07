<style type="text/css">
    div#left, div#right { float: left;
                            width: 50%;}
    div#Register { margin-top: 100px;
                                }

</style>

<h1>FoodCalendar!</h1>

<div id="left">
    <div id="LogIn">
        <h3>Log In</h3>
        <form action="/index/login" method="POST">
            <table>
            <tr><td>Name:</td><td><input type="text" name="name" maxlength="20"></td></tr>
            <tr><td>Password:</td><td><input type="password" name="password"></td></tr>
            </table>
            <p><input type="submit" name="submit" value="Log In"></p>
        </form>
    </div>
    <div id="Register">
        <h3>Sign Up</h3>
        <form action="index/register" method="POST">
            <table>
            <tr><td>Name:</td><td><input type="text" name="name" maxlength="20"></td></tr>
            <tr><td>Password:</td><td><input type="password" name="password"></td></tr>
            </table>
            <p><input type="submit" name="submit" value="Register" /></p>
        </form>
    </div>
</div>

<div id="right">
<img src="../../Gaensemarkt.jpg">
<p>photo by Thomas Kohler 2008 - (cc)licensed</p>
</div>