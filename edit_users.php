<?php
include_once 'connection/checkUser.php';
include_once 'database/User.php';

include_once 'parts/header.php';

$err = '';
$success = '';

//Check if post back
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = User::testEdit();
}

if (($_SERVER["REQUEST_METHOD"] == "POST") && empty($err)) {
    //User::updateUser($_POST["username"], $_POST["name"], $_POST["auth"]);
    $success = "Done!";
}
?>
<body>
<div id="wrapper">
    <?php include_once 'parts/nav.php'; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Users</h1>
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
                                <label>Select Username:</label>
                                <?php
                                $results = User::getUsers();
                                $html = "<option value='' disabled selected style='display:none;'>Select user</option>";
                                foreach ($results as $key => $value) {
                                    if(isset($_POST['form_select'])) {
                                        if ($_POST['form_select'] == $key) {
                                            $html .= "<option name='$value[username]' value='$key' selected>$value[username]</option>";
                                        } else {
                                            $html .= "<option name='$value[username]' value='$key'>$value[username]</option>";
                                        }
                                    } else {
                                        $html .= "<option name='$value[username]' value='$key'>$value[username]</option>";
                                    }
                                }
                                echo "<select class='form-control' name='form_select' onchange='showDiv(this);'>$html</select>";
                                ?>
                                <br>

                                <?php
                                foreach ($results as $key => $value) {
                                    ?>
                                    <div id="selection<?php echo $key ?>" style="display: none;">
                                        <div class="form-group">
                                            <label>Name:</label>
                                            <input class="form-control" name="name<?php echo $key; ?>" type="text"
                                                   value="<?php echo $value["name"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>New password:</label>
                                            <input class="form-control" name="newpass<?php echo $key; ?>"
                                                   type="password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm password:</label>
                                            <input class="form-control" name="confirmpass<?php echo $key; ?>"
                                                   type="password">
                                        </div>
                                        <div class="form-group">
                                            <label>Authorization:</label>
                                            <select class="form-control" name="auth<?php echo $key ?>">
                                                <option value="1" <?php if ($value["auth"] == 1) echo "selected"; ?>>
                                                    Admin
                                                </option>
                                                <option value="2" <?php if ($value["auth"] == 2) echo "selected"; ?>>
                                                    Dr.
                                                </option>
                                                <option value="3" <?php if ($value["auth"] == 3) echo "selected"; ?>>
                                                    Nurse
                                                </option>
                                                <option value="4" <?php if ($value["auth"] == 4) echo "selected"; ?>>
                                                    Research
                                                </option>
                                            </select>
                                        </div>
                                        <input type=submit class="btn btn-default" value='Save'
                                               name="submit<?php echo $key; ?>">
                                    </div>
                                    <?php
                                }
                                ?>
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


<script type="text/javascript">
    function showDiv(elem) {
        var all_elem = getElementsStartsWithId('selection');
        for (var i = 0, length = all_elem.length; i < length; i++) {
            document.getElementById('selection' + i).style.display = "none";
        }
        document.getElementById('selection' + elem.value).style.display = "block";
    }

    function getElementsStartsWithId(id) {
        var children = document.body.getElementsByTagName('*');
        var elements = [], child;
        for (var i = 0, length = children.length; i < length; i++) {
            child = children[i];
            if (child.id.substr(0, id.length) == id)
                elements.push(child);
        }
        return elements;
    }
</script>
<?php
/*if (isset($_POST['form_select'])) {
    echo "<script>";
    echo "showDiv(".$_POST['form_select'].")";
    echo "</script>";
}*/
?>

<?php
include_once 'parts/bottom.php';
include_once 'parts/footer.php';
?>
