<?php
require('../../../database/db.php');
session_start();
if (!isset($_SESSION['username'])) { // make sure user is logged in
	echo '<script type="text/javascript">
        alert ("Access Denied");
        window.location = "../../shared/redirect.php/#login";
        </script>';
    exit(6);
}
require("../../shared/status.php");
if ($_SESSION['enabled'] != 'true') { // non-enabled account tried to access page
	echo '<script type="text/javascript">
        alert ("Access Denied");
        window.location.href = "../../shared/redirect.php";
        </script>';
    exit(5);
}
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
	echo '<script type="text/javascript">
        alert ("Access Denied");
        window.location.href = "../../shared/redirect.php";
        </script>';
	exit(5);
}
$data = array();
parse_str( file_get_contents( 'php://input' ), $data );
$_POST = array_merge( $data, $_POST ); // merge parsed login data with _POST session values
$_SESSION['lastsearch'] = mysqli_real_escape_string($mysqli, $_POST['searchUsers']);

echo
'
    <head>
        <title>Sales Quote</title>
        <meta charset="UTF-8">

        <!-- Link stylesheets -->
        <!-- Documentation for second style sheet: https://bootswatch.com/darkly/ -->
	    <link rel="stylesheet" href="../../../assets/css/custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/darkly/bootstrap.min.css">

        <!-- Load in Global Dependencies -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.18/angular-ui-router.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular-animate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.5.5/angular-messages.min.js"></script>

        <!-- Load in main application -->
        <script src="../../app.js"></script>
        <script src="../../app.routes.js"></script>
        <script src="../../generate-quote/generate-quote.controller.js"></script>
        <script src="../manage-users.controller.js"></script>

    </head> <body ng-app="salesQuoteApp">
<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../../../index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="../../shared/logout.php" class="btn btn-primary">Log Out</a>
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
	echo '<div class="container">
    	<div class="panel panel-default">
        <div class="panel-heading text-center">Manage Users</div>
        <div class="panel-body">

			<p align="center">Click on a Username to edit the user.</p>
            <table class="table table-bordered table-hover">
            <tr>
            	<th>Username</th>
            	<th>Administrator Status</th>
            	<th>Enabled/Disabled</th>
            </tr>';

	// Prepare the paged query
	$stmt = $dbh->prepare( "
        SELECT 
            username, admin, enabled 
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
            echo '<td><a href="edit-user.php?user=' . $row['username'] . '">' . $row['username'] . '</a></td>' ;
            echo '<td>'. $row['admin']. '</td>';
            echo '<td>' . $row['enabled'] . '</td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '
			<div align="center" id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';
	}
	else {
		echo '<p>No results matched your search query.</p>';
	}
} catch ( Exception $e ) {
	echo '<p>', $e->getMessage(), '</p>';
}

echo '
</div>
</div>
</body>
';
?>