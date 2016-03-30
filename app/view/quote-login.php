<?php
session_start();
if ( !isset( $_SESSION['username'] ) ) { // make sure user is logged in
    header( "location:index.php" );
    exit(6);
}
echo '
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h4>SALES QUOTE WEB APPLICATION</h4></div>
            <div class="panel-body">
                <div class="col-lg-4 col-lg-offset-4">
                    <form class="form-horizontal" method="post" action="auth.php" title="Login">
                        <fieldset>
                            <div class="form-group-single">
                                <label for="inputUsername" class="control-label">Username</label>
                                <div class="">
                                    <input type="text" class="form-control" name="inputUsername" id="inputUsername" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-group-single">
                                <label for="inputPassword" class="control-label">Password</label>
                                <div class="">
                                    <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
                                </div>
                            </div>
                        </fieldset>
                        <br />
                        <input type="submit" class="btn btn-primary col-lg-4 col-lg-offset-4" Value="Login">
                     </form>
                </div>
            </div>
    </div>
</div>
';
?>