<?php
include_once 'connection/checkUser.php';

include_once 'database/User.php';
include_once 'database/Database.php';

include_once 'parts/header.php';

$err = '';

//Check if post back
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = User::testNew();
}

if (($_SERVER["REQUEST_METHOD"] == "POST") && empty($err)) {

    User::newUser($_POST['username'], $_POST['password'], $_POST['name'], $_POST['auth']);
    $success = 'User '.$_POST['username'].' has been created.';
    header('Location: add_user.php');
} else {
?>
<body>
<div id="wrapper">
    <?php include_once 'parts/nav.php'; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Information
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="POST"
                                  action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                                <?php if (!empty($err)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <?php echo $err ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($success)) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <?php echo $success ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label>Username:</label>
                                    <input class="form-control" name="username" type="text"
                                        <?php
                                        if(isset($_POST['username'])) {
                                            echo " value='$_POST[username]'";
                                        }
                                        ?>>
                                </div>
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input class="form-control" name="name" type="text"
                                        <?php
                                        if(isset($_POST['name'])) {
                                            echo " value='$_POST[name]'";
                                        }
                                        ?>>
                                </div>
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input class="form-control" name="password" type="password" autocomplete="off">
                                    <div id="messages"></div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password:</label>
                                    <input class="form-control" name="cpassword" type="password" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Authorization:</label>
                                    <select class="form-control" name="auth">
                                        <option value="1">Admin</option>
                                        <option value="2">Dr.</option>
                                        <option value="3">Nurse</option>
                                        <option value="4">Research</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default">Save</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<script src="js/pw_strength.js"></script>

<?php
include_once 'parts/bottom.php';
include_once 'parts/footer.php';

} ?>
