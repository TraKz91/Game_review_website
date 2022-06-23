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
<h2>Add a review</h2>
<form method="post" action="#">
		<select id="game_id" name="game_id">
  <option value="1">1.Sid Meier's Civilization V: Brave New World</option>
  <option value="2">2.Crusader Kings II</option>
  <option value="3">3.Warcraft III: Reforged</option>
  <option value="4">4.Else Heart.Break</option>
  <option value="5">5.Shadowrun: Dragonfall - Director's Cut</option>
  <option value="6">6.Stardew Valley</option>
  <option value="7">7.Disco Elysium</option>
  <option value="8">8.RimWorld"</option>
  <option value="9">9.Tom Clancy's Rainbow Six® Siege</option>
  <option value="10">10.Euro Truck Simulator 2</option>
  <option value="11">11.Farming Simulator 19</option>
  <option value="12">12.Train Simulator 2020</option>
  <option value="13">13.Project Zomboid</option>
  <option value="14">14.Shadowrun Returns</option>
  <option value="15">15.Shadowrun: Hong Kong - Extended Edition</option>
  <option value="16">16.Cave Story+</option>
  <option value="17">17.Sorcery! Parts 1 & 2</option>
  <option value="18">18.Dwarf Fortress</option>
 
</select>

		<input name="rating" placeholder="Rating out of 10"/>
		<input name="title" placeholder="Title"/>
		<br/>
		<textarea cols="120" rows="5" placeholder="Review" name="review"></textarea><br />
		<input type="submit" value="Send" />
	   </form>
	   <?php
		$link=connect();
		if (isset($_POST['game_id'])){
		save_reviews($link, $_POST, $_SESSION['user']);
		}
	   ?>

<h3>Your review</h3>
<?php
$link=connect();
if (isset($_SESSION['user'])){
	$games=get_reviews($link,$_SESSION['user']['uname']);
	foreach ($games as $game) {
		echo "Game ID : ".$game['game_id'];
		echo "<br/>";
		echo "Title : ".$game['title'];
		echo "<br/>";
		echo "Rating : ".$game['rating'];
		echo "<br/>";
		echo "Review : ".$game['review'];
		echo "<br/><br/>";
}
	}else {
		echo ' Please connect';
		return NULL;
	}
?>
<br/><br/>
<h3>Delete your review</h3>
<form method="get" action="#">
		<select id="game_id" name="delgame">
  <option value="1">1.Sid Meier's Civilization V: Brave New World</option>
  <option value="2">2.Crusader Kings II</option>
  <option value="3">3.Warcraft III: Reforged</option>
  <option value="4">4.Else Heart.Break</option>
  <option value="5">5.Shadowrun: Dragonfall - Director's Cut</option>
  <option value="6">6.Stardew Valley</option>
  <option value="7">7.Disco Elysium</option>
  <option value="8">8.RimWorld"</option>
  <option value="9">9.Tom Clancy's Rainbow Six® Siege</option>
  <option value="10">10.Euro Truck Simulator 2</option>
  <option value="11">11.Farming Simulator 19</option>
  <option value="12">12.Train Simulator 2020</option>
  <option value="13">13.Project Zomboid</option>
  <option value="14">14.Shadowrun Returns</option>
  <option value="15">15.Shadowrun: Hong Kong - Extended Edition</option>
  <option value="16">16.Cave Story+</option>
  <option value="17">17.Sorcery! Parts 1 & 2</option>
  <option value="18">18.Dwarf Fortress</option>
 
</select>
<input type="submit" value="DELETE" />
</form>
<br/><br/><br/>
<?php
$link=connect();
if (isset($_GET['delgame'])){
	delete_reviews($link, $_GET, $_SESSION['user']);
}
?>
<h3>Edit your review</h3>
<form method="post" action="#">
		<select id="gameid" name="update">
  <option value="1">1.Sid Meier's Civilization V: Brave New World</option>
  <option value="2">2.Crusader Kings II</option>
  <option value="3">3.Warcraft III: Reforged</option>
  <option value="4">4.Else Heart.Break</option>
  <option value="5">5.Shadowrun: Dragonfall - Director's Cut</option>
  <option value="6">6.Stardew Valley</option>
  <option value="7">7.Disco Elysium</option>
  <option value="8">8.RimWorld"</option>
  <option value="9">9.Tom Clancy's Rainbow Six® Siege</option>
  <option value="10">10.Euro Truck Simulator 2</option>
  <option value="11">11.Farming Simulator 19</option>
  <option value="12">12.Train Simulator 2020</option>
  <option value="13">13.Project Zomboid</option>
  <option value="14">14.Shadowrun Returns</option>
  <option value="15">15.Shadowrun: Hong Kong - Extended Edition</option>
  <option value="16">16.Cave Story+</option>
  <option value="17">17.Sorcery! Parts 1 & 2</option>
  <option value="18">18.Dwarf Fortress</option>
 
</select>
		<input name="rat" placeholder="Rating out of 10"/>
		<input name="titre" placeholder="Title"/>
		<br/>
		<textarea cols="120" rows="5" placeholder="Review" name="change"></textarea><br />
		<input type="submit" value="Edit" />
	   </form>
	   <?php
		$link=connect();
		if (isset($_POST['change'])){
		update_reviews($link, $_POST, $_SESSION['user']);
		}
	   ?>
	   
</form>
</body>