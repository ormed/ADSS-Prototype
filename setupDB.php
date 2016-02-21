<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';
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
                            <tr>
                                <th>#Id</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $max_id = 4571;
                            $max = FixDB::getAllDatesForId(4401);
                            echo ("Max Before: ". $max);
                            FixDB::alterTable();
                            /*for($i=4402; $i<=4600; $i++) {
                                $current_max = FixDB::getAllDatesForId($i);
                                if($current_max > $max)
                                {
                                    $max = $current_max;
                                }
                            }
                            echo (" Max After: ".$max);*/


                            /*foreach ($results as $result) {
                                ?>
                                <tr>
                                    <td><?php echo($i); ?></td>
                                    <?php
                                    $originalDate = $result["Date.Time"];
                                    $t = date_create_from_format("d/m/Y H:i",$originalDate);
                                    $newDate = date_format($t,"d/m/Y H:i:s");
                                    //$originalDate = $result["Date.Time"];
                                    //$newDate = date("Y-m-d H:i:s", strtotime($originalDate));
                                    ?>
                                    <td><?php echo($newDate)?></td>
                                </tr>
                                <?php
                            }*/

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
