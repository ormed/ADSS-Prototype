<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

// Random cartesian coordinates (x, y) and labels


    $data = array(
        array(1, 2, 'red'),   // 0 =>
        array(5, 3, 'blue'),  // 1 =>
        array(-1, 2, 'blue'), // 2 =>
        array(2, 5, 'red'),   // 3 =>
        array(3, 3, 'red'),   // 4 =>
        array(-4, 5, 'blue'), // 5 =>
        array(2, 2, 'blue'),  // 6 =>
        array(5, -2, 'red'),  // 7 =>
        array(-1, -2, 'blue'),// 8 =>
    );


// Build distance matrix
    $distances = $data;
    array_walk($distances, 'euclideanDistance', $data);


// Example, target = datapoint 5, getting 3 nearest neighbors
    $neighbors = getNearestNeighbors($distances, 5, 3);
    debug($neighbors);

    echo getLabel($data, $neighbors); // red

} else {

?>
<body>
<div id="wrapper">
    <?php include_once 'parts/nav.php'; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Search Case Form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form class="form-inline col-xs-10 col-xs-offset-1" role="form" method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>

                                        <div class="input-group">
                                            <div class="form-group">
                                                <label class="control-label"> Select constraint Domain:&nbsp;&nbsp;</label>
                                                <p></p>
                                                <select class="form-control">
                                                    <option>Domain Options</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Select Constraint Specific:&nbsp;&nbsp;</label>
                                                <p></p>
                                                <select class="form-control">
                                                    <option>Parameter Options</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"> Select constraint format:&nbsp;&nbsp;</label>
                                                <p></p>
                                                <select class="form-control">
                                                    <option>Range/Threshold/Set</option>
                                                </select>
                                            </div>
                                        </div>

                                        <p></p>
                                        <legend></legend>

                                        <div class="input-group">
                                            <div class="form-group">
                                                <label class="control-label">From:&nbsp;&nbsp;</label>
                                                <p></p>&nbsp;&nbsp;
                                                <select class="form-control">
                                                    <option>Initial m/u</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">To:&nbsp;&nbsp;</label>
                                                <p></p>
                                                <select class="form-control">
                                                    <option>Final m/u</option>
                                                </select>
                                            </div>
                                            <p></p>
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </div>

                                        <p></p>
                                        <legend></legend>

                                        <div class="input-group">
                                            <div class="form-group">
                                                <label class="control-label">Operand:&nbsp;&nbsp;</label>
                                                <p></p>&nbsp;&nbsp;
                                                <select class="form-control">
                                                    <option>Over</option>
                                                    <option>Under</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Threshold:&nbsp;&nbsp;</label>
                                                <p></p>
                                                <select class="form-control">
                                                    <option>Value m/u</option>
                                                </select>
                                            </div>
                                            <p></p>
                                            <button type="button" class="btn btn-default">Submit</button>
                                        </div>

                                        <p></p>
                                        <legend></legend>

                                        <div class="input-group">
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option>Value set List</option>
                                                </select>
                                            </div>
                                            <p></p>
                                            <button type="button" class="btn btn-default">Submit</button>
                                        </div>

                                        <p></p>
                                        <legend></legend>

                                        <button type="button" class="btn btn-success col-xs-offset-5" onclick="showResults();">Search</button>
                                    </form>
                                </div>

                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <h1 class="text-center">Preview</h1>
                                    <form role="form">
                                        <fieldset>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Parameter</th>
                                                            <th>Target</th>
                                                            <th class="block"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Age</td>
                                                                <td>[55-85] Years</td>
                                                                <td class="block"><button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Anion Gap</td>
                                                                <td>[0.8-1.2] mg/dL</td>
                                                                <td class="block"><button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>LOS</td>
                                                                <td><4 Days</td>
                                                                <td class="block"><button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>Gender</td>
                                                                <td>Male</td>
                                                                <td class="block"><button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.table-responsive -->
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->

                                <legend></legend>


                                <!-- /Results -->
                                <div class="col-lg-12 hidden" id="results_div">
                                    <h1 class="text-center">Results</h1>

                                    <p></p>
                                    <legend></legend>

                                    <form role="form">
                                        <fieldset>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Age</th>
                                                                <th>Sex</th>
                                                                <th>LOS (days)</th>
                                                                <th>Medications</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr id="result.entry[]">
                                                                <td>132</td>
                                                                <td>67</td>
                                                                <td>F</td>
                                                                <td>12</td>
                                                                <td>Vasopressin</td>
                                                            </tr>
                                                            <tr id="result.entry[]">
                                                                <td>15465</td>
                                                                <td>45</td>
                                                                <td>M</td>
                                                                <td>4</td>
                                                                <td>Ephedrin</td>
                                                            </tr>
                                                            <tr id="result.entry[]">
                                                                <td>23444</td>
                                                                <td>75</td>
                                                                <td>M</td>
                                                                <td>2</td>
                                                                <td>Vitamin K</td>
                                                            </tr>
                                                            <tr id="result.entry[]">
                                                                <td>34523</td>
                                                                <td>82</td>
                                                                <td>F</td>
                                                                <td>25</td>
                                                                <td>Vitamin K</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.table-responsive -->
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                                <!-- /.Results -->




                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>




                <?php
                include_once 'parts/bottom.php';
                ?>



                <script>
                    function showResults()
                    {
                        document.getElementById("results_div").removeAttribute("class");
                    }

                    $("#result\\.entry\\[\\]").click(function() {
                        location.href = 'patient_info.php';
                    });

                </script>
</body>

<?php
}
?>

</html>

