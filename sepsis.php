<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'database/Sepsis.php';
include_once 'database/Patient.php';

if (isset($_GET['id'])) {
    // Parse the $_GET['id'] so it disables injection
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
} else {
    header('Location: index.php');
}

$sepsis_prob = Sepsis::getProbability($id);
if (!empty($sepsis_prob)) {
    $sepsis_prob = number_format($sepsis_prob * 100, 3, '.', '');
}

$value = Patient::getPatientById($id);
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    google.charts.load('current', {packages: ['corechart', 'line', 'gauge']});
    google.charts.setOnLoadCallback(drawHeartRate);
    google.charts.setOnLoadCallback(drawRespiratoryRate);
    google.charts.setOnLoadCallback(drawTemp);
    google.charts.setOnLoadCallback(drawMAP);
    google.charts.setOnLoadCallback(drawProbability);


    /**
     * @param name $name value
     * @return the parameter value
     * @internal param $name $ - the get parameter to find
     */
    function getParameterByName(name) {
        var url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    function drawProbability() {
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['', 0]
        ]);

        var options = {
            greenFrom: 0, greenTo: 50,
            yellowFrom: 50, yellowTo: 90,
            redFrom: 90, redTo: 100,
            minorTicks: 10,
            animation: {duration: 2000, easing: 'inAndOut',},
            majorTicks: ['0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100']
        };

        var chart = new google.visualization.Gauge(document.getElementById('probability_div'));
        chart.draw(data, options);
        //clearChart();

        setTimeout(function () {
            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['', <?=$sepsis_prob ?>]
            ]);
            chart.draw(data, options);
        }, 200);
    }


    function drawHeartRate() {
        var patientId = getParameterByName('id');
        var jsonHeartRate = $.ajax({
            url: "get_heart_rate.php",
            dataType: "json",
            data: {patientId: patientId},
            async: false
        }).responseText;
        var array = JSON.parse(jsonHeartRate);
        var data = new google.visualization.DataTable();
        data.addColumn('datetime', 'X');
        data.addColumn('number', 'Heart Rate (bpm)');
        var size = array.rows.length;
        for (var i = 0; i < size; i++) {
            var myValue = array.rows[i].c[0].v;
            myValue = Math.round(myValue * 100) / 100;
            data.addRow([new Date(array.rows[i].c[1].v), myValue]);
        }
        var options = {
            legend: {
                position:'top'
            },
            hAxis: {
                title: 'Time'
            },
            vAxis: {
                title: 'Heart Rate',
            },
            chartArea: {width: "70%", height: "60%"},
            colors: ['red']
        };
        var chart = new google.visualization.LineChart(document.getElementById('hr_chart'));
        chart.draw(data, options);
    }

    function drawRespiratoryRate() {
        var patientId = getParameterByName('id');
        var jsonRespiratoryRate = $.ajax({
            url: "get_respiratory_rate.php",
            dataType: "json",
            data: {patientId: patientId},
            async: false
        }).responseText;
        var array = JSON.parse(jsonRespiratoryRate);
        var data = new google.visualization.DataTable();
        data.addColumn('datetime', 'X');
        data.addColumn('number', 'Respiratory Rate (insp/min)');
        var size = array.rows.length;
        for (var i = 0; i < size; i++) {
            var myValue = array.rows[i].c[0].v;
            myValue = Math.round(myValue * 100) / 100;
            data.addRow([new Date(array.rows[i].c[1].v), myValue]);
        }
        var options = {
            legend: {
                position:'top'
            },
            hAxis: {
                title: 'Time'
            },
            vAxis: {
                title: 'Respiratory Rate'
            },
            chartArea: {width: "70%", height: "60%"}
        };
        var chart = new google.visualization.LineChart(document.getElementById('respiratory_rate_chart'));
        chart.draw(data, options);
    }

    function drawTemp() {
        var patientId = getParameterByName('id');
        var jsonTemperature = $.ajax({
            url: "get_temperature.php",
            dataType: "json",
            data: {patientId: patientId},
            async: false
        }).responseText;
        var array = JSON.parse(jsonTemperature);
        var data = new google.visualization.DataTable();
        data.addColumn('datetime', 'X');
        data.addColumn('number', 'Temperature (\u00B0C)');
        var size = array.rows.length;
        for (var i = 0; i < size; i++) {
            var myValue = array.rows[i].c[0].v;
            myValue = Math.round(myValue * 100) / 100;
            data.addRow([new Date(array.rows[i].c[1].v), myValue]);
        }
        var options = {
            legend: {
                position:'top'
            },
            hAxis: {
                title: 'Time'
            },
            vAxis: {
                title: 'Temperature'
            },
            chartArea: {width: "70%", height: "60%"},
            colors: ['orange']
        };
        var chart = new google.visualization.LineChart(document.getElementById('temperature_chart'));
        chart.draw(data, options);
    }

    function drawMAP() {
        var patientId = getParameterByName('id');
        var $jsonMeanArterialPressure = $.ajax({
            url: "get_map.php",
            dataType: "json",
            data: {patientId: patientId},
            async: false
        }).responseText;
        var array = JSON.parse($jsonMeanArterialPressure);
        var data = new google.visualization.DataTable();
        data.addColumn('datetime', 'X');
        data.addColumn('number', 'Mean Arterial Pressure (mmHg)');
        var size = array.rows.length;
        for (var i = 0; i < size; i++) {
            var myValue = array.rows[i].c[0].v;
            myValue = Math.round(myValue * 100) / 100;
            data.addRow([new Date(array.rows[i].c[1].v), myValue]);
        }
        var options = {
            legend: {
                position:'top'
            },
            hAxis: {
                title: 'Time'
            },
            vAxis: {
                title: 'Mean '
            },
            chartArea: {width: "70%", height: "60%"},
            colors: ['green']
        };
        var chart = new google.visualization.LineChart(document.getElementById('map_chart'));
        chart.draw(data, options);
    }

    function drawAll() {
        drawHeartRate();
        drawRespiratoryRate();
        drawTemp();
        drawMAP();
        drawProbability();
    }
