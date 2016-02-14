<?php
//include_once 'connection/checkUser.php';
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
                    <h1 class="page-header">All Patients</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Patients</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    Avi Avi
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>1:00</th>
                            <th>1:30</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>BP</td>
                            <td>135/80</td>
                            <td>120/62</td>
                        </tr>

                        <tr>
                            <td>H2O</td>
                            <td>71</td>
                            <td>65</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                <div class="table-responsive">
                    Israel Israel
                    <table class="table table-striped table-bordered table-hover">
                        <thead>

                        <tr>
                            <th>Parameter</th>
                            <th>1:00</th>
                            <th>1:30</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>BP</td>
                            <td>120/60</td>
                            <td>140/80</td>
                        </tr>

                        <tr>
                            <td>H2O</td>
                            <td>71</td>
                            <td>65</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php include_once 'parts/bottom.php'; ?>

</body>

</html>
