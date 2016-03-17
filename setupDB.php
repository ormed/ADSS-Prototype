<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'help_functions.php';
include_once 'database/FixDB.php';
?>

<body>

<div id="wrapper">

    <?php include_once 'parts/nav.php';?>

    <!-- Page Content -->
    <div id="page-wrapper">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">All Dates</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            </br>
            <!-- /.row -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Products
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <?php /*
                            <tr>
                                <th>#Id</th>
                                <th>Median</th>
                                <th>Mean</th>
                                <th>Max</th>
                            </tr>
                            */
                            ?>
                            </thead>
                            <tbody>
                            <?php
                            $max_id = 4600;

                            for($id=4500; $id<=4571; $id++) {
                                $res = FixDB::getMedian($id);
                                $mean = FixDB::getMean($id);
                                $max = FixDB::getMax($id);

                                if(!empty($res) && !empty($mean) && !empty($max)) {
                                    //$total_res[$id]['bicarbonate_median'] = array_median($res);
                                    //$total_res[$id]['bicarbonate_mean'] = $mean;
                                    //$total_res[$id]['bicarbonate_max'] = $max;
                                    //debug($total_res);
                                    $new_res = array_median($res);
                                    /*
                                    <tr>
                                        <td><?php echo($id); ?></td>
                                        <td><?php echo($new_res) ?></td>
                                        <td><?php echo($mean); ?></td>
                                        <td><?php echo($max); ?></td>
                                    </tr>*/
                                    ?>
                                    <?php
                                    FixDB::insertPatientVec($id, $new_res, $mean, $max);
                                }
                            }
                            echo("Done!");
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
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


<?php include_once 'parts/bottom.php';?>

</body>

</html>
