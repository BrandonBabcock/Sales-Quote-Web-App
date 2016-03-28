<?php
require( '../db.php' );
session_start();
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
	header('location:index.php');
	exit(5);
}
echo
'
    <head>
        <title>Sales Quote</title>
        <meta charset="UTF-8">

        <!-- Link stylesheets -->
        <!-- Documentation for second style sheet: https://bootswatch.com/darkly/ -->
	    <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/darkly/bootstrap.css">
     </head>
<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="../logout.php" class="btn btn-primary">Log Out</a>
</div>';
$searchValue = $_SESSION['lastsearch'];

try {

	// Find out how many items are in the table
	$total = $dbh->query( "
        SELECT count(username) FROM users WHERE username LIKE '%$searchValue%'
    " )->fetchColumn();

	// How many items to list per page
	$limit = 10;

	// How many pages will there be
	$pages = ceil( $total / $limit );

	// What page are we currently on?
	$page = min( $pages, filter_input( INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
		'options' => array(
			'default'   => 1,
			'min_range' => 1,
		),
	) ) );

	// Calculate the offset for the query
	$offset = ( $page - 1 ) * $limit;

	// Some information to display to the user
	$start = $offset + 1;
	$end   = min( ( $offset + $limit ), $total );

	// The "back" link
	$prevlink = ( $page > 1 ) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ( $page - 1 ) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

	// The "forward" link
	$nextlink = ( $page < $pages ) ? '<a href="?page=' . ( $page + 1 ) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

	// Display the paging information
	echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div><div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Manage Users</div>
        <div class="panel-body">

            <table class="table table-bordered table-hover">';

	// Prepare the paged query
	$stmt = $dbh->prepare( "
        SELECT 
            username, admin 
         FROM 
            users 
        WHERE 
            username LIKE '%$searchValue%'
        ORDER BY
            username
        LIMIT
            :limit
        OFFSET
            :offset
    " );

	// Bind the query params
	$stmt->bindParam( ':limit', $limit, PDO::PARAM_INT );
	$stmt->bindParam( ':offset', $offset, PDO::PARAM_INT );
	$stmt->execute();

	// Do we have any results?
	if ( $stmt->rowCount() > 0 ) {
		// Define how we want to fetch the results
		$stmt->setFetchMode( PDO::FETCH_ASSOC );
		$iterator = new IteratorIterator( $stmt );
		// Display the results
		foreach ( $iterator as $row ) {
			echo '<tr>';
            echo '<th ng-model="' . $row['username'] . '">Username: ' . $row['username'] . '</th>' ;
            echo '<th>Administrator: ', $row['admin'], '</th>';
			echo '</tr>';
		}
		echo '       </div>
    </div>
</div>';

	} else {
		echo '<p>No results matched your search query.</p>';
	}
} catch ( Exception $e ) {
	echo '<p>', $e->getMessage(), '</p>';
}
?>