<?php
include_once 'connection/checkUser.php';
include_once 'database/User.php';

include_once 'parts/header.php';
?>
<body>
<div id="wrapper">
    <?php include_once 'parts/nav.php'; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User Info</h1>
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
                            <form role="form">
                                <?php
                                $results = User::getUsers();
                                $html = "<option value='' disabled selected style='display:none;'>Select user</option>";
                                foreach($results as $value)
                                {
                                    $html.= "<option value='$value[username]'>$value[username]</option>";
                                }
                                echo "<select class='form-control' id='userPick' onselect='showUser();'>$html</select>";
                                ?>
                                <br>

                                <div class="hidden" id="editUser">
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input class="form-control" name="username" type="text"
                                               placeholder="<?php echo $results[0]["username"]; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input class="form-control" name="name" type="text"
                                               placeholder="<?php echo $results[0]["name"]; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Authorization:</label>
                                        <input class="form-control" name="auth" type="text"
                                               placeholder="<?php
                                               switch($results[0]["auth"]) {
                                                   case 1:
                                                       echo "Admin";
                                                       break;
                                                   case 2:
                                                       echo "Dr.";
                                                       break;
                                                   case 3:
                                                       echo "Nurse";
                                                       break;
                                                   case 4:
                                                       echo "Research";
                                                       break;
                                               }
                                               ?>" disabled>
                                    </div>
                                    <input type=button class="btn btn-default" onClick="location='user_edit.php'"
                                           value='Edit'>
                                </div>
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

<script>
    function showUser(){
        var myselect = document.getElementById("userPick");
        document.getElementById("editUser").removeAttribute("class");
    }
</script>
<?php
include_once 'parts/bottom.php';
include_once 'parts/footer.php';
?>
