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
<?php
include("verif.php");
error_reporting(0);
?> 
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
</form>
 </ul>
</div>
<br/><br/><br/>
<h1><center>GAMEMANIAC21</center></h1>
<?php
if (isset($_SESSION['user'])){
echo "<center><h2><bold>Welcome ".$_SESSION['user']['uname']."</bold></h2></center>";}
?>
<form method="GET" action="index.php">
<input type="text" placeholder="SEARCH" name="search" style="width:1835px; height:30px" >
<input type="submit" id='submit' value='Search' style="height:36px">
</form>
<br/>
<?php
	
	$link=connect();
	if ($_SESSION['user']['is_admin']=="1"){
	echo '<a href="http://localhost/ce154/creategame.php"><button>Add a game</button></a>';
	echo '<br/>';}
	else{
	echo'';}

?>
<h2><center>Trending games</center></h2>
<?php
	$link = connect();
	
	if (isset($_GET['search'])){
		$games = get_search($link, $_GET['search']);
	} else {
		$games = trend_games($link);
	}
	
	
	foreach ($games as $game) {
		echo "<a href=\"details.php?file=".$game['id']."\"><img src=\"".$game['image']."\" alt=\"".$game['title']."\"></a>";
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		
	}

?>
</body>