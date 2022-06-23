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
				<form method="post" action="games.php">
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
<input type="text" placeholder="SEARCH" name="search" style="width:1835px; height:30px" >
<input type="submit" id='submit' value='Search' style=" height:36px" >
</form>
<br/>

<?php
	$link = connect();
	if (get_bookmarks($link,$_SESSION['user'])){
		$games = get_bookmarks($link, $_SESSION['user']);
		foreach ($games as $game) {
		echo "<a href=\"details.php?file=".$game['id']."\"><img src=\"".$game['image']."\" alt=\"".$game['title']."\"></a>";
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	}else {
		echo "<h2>Please login to see your bookmarks</h2>";
		return NULL;
	}


	
?>

<form method="post" action="#">
		<select id="Game" name="bkmk">
  <option value="1">Sid Meier's Civilization V: Brave New World</option>
  <option value="2">Crusader Kings II</option>
  <option value="3">Warcraft III: Reforged</option>
  <option value="4">Else Heart.Break</option>
  <option value="5">Shadowrun: Dragonfall - Director's Cut</option>
  <option value="6">Stardew Valley</option>
  <option value="7">Disco Elysium</option>
  <option value="8">RimWorld"</option>
  <option value="9">Tom Clancy's Rainbow Six® Siege</option>
  <option value="10">Euro Truck Simulator 2</option>
  <option value="11">Farming Simulator 19</option>
  <option value="12">Train Simulator 2020</option>
  <option value="13">Project Zomboid</option>
  <option value="14">Shadowrun Returns</option>
  <option value="15">Shadowrun: Hong Kong - Extended Edition</option>
  <option value="16">Cave Story+</option>
  <option value="17">Sorcery! Parts 1 & 2</option>
  <option value="18">Dwarf Fortress</option>
</select>
             
				<input type="submit" value='Save' >
				</form>
<?php
		$link=connect();
		if (isset($_POST['bkmk'])){
		save_bookmarks($link, $_POST, $_SESSION['user']);
		}
		?>
<br/>	  
<form method="GET" action="#">
		<select id="Game" name="sbkmk">
  <option value="1">Sid Meier's Civilization V: Brave New World</option>
  <option value="2">Crusader Kings II</option>
  <option value="3">Warcraft III: Reforged</option>
  <option value="4">Else Heart.Break</option>
  <option value="5">Shadowrun: Dragonfall - Director's Cut</option>
  <option value="6">Stardew Valley</option>
  <option value="7">Disco Elysium</option>
  <option value="8">RimWorld"</option>
  <option value="9">Tom Clancy's Rainbow Six® Siege</option>
  <option value="10">Euro Truck Simulator 2</option>
  <option value="11">Farming Simulator 19</option>
  <option value="12">Train Simulator 2020</option>
  <option value="13">Project Zomboid</option>
  <option value="14">Shadowrun Returns</option>
  <option value="15">Shadowrun: Hong Kong - Extended Edition</option>
  <option value="16">Cave Story+</option>
  <option value="17">Sorcery! Parts 1 & 2</option>
  <option value="18">Dwarf Fortress</option>
</select>
             
				<input type="submit" value='Delete' >
				</form>	  
				
<?php
$link=connect();
if (isset($_GET['sbkmk'])){
	delete_bookmarks($link, $_GET, $_SESSION['user']);
}
?>				
</body>