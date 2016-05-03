<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';

if(!isset($_GET['id'])) {
    header('Location: index.php');
    //$id = $_GET['id'];

    // Show the graph of $id

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
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-outline btn-primary ">Vital Signs</button><button type="button" class="btn btn-outline btn-primary">Other View</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div id="curve_chart" style="width: 900px; height: 500px"></div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php include_once 'parts/bottom.php'; ?>

<script type="text/javascript"
        src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

<script type="text/javascript">
    google.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Day', 'BP (mm Hg)', 'SOFA'],
            ['1/1/2012',  80,      25],
            ['2/1/2012',  90,      26],
            ['3/1/2012',  80,       50],
            ['4/1/2012',  70,      100]
        ]);

        var options = {
            title: 'Vital Signs',
            curveType: 'function',
            legend: { position: 'right' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
</script>

</body>

</html>
