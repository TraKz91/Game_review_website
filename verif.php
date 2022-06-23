<!--Kevin TRANG 1905670-->
<?php require_once("database.php");?>
<?php
  session_start();

if ( isset($_POST['username']) ) {
  // start the session
  // get the user details
  $link = connect();
  $user_data = get_user($link, $_POST['username']);
  // hash the submitted password
  $hashed_password = sha1( $_POST['password'] . $user_data['salt'] );
  // check the password matches
  if ($hashed_password === $user_data['pass']) {
  //include(“index.php”);
  $_SESSION['user'] = $user_data;
  } else {
  echo "password was wrong";
  }
}

?>