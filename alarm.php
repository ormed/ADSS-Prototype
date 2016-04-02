<?php
include_once 'connection/checkUser.php';
include_once 'database/Notification.php';

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
else {

    $results = Notification::getNotifications();

?>
    <body>
    <div id="wrapper">
        <?php include_once 'parts/nav.php'; ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Alerts</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <form role="form" method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bell fa-fw"></i> Recent Events List
                            </div>
                            <!-- /.panel-heading -->

                            <div class="panel-body">
                                <div class="list-group">

                                    <button
                                        type="button" class="btn btn-success btn-success btn-xs" onclick="window.location='new_alarm.php'">Add New Alarm
                                    </button>
                                    </br></br>

                                    <!-- Search an alert - Auto complete -->
                                    <input type="text" name="srchAlert" id="srchAlert" list="datalist1" class="form-control" placeholder="Search">
                                    <datalist id="datalist1">
                                        <option value="First Alert">
                                    </datalist>

                                    </br>

                                    <?php
                                    foreach ($results as $value) {
                                    ?>
                                    <a href="#" class="list-group-item" id="<?php echo $value['id'];?>">
                                        <button type="button" class="btn btn-warning btn-warning btn-xs"><i
                                                class="fa fa-pencil-square-o" onclick="editAlert(1)"></i>Edit
                                        </button>
                                        First Alert <em>by Dr X</em>
                                    <span class="pull-right text-muted small"><em>4 minutes ago </em><button
                                            type="button" class="btn btn-danger btn-danger btn-xs" onclick="areYouSure(1)"><i
                                                class="fa fa-times"></i>Delete
                                        </button>
                                    </span>
                                    </a>
                                    <?php
                                    }
                                    ?>

                                    <!-- Edit alert
                                    <a href="#" class="list-group-item" id="1edit">
                                        <button type="button" class="btn btn-warning btn-warning btn-xs"><i
                                                class="fa fa-pencil-square-o" onclick="editAlert(1)"></i>Edit
                                        </button>
                                        <input type="text" id="1desc"> <em>By X</em>
                                        <button type="button" class="btn btn-warning btn-warning btn-xs" onclick="saveChanges(1)">Save
                                        </button>
                                        <button type="button" class="btn btn-warning btn-warning btn-xs" onclick="cancelChanges(1)">Cancel
                                        </button>
                                    <span class="pull-right text-muted small"><em>4 minutes ago </em><button
                                            type="button" class="btn btn-danger btn-danger btn-xs" onclick="areYouSure(1)"><i
                                                class="fa fa-times"></i>Delete
                                        </button>
                                    </span>
                                    </a>-->
                                </div>

                                <!-- /.list-group -->
                                <!--<a href="#" class="btn btn-default btn-block">View All Alerts</a>-->
                            </div>
                            <!-- /.panel-body -->

                            <span id="demo"></span>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
            </form>

                </div>
            </div>

        <?php
        include_once 'parts/bottom.php';
        ?>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });

            function areYouSure(index) {
                var x = " Removed alert #" + index;
                if (confirm("Are you sure?") == true) {
                    document.getElementById(index).remove();
                }
                document.getElementById("demo").innerHTML = x;
            }

            function editAlert(index) {
            jQuery.ajax({
                    type: "POST",
                    url: 'your_functions_address.php',
                    dataType: 'json',
                    data: {functionname: 'add', arguments: [1, 2]},

                    success: function (obj, textstatus) {
                                  if( !('error' in obj) ) {
                                      yourVariable = obj.result;
                                  }
                                  else {
                                      console.log(obj.error);
                                  }
                            }
                });
                document.getElementById(index).remove();
                document.getElementById(index+"edit").remove();
            }

            function saveChanges(index) {
                // Save the new text
                document.getElementById(index).value =
                // Make it visible

                // Make the edit invisible
                document.getElementById("1desc").value = "Test";
            }

            function cancelChanges(index) {

            }
        </script>

    </body>
</html>
<?php
}
?>
