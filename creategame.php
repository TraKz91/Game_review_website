<!--Kevin TRANG 1905670-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="site.css">
<title>Gamemaniac</title>
</head>
<body>
<div class="topbar">
<ul>
     <li><a href="http://localhost/ce154/index.php">Home</a></li>
  <li><a href="http://localhost/ce154/games.php">Games</a></li>
  <li><a href="http://localhost/ce154/bookmarks.php">Bookmarks</a></li>
  <li><a href="http://localhost/ce154/reviews.php">Reviews</a></li>

   <label><b>Username</b></label>
				<form method="post" action="index.php">
                <input type="text" placeholder="Enter your username" name="username" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter your password" name="password" required>
				<input type="submit" id='submit' value='LOGIN' >
				</form>
				
				&nbsp;	&nbsp;	&nbsp;
<a href='logout3.php'><button type="button" value="Logout" >Logout</button></a>
&nbsp;	&nbsp;	&nbsp;
		

<?php			
include("verif.php");
error_reporting(0);
?>

 </ul>

</div>
<br/><br/><br/>
<h1><center>GAMEMANIAC21</center></h1>
<?php
if (isset($_SESSION['user'])){
echo "<center>";
echo "<h2>";
echo "<bold>";
echo "Welcome ".$_SESSION['user']['uname'];
echo "</bold>";
echo "</h2>";
echo "</center>";}
?>
<form method="GET" action="games.php">
<input type="text" placeholder="SEARCH" name="search" style="width:1820px; height:30px" >
<input type="submit" id='submit' value='Search' style=" height:36px">
</form>
<br/>

<h2>Add a game</h2>
<form method="post" action="#">
<input name="notg" placeholder="Name of the Game" style="width:300px; height:20px"/>
<input name="imag" placeholder="URL of the image" style="width:300px; height:20px"/>
<input name="genre" placeholder="Genre of the game (e.g : str/rpg...)" style="width:300px; height:20px"/>
<input name="note" placeholder="Rating" style="width:300px; height:20px"/>
		<input type="submit" value="Add" style="height:26px"/>
	   </form>
	   <?php
		$link=connect();
		if (isset($_POST['notg'])){
		save_games($link, $_POST);
		}
	   ?>