<?php
include_once 'connection/checkUser.php';

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
                    <h1 class="page-header">Prototype System</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <a class="btn btn-large btn-primary" onclick="openSOFA(1);"><i class="fa fa-search fa-3x"></i> SOFA</a>
                                    <div class="hidden" id="sofa1">
                                        </br>
                                        <span class = "label label-warning" style="font-size: 13pt">SOFA: 22</span>
                                        </br></br>
                                        <span class="label label-danger" style="font-size: 13pt">Mortality: 78.57%</span>
                                    </div>
                                    </br></br>
                                    <a class="btn btn-large btn-primary" href="patient_info.php"><i class="fa fa-tag fa-3x"></i> Cluster</a>
                                </div>
                                </br></br>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Israel Israeli</div>
                                </div>
                            </div>
                        </div>
                        <a href="patient_info.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Patient</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <a class="btn btn-large btn-primary" onclick="openSOFA(2);"><i class="fa fa-search fa-3x"></i> SOFA</a>
                                    <div class="hidden" id="sofa2">
                                        </br>
                                        <span class = "label label-warning" style="font-size: 13pt">SOFA: 22</span>
                                        </br></br>
                                        <span class="label label-danger" style="font-size: 13pt">Mortality: 78.57%</span>
                                    </div>
                                    </br></br>
                                    <a class="btn btn-large btn-primary" href="patient_info.php"><i class="fa fa-tag fa-3x"></i> Cluster</a>
                                </div>
                                </br></br>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Israel Israeli</div>
                                </div>
                            </div>
                        </div>
                        <a href="patient_info.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Patient</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <a class="btn btn-large btn-primary" onclick="openSOFA(3);"><i class="fa fa-search fa-3x"></i> SOFA</a>
                                    <div class="hidden" id="sofa3">
                                        </br>
                                        <span class = "label label-warning" style="font-size: 13pt">SOFA: 22</span>
                                        </br></br>
                                        <span class="label label-danger" style="font-size: 13pt">Mortality: 78.57%</span>
                                    </div>
                                    </br></br>
                                    <a class="btn btn-large btn-primary" href="patient_info.php"><i class="fa fa-tag fa-3x"></i> Cluster</a>
                                </div>
                                </br></br>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Israel Israeli</div>
                                </div>
                            </div>
                        </div>
                        <a href="patient_info.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Patient</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <a class="btn btn-large btn-primary" onclick="openSOFA(4);"><i class="fa fa-search fa-3x"></i> SOFA</a>
                                    <div class="hidden" id="sofa4">
                                        </br>
                                        <span class = "label label-warning" style="font-size: 13pt">SOFA: 22</span>
                                        </br></br>
                                        <span class="label label-danger" style="font-size: 13pt">Mortality: 78.57%</span>
                                    </div>
                                    </br></br>
                                    <a class="btn btn-large btn-primary" href="patient_info.php"><i class="fa fa-tag fa-3x"></i> Cluster</a>
                                </div>
                                </br></br>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Israel Israeli</div>
                                </div>
                            </div>
                        </div>
                        <a href="patient_info.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Patient</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php include_once 'parts/bottom.php'; ?>

<script>
    function openSOFA(index)
    {
        if(document.getElementById("sofa"+index).getAttribute("class") != "") {
            document.getElementById("sofa"+index).setAttribute("class", "");
        } else {
            document.getElementById("sofa"+index).setAttribute("class", "hidden");
        }
    }
</script>

</body>

</html>
