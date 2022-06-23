<?php
// Provided by Joseph Walton-Rivers for ce154

/**
 * This script is used for connecting to databases
 */

// there are oo and procdural interfaces, we're using the OO interface.
// oh yeah... PHP supports classes.

// could use seperate variables here to.
$db = array();

// CHANGE THESE TO MATCH YOUR SETUP!
$db['host'] = "localhost";
$db['user'] = "root";
$db['pass'] = "";
$db['name'] = "ce154";

/**
 * Function to connect to the database
 */
function connect(){
    global $db;
    $link = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
    if  ($link->connect_errno) {
        die("Failed to connect to MySQL: " . $link->connect_error);
    }

    return $link;
}

function get_messages($link) {
    $records = array();

    $results = $link->query("SELECT * FROM message");

    // didn't work? return no results
    if ( !$results ) {
        return records;
    }

    while ( $row = $results->fetch_assoc() ) {
        $records[] = $row;
    }
    
    return $records;
}

function list_games($link) {
    $records = array();

    $results = $link->query("SELECT * FROM games");

    // didn't work? return no results
    if ( !$results ) {
        return records;
    }

    while ( $row = $results->fetch_assoc() ) {
        $records[] = $row;
    }
    
    return $records;
}

function save_message($link, $data) {
    // prepared statemenets = no sql injection \o/

    // first we create the statement
    $stmt = $link->prepare("insert into message(name, email, reason, message) values (?,?,?,?)");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("ssis", $data['name'], $data['email'], $data['reason'], $data['message']);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }

    // you can also alter data and call execute again to send another message...
}

function get_user($link, $user){
	$stmt = $link->prepare(" SELECT * FROM users WHERE uname = ?");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("s", $user);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }
	
	$results = $stmt->get_result();

    // didn't work? return no results
    if ( !$results ) {
        return NULL;
    }

    if ( $row = $results->fetch_assoc() ) {
        return $row;
    }
    
    return NULL;
}

function get_filter($link, $user){
	$stmt = $link->prepare(" SELECT * FROM games WHERE genre = ?");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("s", $user);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }
	
	$results = $stmt->get_result();

    // didn't work? return no results
    if ( !$results ) {
        return NULL;
    }

    //if ( $row = $results->fetch_assoc() ) {
    //    return $row;
    //}
    $records = array();
	 while ( $row = $results->fetch_assoc() ) {
        $records[] = $row;
    }
    return $records;
}

function save_reviews($link, $data, $user) {
    // prepared statemenets = no sql injection \o/

    // first we create the statement
    $stmt = $link->prepare("insert into reviews(user_id, game_id, rating, title, review) values (?,?,?,?,?)");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("iiiss", $user['id'], $data['game_id'], $data['rating'], $data['title'], $data['review']);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }

    // you can also alter data and call execute again to send another message...
}

function get_reviews($link,$user) {
    $records = array();

    $stmt = $link->prepare("SELECT * FROM reviews where user_id IN (SELECT id FROM users WHERE uname = ? )");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("s", $user);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }
	
	$results = $stmt->get_result();

    // didn't work? return no results
    if ( !$results ) {
        return NULL;
    }
	
	$records = array();
	 while ( $row = $results->fetch_assoc() ) {
        $records[] = $row;
    }
	
    return $records;
}
function get_search($link,$user) {
    $records = array();

    $stmt = $link->prepare("SELECT * FROM games WHERE title like ? ");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
	$user="%$user%";
    $result = $stmt->bind_param("s", $user);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }
	
	$results = $stmt->get_result();

    // didn't work? return no results
    if ( !$results ) {
        return NULL;
    }
	
	$records = array();
	 while ( $row = $results->fetch_assoc() ) {
        $records[] = $row;
    }
	
    return $records;
}

function get_bookmarks($link,$user) {
    $records = array();

    $stmt = $link->prepare("SELECT * FROM games where id IN (SELECT game_id FROM bookmarks WHERE user_id = ? ) ");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("i", $user);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }
	
	$results = $stmt->get_result();

    // didn't work? return no results
    if ( !$results ) {
        return NULL;
    }
	
	$records = array();
	 while ( $row = $results->fetch_assoc() ) {
        $records[] = $row;
    }
	
    return $records;
}

function save_bookmarks($link, $data, $user) {
    // prepared statemenets = no sql injection \o/

    // first we create the statement
    $stmt = $link->prepare("insert into bookmarks(user_id, game_id) values (?,?)");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("ii", $user['id'], $data['bkmk']);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }

    // you can also alter data and call execute again to send another message...
}

function get_info($link,$user) {
    $records = array();

    $stmt = $link->prepare("SELECT * FROM games where id = ? ");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("i", $user);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }
	
	$results = $stmt->get_result();

    // didn't work? return no results
    if ( !$results ) {
        return NULL;
    }
	
	$records = array();
	 while ( $row = $results->fetch_assoc() ) {
        $records[] = $row;
    }
	
    return $records;
}

function give_reviews($link,$user) {
    $records = array();

    $stmt = $link->prepare("SELECT * FROM reviews where game_id = ?");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("s", $user);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }
	
	$results = $stmt->get_result();

    // didn't work? return no results
    if ( !$results ) {
        return NULL;
    }
	
	$records = array();
	 while ( $row = $results->fetch_assoc() ) {
        $records[] = $row;
    }
	
    return $records;
}

function update_reviews($link, $data, $user) {
    // prepared statemenets = no sql injection \o/

    // first we create the statement
    $stmt = $link->prepare("update reviews SET rating = ?, title = ?, review = ? WHERE user_id = ? and game_id = ?");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
	$result = $stmt->bind_param("iiiss",$user['id'], $data['gameid'], $data['rat'], $data['titre'], $data['change']);
  
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }

    // you can also alter data and call execute again to send another message...
}

function delete_reviews($link, $data, $user) {
    // prepared statemenets = no sql injection \o/

    // first we create the statement
    $stmt = $link->prepare("delete from reviews where user_id = ? and game_id = ? ");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("ii", $user['id'], $data['delgame']);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }

    // you can also alter data and call execute again to send another message...
}

function trend_games($link) {
    $records = array();

    $results = $link->query("SELECT * FROM games WHERE genre = 'sim'");

    // didn't work? return no results
    if ( !$results ) {
        return records;
    }

    while ( $row = $results->fetch_assoc() ) {
        $records[] = $row;
    }
    
    return $records;
}
function save_games($link, $data) {
    // prepared statemenets = no sql injection \o/

    // first we create the statement
    $stmt = $link->prepare("insert into games(title, image, genre, rating) values (?,?,?,?)");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("sssi",$data['notg'],$data['imag'], $data['genre'], $data['note']);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }

    // you can also alter data and call execute again to send another message...
}

function delete_bookmarks($link, $data, $user) {
    // prepared statemenets = no sql injection \o/

    // first we create the statement
    $stmt = $link->prepare("delete from bookmarks where user_id = ? and game_id = ? ");
    if ( !$stmt ) {
        die("could not prepare statement: " . $link->errno . ", error: " . $link->error);
    }

    // then we bind the parameters
    // s = string, i = integer
    $result = $stmt->bind_param("ii", $user['id'], $data['sbkmk']);
    if ( !$result ) {
        die("could not bind params: " . $stmt->error);
    }

    // finally, execute
    if ( !$stmt->execute() ) {
        die("couldn't execute statement");
    }

    // you can also alter data and call execute again to send another message...
}
?>
