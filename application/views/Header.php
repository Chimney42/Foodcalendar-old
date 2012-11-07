<!DOCTYPE html>
<style type="text/css">
div#outer { margin-top : 20px; 
			margin-left : 10px;
			}

div#inner { clear:both;
            margin-top : 20px;
			margin-left : 10px;
			}
div#header, div#logout {float:left}
div#logout { position: absolute;
            margin-left: 1600px; }
</style>
<html>
	<head>
		<title>
			FoodCalendar YAY!
		</title>
	</head>
	<body>
		<div id="outer">
            <?php
            if (isset($_SESSION['login'])) {
			    echo '<div id="header">
				    <a href="/calendar/index">Calendar</a>
    				<a href="/dish/index">Dish</a>
	    			<a href="/eatery/index">Eatery</a>
		    		<a href="/criteria/index">Criteria</a>
			    	<a href="/user/index">User</a>
			    </div>
                <div id="logout">
                    <a href="/index/logout"><img src="../../Icons/logout.png"></a>
                </div>';
            }
?>
			<div id="inner">