<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'database/SimilarCases.php';
include_once 'database/Patient.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


$id = $_POST['patient_id'];
$num_of_neighbors = $_POST['num_of_neighbors'];
$neighbors = SimilarCases::KNN_Algorithm('C:/wamp/www/ADSS-Prototype/uploads/Patients.csv', $id, $num_of_neighbors);
debug($neighbors);
?>

<body>
<div id="wrapper">
    <?php include_once 'parts/nav.php'; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Result</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /Results -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover"  style="width:50%; height:50%">
                        <thead>
                        <tr>
                            <th style="width:1%" class="text-center">#</th>
                            <th class="text-center">ID</th>
                            <th class="text-center">%</th>
                        </tr>
                        </thead>

                        <tbody style="overflow-y: auto;
                               height: 50%;
                               width: 50%;">
                        <?php
                        $i = 1;
                        foreach ($neighbors as $id => $percent) {
                            ?>
                            <tr>
                                <td style="width:1%;"><?php echo $i++; ?></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $percent; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
        <!-- /.Results -->

        </div>
    </div>
</body>

        <?php

        /*
        // Read the csv file that contains patients parameters
        $data = array();
        $file = fopen('C:/Users/Or/Desktop/Patients.csv', 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            $data[$line[0]] = $line;
        }
        fclose($file);
        unset($data[0]); // Remove params header (i.e: age,id,bp...)

        // Build distance matrix
        $distances = array();
        $size = sizeof($data);
        $distances[1] = euclideanDistance($data[1], 1, $data);
        // Example, target = id 1, getting 10 nearest neighbors
        $neighbors = getNearestNeighbors($distances, 1, 100);

        debug($neighbors);
        //echo getLabel($data, $neighbors); // red*/

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
                                            <form class="form-inline col-xs-10 col-xs-offset-1" role="form"
                                                  method="POST"
                                                  action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>

                                                <div class="input-group">
                                                    <div class="form-group">
                                                        <label class="control-label"> Select constraint
                                                            Domain:&nbsp;&nbsp;</label>

                                                        <p></p>
                                                        <select class="form-control">
                                                            <option>BP</option>
                                                            <option></option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Select Constraint
                                                            Specific:&nbsp;&nbsp;</label>
                                                        <p></p>
                                                        <select class="form-control">
                                                            <option value="Age">Age</option>
                                                            <option value="Anion Gap">Anion Gap</option>
                                                            <option value="LOS">LOS</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label"> Select constraint
                                                            format:&nbsp;&nbsp;</label>

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
                                                        <input class="form-control" id="threshold" type="number" min="0" max="100" step="1" value ="50"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">To:&nbsp;&nbsp;</label>

                                                        <p></p>
                                                        <input class="form-control" id="threshold" type="number" min="0" max="100" step="1" value ="50"/>
                                                    </div>
                                                    <p></p>
                                                    <button type="submit" class="btn btn-default">Add</button>
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
                                                        <input class="form-control" id="threshold" type="number" min="0" max="100" step="1" value ="50"/>
                                                    </div>
                                                    <p></p>
                                                    <button type="button" class="btn btn-default">Add</button>
                                                </div>

                                                <p></p>
                                                <legend></legend>

                                                <div class="input-group">
                                                    <div class="form-group">
                                                        <label class="control-label">Select Patient ID: </label>

                                                        <p></p>
                                                        <?php
                                                        $results = Patient::getPatientsId();
                                                        ?>
                                                        <select class="form-control" name="patient_id">
                                                            <?php
                                                            foreach ($results as $result) {
                                                                echo "<option value='$result[id]'>$result[id]</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <p></p>

                                                    <div class="form-group">
                                                        <label class="control-label">Select Number of
                                                            Neighbors: </label>

                                                        <p></p>
                                                        <select class="form-control" name="num_of_neighbors">
                                                            <?php
                                                            for ($i = 0; $i <= 500; $i += 50) {
                                                                echo "<option value='$i'>$i</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <p></p>
                                                    <button type="button" class="btn btn-default">Submit</button>
                                                </div>

                                                <p></p>
                                                <legend></legend>

                                                <button type="submit" class="btn btn-success">Sumbit</button>

                                                <button type="button" class="btn btn-success col-xs-offset-5"
                                                        onclick="showResults();">Search
                                                </button>
                                            </form>
                                        </div>

                                        <!-- /.col-lg-6 (nested) -->
                                        <div class="col-lg-6">
                                            <h1 class="text-center">Preview</h1>

                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Parameter</th>
                                                            <th>Target</th>
                                                            <th class="nowrap" style="width:1%"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Age</td>
                                                            <td>[55-85] Years</td>
                                                            <td class="block">
                                                                <button class="btn btn-danger" type="button"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.table-responsive -->
                                            </div>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->


                                        <!-- /Results -->
                                        <div class="col-lg-12 hidden" id="results_div">
                                            <h1 class="text-center">Results</h1>

                                            <p></p>
                                            <legend></legend>

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
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.table-responsive -->
                                            </div>
                                        </div>
                                        <!-- /.Results -->

                                        <?php
                                        }
                                        ?>

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
                            function showResults() {
                                document.getElementById("results_div").removeAttribute("class");
                            }

                            $("#result\\.entry\\[\\]").click(function () {
                                location.href = 'patient_info.php';
                            });

                        </script>
        </body>


        </html>

