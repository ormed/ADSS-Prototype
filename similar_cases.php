<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'database/SimilarCases.php';
include_once 'database/Patient.php';

if (isset($_GET['id'])) {
    // Parse the $_GET['id'] so it disables injection
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['patient_id'];
    $numOfNeighbors = $_POST['numOfNeighborsLbl'];
    if ($_POST['submit'] == 'searchParams') {
        $neighbors = SimilarCases::KNN_Algorithm_Selected_Parameters($id, $numOfNeighbors);
    } else {
        $neighbors = SimilarCases::KNN_Algorithm_All_Parameters($id, $numOfNeighbors);
    }

    //$neighbors = SimilarCases::KNN_Algorithm_DB($id, $numOfNeighbors);
    //$neighbors = SimilarCases::KNN_Algorithm('C:/wamp/www/ADSS-Prototype/uploads/Patients.csv', $id, $numOfNeighbors);
    //SimilarCases::getAllParams();
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


}

?>
<body>
<div id="wrapper">
    <?php include_once 'parts/nav.php'; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-8 ">
                    <h1 class="page-header">Search Case Form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-4">
                                    <form
                                        class="form-inline col-xs-10 col-xs-offset-1 col-sm-12 col-md-12 col-sm-offset-1 col-md-offset-1"
                                        role="form"
                                        method="POST"
                                        action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>


                                        <div class="input-group">
                                            <div class="form-group">
                                                <label class="control-label">Select Patient: </label>

                                                <p></p>
                                                <?php
                                                $results = Patient::getPatientsId();
                                                ?>
                                                <select class="form-control" name="patient_id">
                                                    <?php
                                                    foreach ($results as $result) {
                                                        if (isset($id)) {
                                                            if ($id == $result['id']) {
                                                                echo "<option value='$result[id]' selected>$result[id]</option>";
                                                            } else {
                                                                echo "<option value='$result[id]'>$result[id]</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='$result[id]'>$result[id]</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <p></p>

                                            <div class="form-group">
                                                <label class="control-label">Select Number of
                                                    Neighbors: </label>

                                                <p></p>

                                                <input name="numOfNeighborsLbl" id="numOfNeighborsSlider"
                                                       data-slider-id='numOfNeighborsSlider' type="text"
                                                       data-slider-min="0" data-slider-max="50" data-slider-step="1"
                                                       data-slider-value="0"/>

                                            </div>
                                            <p></p>
                                        </div>

                                        <p></p>
                                        <legend></legend>

                                        <div class="input-group">
                                            <div class="form-group">
                                                <label class="control-label"> Parameters:</label>

                                                <p></p>
                                                <select class="form-control" id="constraints">
                                                    <option value="Heart Rate">Heart Rate</option>
                                                    <option value="Respiratory Rate">Respiratory Rate</option>
                                                    <option value="Temperature">Temperature</option>
                                                    <option value="Mean Arterial Pressure">Mean Arterial Pressure
                                                    </option>
                                                    <option value="Anion Gap">Anion Gap</option>
                                                    <option value="Platelets">Platelets</option>
                                                    <option value="Creatinine">Creatinine</option>
                                                    <option value="Bilirubin">Bilirubin</option>
                                                    <option value="Blood Urea Nitrogen">Blood Urea Nitrogen</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div id="params">

                                        </div>

                                        <p></p>

                                        <div class="input-group">
                                            <div class="form-group">
                                                <label class="control-label"> Options:</label>

                                                <p></p>
                                                <select class="form-control" id="options">
                                                    <option value="Min">Min</option>
                                                    <option value="Max">Max</option>
                                                    <option value="Mean">Mean</option>
                                                    <option value="Median">Median</option>
                                                </select>
                                            </div>
                                        </div>

                                        <p></p>

                                        <button type="button" class="btn btn-default" onclick="addConstraint();">Add</button>
                                        <button type="button" class="btn btn-default" onclick="addConstraints();">Add All Options</button>

                                        <p></p>
                                        <legend></legend>


                                        <button type="submit" class="btn btn-success" id="searchParams" name="submit"
                                                value="searchParams" style="display: none;">Search By Parameters
                                        </button>
                                        <p></p>
                                        <button type="submit" class="btn btn-info" id="searchAll" name="submit"
                                                value="searchAll">Search All
                                        </button>

                                </div>

                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-sm-6 col-md-6 col-xs-4 ">
                                    <h1 class="text-center">Preview</h1>

                                    <div id="preview" class="center-block">

                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover"
                                                       id="preview_table">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Parameter</th>
                                                        <th>Target</th>
                                                        <th class="nowrap" style="width:1%"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->


                                <!-- /Results -->
                                <div
                                    class='col-sm-12 col-md-12 col-xs-8 <?php if (!isset($neighbors)) echo "hidden"; ?>'
                                    id="results_div">
                                    <h1 class="text-center">Results</h1>

                                    <p></p>
                                    <legend></legend>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <?php
                                                    if(!empty($_POST))
                                                    if ($_POST['submit'] == 'searchParams') {
                                                        // Only selected parameters
                                                        $i = 1;
                                                        while (isset($_POST['param_' . $i])) {
                                                            ?>
                                                            <th><?php echo $_POST['param_' . $i]; ?></th>
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        // All parameters
                                                        $paramsCols = Patient::getAllParameters();
                                                        foreach ($paramsCols as $value) {
                                                            if ($value['Field'] != "id") {
                                                                ?>
                                                                <th><?php echo $value['Field']; ?></th>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <th>Percentage (%)</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php
                                                if (isset($neighbors)) {

                                                    //*****************************************************//
                                                    //             Data about the patient we check         //
                                                    //*****************************************************//
                                                    ?>
                                                    <tr>
                                                        <?php
                                                        if(!empty($_POST))
                                                        if ($_POST['submit'] == 'searchParams') {
                                                            // Only selected parameters
                                                            $patientParams = Patient::getPatientResultsById($id);

                                                        } else {
                                                            // All parameters
                                                            $patientParams = Patient::getAllPatientResultsById($id);
                                                        }
                                                        foreach ($patientParams[0] as $param_result) {
                                                            ?>
                                                            <td style="color: firebrick;"><b><?php echo $param_result; ?></b></td>
                                                            <?php
                                                        }
                                                        ?>
                                                        <td></td>
                                                    </tr>

                                                    <?php
                                                    //*****************************************************//
                                                    //             Data about the neighbors                //
                                                    //*****************************************************//
                                                    foreach ($neighbors as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <?php
                                                            if(!empty($_POST))
                                                            if ($_POST['submit'] == 'searchParams') {
                                                                // Only selected parameters
                                                                $patientParams = Patient::getPatientResultsById($key);
                                                            } else {
                                                                // All parameters
                                                                $patientParams = Patient::getAllPatientResultsById($key);
                                                            }
                                                            foreach ($patientParams[0] as $param_result) {
                                                                ?>
                                                                <td><?php echo $param_result; ?></td>
                                                                <?php
                                                            }
                                                            ?>
                                                            <td><?php echo round((1 / (1 + $value)) * 100, 4) . "%"; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
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
                        location.href = 'patient_info.php?id=';
                    });

                    // Without JQuery
                    var slider = new Slider("#numOfNeighborsSlider", {
                        tooltip: 'always',
                        tooltip_position: 'bottom'
                    });


                    var i = 1;

                    function addConstraint() {
                        if (i == 11) {
                            alert("Maximum 10 Parameters!");
                            return;
                        }

                        // Show search btn
                        if (i == 1) {
                            document.getElementById("searchParams").style.display = 'block';
                        }

                        var constraints = document.getElementById("constraints");
                        var constraint = constraints.options[constraints.selectedIndex].value;
                        var descriptions = document.getElementById("options");
                        var option = descriptions.options[descriptions.selectedIndex].value;
                        var table = document.getElementById("preview_table");

                        // Check if constraint already exists
                        for (var j = 1; j < i; j++) {
                            // Change the # in the table
                            var tableParam = table.rows[j].cells.item(1).innerHTML;
                            var tableTarget = table.rows[j].cells.item(2).innerHTML;
                            if (tableParam == constraint && tableTarget == option) {
                                alert("Already exists!");
                                return;
                            }
                        }

                        var row = table.insertRow((i));
                        var num = row.insertCell(0);
                        var param = row.insertCell(1);
                        var target = row.insertCell(2);
                        var btn = row.insertCell(3);
                        num.innerHTML = "" + i;
                        param.innerHTML = constraint;
                        target.innerHTML = option;
                        btn.innerHTML = "<button class='btn btn-danger' type='button' id='btn_" + i + "' onclick='deleteConstraint(" + i + ");'><i class='fa fa-trash'></i></button>";

                        // Add hidden input in order to POST it later
                        var params = document.getElementById('params');
                        var text = document.createElement('div');
                        text.innerHTML = "<input type='hidden' id='param_" + i + "' name='param_" + i + "' value='" + option + " " + constraint + "'/>";
                        params.appendChild(text);

                        i++;
                    }

                    function addConstraints() {
                        if (i == 11) {
                            alert("Maximum 10 Parameters!");
                            return;
                        }

                        // Show search btn
                        if (i == 1) {
                            document.getElementById("searchParams").style.display = 'block';
                        }

                        var constraints = document.getElementById("constraints");
                        var constraint = constraints.options[constraints.selectedIndex].value;
                        var table = document.getElementById("preview_table");

                        var options = ["Min", "Max", "Mean", "Median"];
                        var constraintsCount = 4;
                        // Check if constraint already exists
                        for(var deleteCount = 0; deleteCount < 4; deleteCount++) {
                            for (var j = 1; j < i; j++) {
                                // Change the # in the table
                                var tableParam = table.rows[j].cells.item(1).innerHTML;
                                var tableTarget = table.rows[j].cells.item(2).innerHTML;
                                if (tableParam == constraint && tableTarget == options[deleteCount]) {
                                    constraintsCount--;
                                    delete options[deleteCount];
                                }
                            }
                        }

                        if(constraintsCount == 0) {
                            alert("Already exist!");
                            return;
                        }

                        for(var j=0; j < constraintsCount; j++) {
                            var row = table.insertRow((i));
                            var num = row.insertCell(0);
                            var param = row.insertCell(1);
                            var target = row.insertCell(2);
                            var btn = row.insertCell(3);
                            num.innerHTML = "" + i;
                            param.innerHTML = constraint;
                            var check = j;
                            while(options[check] == undefined) {
                                check++;
                            }
                            target.innerHTML = options[check];
                            btn.innerHTML = "<button class='btn btn-danger' type='button' id='btn_" + i + "' onclick='deleteConstraint(" + i + ");'><i class='fa fa-trash'></i></button>";

                            // Add hidden input in order to POST it later
                            var params = document.getElementById('params');
                            var text = document.createElement('div');
                            text.innerHTML = "<input type='hidden' id='param_" + i + "' name='param_" + i + "' value='" + options[check] + " " + constraint + "'/>";
                            params.appendChild(text);

                            i++;

                            if (i == 11) {
                                return;
                            }
                        }
                    }

                    function addFromTo() {
                        var constraints = document.getElementById("constraints");
                        var constraint = constraints.options[constraints.selectedIndex].value;
                        var from = document.getElementById("from").value;
                        var to = document.getElementById("to").value;
                        var table = document.getElementById("preview_table");
                        var row = table.insertRow((i));
                        var num = row.insertCell(0);
                        var param = row.insertCell(1);
                        var target = row.insertCell(2);
                        var btn = row.insertCell(3);
                        num.innerHTML = "" + i;
                        param.innerHTML = constraint;
                        target.innerHTML = "[" + from + "-" + to + "]";
                        btn.innerHTML = "<button class='btn btn-danger' type='button' id='btn_" + i + "' onclick='deleteConstraint(" + i + ");'><i class='fa fa-trash'></i></button>";
                        i++;

                        // Clear the values in "from" and "to" inputs
                        document.getElementById("from").reset;
                        document.getElementById("to").reset;
                    }

                    function addOverUnder() {
                        var constraints = document.getElementById("constraints");
                        var constraint = constraints.options[constraints.selectedIndex].value;
                        var overUnderElement = document.getElementById("over_under");
                        var operand = overUnderElement.options[overUnderElement.selectedIndex].value;
                        var threshold = document.getElementById("threshold").value;
                        var table = document.getElementById("preview_table");
                        var row = table.insertRow((i));
                        var num = row.insertCell(0);
                        var param = row.insertCell(1);
                        var target = row.insertCell(2);
                        var btn = row.insertCell(3);
                        num.innerHTML = "" + i;
                        param.innerHTML = constraint;
                        target.innerHTML = operand + " " + threshold;
                        btn.innerHTML = "<button class='btn btn-danger' type='button' id='btn_" + i + "' onclick='deleteConstraint(" + i + ");'><i class='fa fa-trash'></i></button>";

                        i++;

                        // Clear the values in "from" and "to" inputs
                        document.getElementById("threshold").reset;
                    }

                    function deleteConstraint(index) {
                        document.getElementById("preview_table").deleteRow(index);
                        var param_to_remove = document.getElementById("param_" + index);
                        param_to_remove.parentNode.removeChild(param_to_remove);

                        var size = index + 1;
                        for (var j = size; j < i; j++) {
                            // Set the delete button
                            var const_delete_btn = document.getElementById("btn_" + j);
                            const_delete_btn.setAttribute("onclick", "deleteConstraint(" + (j - 1) + ");")
                            const_delete_btn.id = "btn_" + (j - 1);

                            // Set the param hidden input
                            var param_input = document.getElementById("param_" + j);
                            param_input.setAttribute("name", "param_" + (j - 1));
                            param_input.id = "param_" + (j - 1);

                            // Change the # in the table
                            document.getElementById("preview_table").rows[j - 1].cells.item(0).innerHTML = "" + (j - 1);
                        }

                        // Don't show search btn
                        if (i == 2) {
                            document.getElementById("searchParams").style.display = "none";
                        }


                        i--;
                    }

                </script>
</body>


</html>

