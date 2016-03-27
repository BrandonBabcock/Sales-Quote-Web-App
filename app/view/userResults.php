<?php
require( '../db.php' );
session_start();
echo
'<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../app/index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="../app/logout.php" class="btn btn-primary">Log Out</a>
</div>';
$rec_limit = 10;

/* Get total number of records */
$sql    = "SELECT count(username) FROM users ";
$retval = $mysqli->query( $sql );

$row       = mysqli_fetch_row( $retval );
$rec_count = $row[0];

if ( isset( $_GET{'page'} ) ) {
	$page   = $_GET{'page'} + 1;
	$offset = $rec_limit * $page;
} else {
	$page   = 0;
	$offset = 0;
}

$left_rec = $rec_count - ( $page * $rec_limit );
$searchValue = $_SESSION['lastsearch'];
$sql      = "SELECT username, admin " .
            "FROM users " .
            "WHERE username LIKE '%$searchValue%'" .
            "LIMIT $offset, $rec_limit";

$retval = $mysqli->query( $sql );

while ( $row = mysqli_fetch_assoc( $retval ) ) {
	echo "Username :{$row['username']}  <br> " .
	     "Administrator : {$row['admin']} <br> " .
	     "--------------------------------<br>";
}
$PHP_SELF = &$_SERVER['PHP_SELF'];
if ( $page > 0 ) {
	$last = $page - 2;
	echo "<a href = \"index.php#/userResults?page = $last\">Last 10 Records</a> |";
	echo "<a href = \"index.php#/userResults?page = $page\">Next 10 Records</a>";
} else if ( $page == 0 ) {
	echo "<a href = \"index.php#/userResults?page = $page\">Next 10 Records</a>";
} else if ( $left_rec < $rec_limit ) {
	$last = $page - 2;
	echo "<a href = \"index.php#/userResults?page = $last\">Last 10 Records</a>";
}
?>