<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Manage Users</div>
        <div class="panel-body">
            <div class="col-sm-8 col-sm-offset-2">
                <form name="searchUsersForm">
                    <div class="form-group">
                        <input type="text" class="form-control" name="searchUsers" ng-model="searchUsers" id="searchUsers" placeholder="Username" title="Enter a username to search for">
                        <input type="submit" class="btn btn-block btn-primary" Value="Search for Users">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!--            <a ng-model="addUser" ui-sref="addUser" class="btn btn-primary" style="width:50%!important;height: 45px!important;">ADD NEW MEMBER<span class="glyphicon glyphicon-circle-arrow-right"></span></a>-->
<!---->
<!--<br/>-->
<!--            <br/>-->


<?php
//
///**
// * Created by PhpStorm.
// * User: DF
// * Date: 3/21/2016
// * Time: 11:07 AM
// */
//require('db.php');
//session_start();
//$data = array();
//parse_str(file_get_contents('php://inputTest'), $data);
//$_POST = array_merge($data, $_POST); // merge parsed form data with _POST session values
//if (is_string($_SESSION['test'])) { // don't run if form data has already been parsed
//$_SESSION['test'] = json_decode($_SESSION['test'], true); // decodes JSON data sent by angularJS frontend and converts to PHP associative array
//}
////var_dump($GLOBALS);
//
//$tbl_name = 'users';
//// Define $myusername and $mypassword
////$myusername = $_POST['inputUsername'];
////$mypassword = $_POST['inputPassword'];
//
////$myusername = stripslashes( $myusername ); // Stripslashes function prevents SQL injections
////$mypassword = stripslashes( $mypassword );
//
////$myusername = mysqli_real_escape_string( $mysqli, $myusername );
////$mypassword = mysqli_real_escape_string( $mysqli, $mypassword );
//$result     = $mysqli->query( "SELECT * FROM $tbl_name" );
//
//if ($mysqli->connect_errno) { // exit on connection failure
//    printf("Connect failed: %s\n", $mysqli->connect_error);
//    exit();
//}
////$row        = mysqli_fetch_assoc( $results );
//$count = mysqli_num_rows( $result );
//
//
//while($row=$result->fetch_row()) {
//
//    echo '<link rel="stylesheet" href="../assets/css/style.css">
//    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/darkly/bootstrap.css">
//
//    <table class="table table-bordered table-hover" style="column-width: 50px!important;">
//        <!----------ENVIRONMENT TASKS---------->
//        <tr style="column-width: 400px!important;">
//            <td >NAME: '.$row[0].'   ('.$row[4].')</td>
//            <td>USERNAME: ' . ($row[1]) . '</td>
//         </tr>
//    </table>
//    <button class="btn btn-block btn-primary" style="width:25%!important;">ENABLE/DISABLE</button>
//    <br/>
//    <br/>
//    ';
//}
//?>
<!--        </div></div>-->
<!---->
<!--</div>-->