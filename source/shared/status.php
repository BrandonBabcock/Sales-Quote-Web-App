<?php
// This file updates a user's session with whether or not they still have admin privileges and if their account is enabled
require_once(__DIR__ . '/../../database/db.php');
$stmt = $dbh->prepare( "
        SELECT
            admin, enabled
         FROM
            users
        WHERE
            username = :user
    " );
$stmt->bindParam(":user", $_SESSION['username']);
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['admin'] = $results['admin'];
$_SESSION['enabled'] = $results['enabled'];