<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'database/Mortality.php';
include_once 'database/Patient.php';

if (isset($_GET['id'])) {
    // Parse the $_GET['id'] so it disables injection
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
} else {
    header('Location: index.php');
}

$result = Mortality::getProbability($id);
debug($result);
if (!empty($result)) {
    $mortality_prob = number_format($result[0]['preds'] * 100, 3, '.', '');
} else {
    $mortality_prob = '';
}

$value = Patient::getPatientById($id);
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    google.charts.load('current', {packages: ['corechart', 'line', 'gauge']});
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
                ['', <?=$mortality_prob ?>]
            ]);
            chart.draw(data, options);
        }, 200);
    }

    function drawAll() {
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
                    <h1 class="page-header">Mortality</h1>
                </div>
                <!-- /.col-lg-12 -->

                <button type="button" class="btn btn-outline btn-primary" onclick="location.href = 'index.php';">
                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back
                </button>

                <p></p>


                <div class="text-left" id="patient_info" style="width: 20%; height: 50%; float: left;">
                    <div class="panel panel-primary">
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

                <div class="text-center" id="sepsis_result"
                     style="width: 20%; height: 50%; float: left; margin-left:20px;">
                    <div class="panel panel-<?php echo($mortality_prob > 50 ? "danger" : "success"); ?>">
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

            <div id="sofa" style="width: 70%;">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        SOFA
                    </div>
                    <!-- /.panel-heading -->
                    <div class="row text-center">

                        <div class="row show-grid panel-body">
                            <div class="col-md-4 col-md-offset-1" style="width: 20%;">
                                <span style="font-family: monospace; font-size: large; color: darkblue;">
                                    <?php if (!empty($result)) {
                                        echo $result[0]['sofa1'];
                                    } else {
                                        echo "Not Diagnosed";
                                    } ?>
                                </span>
                            </div>
                            <div class="col-md-4 col-md-offset-1" style="width: 20%;">
                                <span style="font-family: monospace; font-size: large; color: darkblue;">
                                    <?php if (!empty($result)) {
                                        echo $result[0]['sofa2'];
                                    } else {
                                        echo "Not Diagnosed";
                                    } ?>
                                </span>
                            </div>
                            <div class="col-md-4 col-md-offset-1" style="width: 20%;">
                                <span style="font-family: monospace; font-size: large; color: darkblue;">
                                    <?php if (!empty($result)) {
                                        echo $result[0]['sofa3'];
                                    } else {
                                        echo "Not Diagnosed";
                                    } ?>
                                </span>
                            </div>
                        </div>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

            <div id="gastro" style="width: 70%;">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Gastro (Vomit, Guts, REE)
                    </div>

                    <div class="row text-center">

                        <div class="row show-grid panel-body">

                            <div class="col-md-4 col-md-offset-1" style="width: 20%;">
                                <span style="font-family: monospace; font-size: large; color: darkblue;">
                                    <?php if (!empty($result)) { ?>
                                        <?php if (!empty($result)) {
                                            echo $result[0]['vomit1'];
                                        } else {
                                            echo "Not Diagnosed";
                                        } ?>
                                        ,
                                        <?php if (!empty($result)) {
                                            echo $result[0]['guts1'];
                                        } else {
                                            echo "Not Diagnosed";
                                        } ?>
                                        ,
                                        <?php if (!empty($result)) {
                                            echo $result[0]['REE1'];
                                        } else {
                                            echo "Not Diagnosed";
                                        } ?>
                                    <?php } else {
                                        echo "Not Diagnosed";
                                    } ?>
                                </span>
                            </div>
                            <div class="col-md-4 col-md-offset-1" style="width: 20%;">
                                <span style="font-family: monospace; font-size: large; color: darkblue;">
                                    <?php if (!empty($result)) {
                                        ?>
                                        <?php echo $result[0]['vomit2']; ?>
                                        ,
                                        <?php echo $result[0]['guts2']; ?>
                                        ,
                                        <?php echo $result[0]['REE2'];
                                    } else {
                                        echo "Not Diagnosed";
                                    } ?>
                                </span>
                            </div>
                            <div class="col-md-4 col-md-offset-1" style="width: 20%;">
                                <span style="font-family: monospace; font-size: large; color: darkblue;">
                                    <?php if (!empty($result)) { ?>
                                        <?php if (!empty($result)) {
                                            echo $result[0]['vomit3'];
                                        } else {
                                            echo "Not Diagnosed";
                                        } ?>
                                        ,
                                        <?php if (!empty($result)) {
                                            echo $result[0]['guts3'];
                                        } else {
                                            echo "Not Diagnosed";
                                        } ?>
                                        ,
                                        <?php if (!empty($result)) {
                                            echo $result[0]['REE3'];
                                        } else {
                                            echo "Not Diagnosed";
                                        } ?>
                                    <?php } else {
                                        echo "Not Diagnosed";
                                    } ?>
                                </span>
                            </div>

                        </div>
                    </div>

                </div>

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
