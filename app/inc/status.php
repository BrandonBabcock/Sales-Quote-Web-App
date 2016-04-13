<?php
$stmt = $dbh->prepare( "
        SELECT
            admin, enabled
         FROM
            users
        WHERE
            username = {$_SESSION['username']}
    " );
$results = $stmt->fetch()
$_SESSION['admin'] =