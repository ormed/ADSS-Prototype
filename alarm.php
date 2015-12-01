<?php
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

                                    <!-- Search an alert - Auto complete -->
                                    <input type="text" name="srchAlert" id="srchAlert" list="datalist1" class="form-control" placeholder="Search">
                                    <datalist id="datalist1">
                                        <option value="First Alert">
                                        <option value="Second Alert">
                                        <option value="Third Alert">
                                        <option value="4th Alert">
                                    </datalist>

                                    <a href="#" class="list-group-item" id="1">
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

                                    <!-- Edit alert -->
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
                                    </a>

                                    <a href="#" class="list-group-item" id="2">
                                        <button type="button" class="btn btn-warning btn-warning btn-xs"><i
                                                class="fa fa-pencil-square-o" onclick="editAlert(2)"></i>Edit
                                        </button>
                                        Second Alert <em>by Dr Y</em>
                                    <span class="pull-right text-muted small"><em>12 minutes ago </em>
                                        <button type="button" class="btn btn-danger btn-danger btn-xs" onclick="areYouSure(2)"><i
                                                class="fa fa-times"></i>Delete
                                        </button>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item" id="3">
                                        <button type="submit" class="btn btn-warning btn-warning btn-xs"><i
                                                class="fa fa-pencil-square-o"></i>Edit
                                        </button>
                                        Third Alert <em>by Dr Z</em>
                                    <span class="pull-right text-muted small"><em>27 minutes ago </em><button
                                            type="button" class="btn btn-danger btn-danger btn-xs" onclick="areYouSure(3)"><i
                                                class="fa fa-times"></i>Delete
                                        </button>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item" id="4">
                                        <button type="button" class="btn btn-warning btn-warning btn-xs"><i
                                                class="fa fa-pencil-square-o"></i>Edit
                                        </button>
                                        4th Alert <em>by Dr X</em>
                                    <span class="pull-right text-muted small"><em>21/11/2015 10:24 </em><button
                                            type="button" class="btn btn-danger btn-danger btn-xs" onclick="areYouSure(4)"><i
                                                class="fa fa-times"></i>Delete
                                        </button>
                                    </span>
                                    </a>
                                </div>
                                <!-- /.list-group -->
                                <a href="#" class="btn btn-default btn-block">View All Alerts</a>
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
