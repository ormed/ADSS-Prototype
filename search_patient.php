<?php
//include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'database/Database.php';

?>

<body>

<div id="wrapper">

    <?php include_once 'parts/nav.php'; ?>

    <!-- Page Content -->
    <div id="page-wrapper">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Search Patient</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            </br>
            <!-- /.row -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Search
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form role="form" method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                        <div class="form-group">
                            <i class="fa fa-caret-right"></i> <label>Patient First Name</label>
                            <input class="form-control" name="first_name" style="width:200px">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-caret-right"></i> <label>Patient Last Name</label>
                            <input class="form-control" name="last_name" style="width:200px">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-caret-right"></i> <label>Patient Id</label>
                            <input class="form-control" name="patient_id" style="width:200px" maxlength="9"
                                   onkeypress='return event.charCode >= 46 && event.charCode <= 57'>
                        </div>

                        <button type="submit" class="btn btn-success">Search</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </form>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php
include_once 'parts/bottom.php';
?>

</body>

</html>
