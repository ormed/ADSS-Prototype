<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'database/Patient.php';

$results = Patient::getBedPatients();

?>

<body>

<div id="wrapper">
    <?php include_once 'parts/nav.php'; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Afeka Decision Support System</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <?php

            foreach ($results as $key => $value) {

                debug($value);
            if ($key % 2 == 0) {

            ?>

            <!-- /.row -->
            <div class="row">
                <?php

                }

                ?>
                <div class="col-lg-3 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="text-center">
                                    <div style="font-family: monospace; font-size: 200%; color: darkblue;"><b>Bed <?php echo ($key+1); ?></b></div>
                                </div>
                                <legend></legend>
                                <div style="width:50%; height: 100%; display: inline-block; float: left;">
                                    <div class="panel-body"
                                         style="position:absolute; top: 40px; left: 10px; width: 50%;">
                                        <!-- Patient info -->
                                        <div class="alert alert-info">
                                        <span style="font-family: monospace; font-size: large; color: darkblue;">
                                            <b>Age:</b> <?php if($value['age']=='NULL') { echo ""; } else { echo $value['age']; } ?>
                                            </br>
                                            <b>LOS:</b> <?php echo $value['los']; ?>
                                            </br>
                                            <b>Gender:</b> <?php echo $value['gender']; ?>
                                        </span>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="panel-body"
                                         style="position:absolute; bottom: 20px; left: 10px; width: 50%;">
                                        <a class="btn btn-large btn-primary btn-block"
                                           href="new_alarm.php?id=<?php echo $value['id']; ?>">
                                            <i class="fa fa-bell-o"></i><span style="font-family: monospace;"> Create Alarm</span></a>
                                    </div>
                                </div>
                                </br></br></br></br></br>
                                <div style="width:50%; height: 100%; display: inline-block; float: right">
                                    <div class="panel-body" style="position:absolute; top: 40px; right: 10px; width: 50%;">
                                        <a class="btn btn-large btn-primary btn-block" href="sepsis.php?id=<?php echo $value['id']; ?>">
                                            <i class="fa fa-bar-chart"></i><span style="font-family: monospace"> Sepsis</span>
                                        </a>
                                    </div>
                                    </br>
                                    <div class="panel-body" style="position:absolute; top: 90px; right: 10px; width: 50%;">
                                        <a class="btn btn-large btn-primary btn-block" href="mortality.php?id=<?php echo $value['id']; ?>">
                                            <i class="fa fa-calculator"></i><span style="font-family: monospace"> Mortality</span>
                                        </a>
                                    </div>
                                    <div class="panel-body" style="position:absolute; bottom: 20px; right: 10px; width: 50%;">
                                        <a class="btn btn-large btn-primary btn-block" href="similar_cases.php?id=<?php echo $value['id']; ?>">
                                            <i class="fa fa-search"></i><span style="font-family: monospace"> Search Cases</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                if($key%2 != 0) {
            ?>
            </div>
            <?php
                }
            }
            ?>


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php include_once 'parts/bottom.php'; ?>

<script>
    function openSOFA(index) {
        if (document.getElementById("sofa" + index).getAttribute("class") != "") {
            document.getElementById("sofa" + index).setAttribute("class", "");
        } else {
            document.getElementById("sofa" + index).setAttribute("class", "hidden");
        }
    }
</script>

</body>

</html>
