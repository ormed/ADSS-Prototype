<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'database/Sepsis.php';

if (isset($_GET['id'])) {
    // Parse the $_GET['id'] so it disables injection
    $id =  filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
} else {
    header('Location: index.php');
}



?>

<body onresize="drawBasic()">

<div id="wrapper">
    <?php include_once 'parts/nav.php'; ?>
    <!-- Page Content -->
    <div id="page-wrapper">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sepsis</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div id="hr_plot" style="width: 70%;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Bicarbonate
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="flot-chart-content" id="bicarbonate_chart"
                             style="padding: 0px; position: relative;"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

            <div id="ap_plot" style="width: 70%;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Heart Rate
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="flot-chart-content" id="chart_div" style="padding: 0px; position: relative;">
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

            <div id="hr_plot" style="width: 70%;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Heart Rate
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="flot-chart-content" id="chart_div" style="padding: 0px; position: relative;">
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    google.charts.load('current', {packages: ['corechart', 'line']});
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', 'X');
        data.addColumn('number', 'Bicarbonate');
        data.addRows([
            [0, 11],
            [5, 2],
            [10, 2],
            [20, 2],
            [30, 7]
        ]);

        var data = new google.visualization.DataTable(
            {
                cols: [{id: 'task', label: 'X', type: 'number'},
                    {id: 'hours', label: 'Bicarbonate', type: 'number'}],
                rows: [{c:[{v: 'Work'}, {v: 11}]},
                    {c:[{v: 'Eat'}, {v: 2}]},
                    {c:[{v: 'Commute'}, {v: 2}]},
                    {c:[{v: 'Watch TV'}, {v:2}]},
                    {c:[{v: 'Sleep'}, {v:7, f:'7.000'}]}
                ]
            }, 0.6);

        //data.addColumn('number', 'X');
        //data.addColumn('number', 'Bicarbonate');

        //data.addRows([
        //    [0, 0]
        //]);

        var options = {
            hAxis: {
                title: 'Time'
            },
            vAxis: {
                title: 'Bicarbonate'
            }
        };
        var chart = new google.visualization.LineChart(document.getElementById('bicarbonate_chart'));
        chart.draw(data, options);
    }
</script>
