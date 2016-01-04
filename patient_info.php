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
                    <h1 class="page-header">Patient Info</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <img src="http://h24-original.s3.amazonaws.com/200189/17545914-9fVHQ.png" height="30%" width="30%">
                                <div>
                                    <label>Name: </label>
                                    <label id="patient_name">Israel Israeli</label>
                                    </br>
                                    <label>LOS: </label>
                                    <label id="los">7 Days</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="panel-body">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-line-chart-multi" style="padding: 0px; position: relative;">
                                    <canvas class="flot-base" width="749" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 749px; height: 400px;"></canvas>
                                    <div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                                        <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
                                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 83px; top: 381px; left: 3px; text-align: center;">Jan 2007</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 83px; top: 381px; left: 102px; text-align: center;">Apr 2007</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 83px; top: 381px; left: 203px; text-align: center;">Jul 2007</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 83px; top: 381px; left: 303px; text-align: center;">Oct 2007</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 83px; top: 381px; left: 404px; text-align: center;">Jan 2008</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 83px; top: 381px; left: 504px; text-align: center;">Apr 2008</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 83px; top: 381px; left: 606px; text-align: center;">Jul 2008</div>
                                        </div>
                                        <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 368px; left: 14px; text-align: right;">0</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 306px; left: 8px; text-align: right;">25</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 245px; left: 8px; text-align: right;">50</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 184px; left: 8px; text-align: right;">75</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 123px; left: 2px; text-align: right;">100</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 62px; left: 2px; text-align: right;">125</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 2px; text-align: right;">150</div>
                                        </div>
                                        <div class="flot-y-axis flot-y2-axis yAxis y2Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 368px; left: 714px;">0.600€</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 306px; left: 714px;">0.633€</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 245px; left: 714px;">0.667€</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 184px; left: 714px;">0.700€</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 123px; left: 714px;">0.733€</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 62px; left: 714px;">0.767€</div>
                                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 714px;">0.800€</div>
                                        </div>
                                    </div>
                                    <canvas class="flot-overlay" width="749" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 749px; height: 400px;"></canvas>
                                    <div class="legend"><div style="position: absolute; width: 138px; height: 34px; bottom: 29px; left: 30px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div><table style="position:absolute;bottom:29px;left:30px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(237,194,64);overflow:hidden"></div></div></td><td class="legendLabel">Oil price ($)</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(175,216,248);overflow:hidden"></div></div></td><td class="legendLabel">USD/EUR exchange rate</td></tr></tbody></table></div></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-search fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Israel Israeli</div>
                                </div>
                            </div>
                        </div>
                        <a href="alerts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Case</span>
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
                                    <i class="fa fa-search fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Israel Israeli</div>
                                </div>
                            </div>
                        </div>
                        <a href="alerts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Case</span>
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

<!-- Flot Charts JavaScript -->
<script src="bower_components/flot/excanvas.min.js"></script>
<script src="bower_components/flot/jquery.flot.js"></script>
<script src="bower_components/flot/jquery.flot.pie.js"></script>
<script src="bower_components/flot/jquery.flot.resize.js"></script>
<script src="bower_components/flot/jquery.flot.time.js"></script>
<script src="bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="js/flot-data.js"></script>
</body>

</html>