</script>

<body onresize="drawAll()">

<div id="wrapper">
    <?php include_once 'parts/nav.php'; ?>
    <!-- Page Content -->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row center-block">
                <div class="col-lg-12">
                    <h1 class="page-header">Sepsis</h1>
                </div>
                <!-- /.col-lg-12 -->

                <button type="button" class="btn btn-outline btn-primary" onclick="location.href = 'index.php';">
                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back
                </button>

                <p></p>


                <div class="text-left" id="patient_info" style="width: 20%; height: 50%; float: left;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Patient Information
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <span style="font-family: monospace; font-size: large; color: darkblue;">
                                <b>Id:</b> <?php echo $id; ?>
                                </br>
                                <b>Age:</b> <?php echo $value[0]['age']; ?>
                                </br>
                                <b>LOS:</b> <?php echo $value[0]['los']; ?>
                                </br>
                                <b>Gender:</b> <?php echo $value[0]['gender']; ?>
                            </span>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <div class="text-center" id="sepsis_result" style="width: 20%; height: 50%; float: left; margin-left:20px;">
                    <div class="panel panel-<?php echo($sepsis_prob > 50 ? "danger" : "success"); ?>">
                        <div class="panel-heading">
                            Probability
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body  center-block">
                            <div style="width:70%; margin:0 auto;" id="probability_div">
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

            </div>
            <!-- /.row -->

            <div id="hr_plot" style="width: 70%;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Heart Rate
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="flot-chart-content" id="hr_chart"
                             style="padding: 0px; position: relative;"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

            <div id="rr_plot" style="width: 70%;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Respiratory Rate
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="respiratory_rate_chart"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

            <div id="temp_plot" style="width: 70%;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Temperature
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="temperature_chart"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

            <div id="map_plot" style="width: 70%;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Arterial Pressure Mean
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="map_chart"></div>
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
