<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'database/Patient.php';
include_once 'database/Notification.php';


$err = '';
$id_error ='';
$name_error = '';

// check if post back
if (isset($_GET['id'])) {
    // Parse the $_GET['id'] so it disables injection
    $id =  filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

    // Get the notification info
    $result = Notification::getNotification($id);

    if ($result == FALSE) {
        // Invalid id
        header('Location: alarm.php');
    }

    if ($result[0]['author'] != $_SESSION['name']) {
        if ($_SESSION['auth'] != 1) {
            // Not valid user
            $message = "You don't have permissions!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header('Location: alarm.php');
        }
    }

    // Get the parts from database
    $parts = explode(" ", $result[0]['content']);
    $ids = explode("id:", $parts[0])[1];
    $ids = explode(",", $ids);

    $constraints = $parts[1];
    $parts = explode("constraints:", $constraints);
    debug($parts);
    $constraints = explode(".", $parts[1]);
    debug($constraints);

}

if(($_SERVER["REQUEST_METHOD"] == "POST") && empty($id_error) && empty($name_error)) {
    // Split the constraints
    $constraints = Notification::getConstraints();

    // Create the content string
    $content = $ids . " ".$constraints;

    // Insert the notification to database
    Notification::insertNotification($content);

    header('Location: alarm.php');
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
                    <h1 class="page-header">Alerts</h1>
                </div>
                <!-- /.col-lg-12 -->

                    <button type="button" class="btn btn-outline btn-primary"  onclick="location.href = 'alarm.php';">
                      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back
                    </button>


                    <p></p>

            </div>
            <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                New Notifier
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <form class="form-inline col-xs-10 col-xs-offset-1" role="form" method="POST" enctype="multipart/form-data" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                                    <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Author: </label>
                                                <input class="form-control" name="author" type="text" value="<?php echo $result[0]['author'];?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Date: </label>
                                                <input class="form-control" name="current_date" type="text" value="<?php echo date("d/m/Y");?>" readonly>
                                            </div>

                                            <p></p>

                                            <div class='form-group <?php echo (!empty($name_error) ? "has-error" : "")?>'>
                                                <label>Alert Name: </label>
                                                <input class="form-control" name="alert_name" type="text" placeholder="Alert name" <?php echo ((isset($_POST['alert_name'])) ?  "value='".$_POST['alert_name']."'" : "value='".$result[0]['title']."'");?>><?php if(!empty($name_error)) { ?><i class="fa fa-exclamation-circle fa-fw" style="color:darkred"></i><?php } ?>


                                            </div>

                                            <p></p>

                                            <div class='<?php echo (!empty($id_error) ? "alert alert-danger" : "") ?>'>
                                                <?php if(!empty($id_error)) { ?>
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                Select patient/s.
                                                <?php } ?>
                                                <div>
                                                    <label class="radio-inline"><input class="panel panel-danger" type="radio" name="optradio" id="deselecctall" value="not_all" checked="checked">Target Patient(s)</label>
                                                    <label class="radio-inline"><input type="radio" name="optradio" id="selecctall" value="all">ICU Population</label>
                                                </div>

                                            <?php
                                            $results = Patient::getPatients();
                                            ?>


                                                <div class="well" style="max-height: 300px;overflow: auto;">
                                                    <?php
                                                    foreach ($results as $result) {
                                                        if(in_array($result['id'], $ids)) {
                                                            echo "<input type='checkbox' class='checkbox1' name='check[]' value='$result[id]' checked> $result[id]<br>";
                                                        } else {
                                                            echo "<input type='checkbox' class='checkbox1' name='check[]' value='$result[id]'> $result[id]<br>";
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>


                                            <legend>Add up to 5 constraints:</legend>
                                            <div class="form-group col-xs-offset-2">
                                                <select class="form-control" id="parameters">
                                                    <option value="MAP">MAP</option>
                                                    <option value="VAP">VAP</option>
                                                    <option value="BP">BP</option>
                                                    <option value="Glucose">Glucose</option>
                                                </select>
                                                <label for="user_lic">Threshold: </label><input id="threshold" type="number" min="0" step="1" value ="50"/>
                                            </div>

                                            <div class="col-xs-offset-3">
                                                <label class="radio-inline"><input type="radio" name="relative" checked="true" value=">">Over (<i class="fa fa-chevron-right"></i>)</label>
                                                <label class="radio-inline"><input type="radio" name="relative" value="<">Under (<i class="fa fa-chevron-left"></i>)</label>
                                            </div>

                                            <div class="col-xs-offset-2">
                                                <span>Interval to monitor: </span>
                                                <select class="form-control" id="interval">
                                                    <option value="24h">24h</option>
                                                    <option value="48h">48h</option>
                                                    <option value="72h">72h</option>
                                                    <option value="&infin;">Until Discharge</option>
                                                </select>
                                            </div>

                                            <p></p>

                                            <button type="button" class="btn btn-default col-xs-offset-3" onclick="add_constraint();">Add Constraint</button>
                                    </div>


                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                        <h1 class="col-xs-offset-5">Preview</h1>
                                            <fieldset>
                                                <div id="preview" class="center-block">
                                                <?php
                                                $i = 1;
                                                foreach($constraints as $constraint) {
                                                        if(!empty($constraint)) {
                                                            $constraint = str_replace("for-", " : ", $constraint);
                                                            echo "<div id='const_".$i."' class='form-group input-group col-xs-4 col-xs-offset-4'><input type='text' class='form-control text-center' id='input_".$i."' name='input_".$i."' value='".$constraint."' readonly><span class='input-group-btn'><button class='btn btn-danger' type='button' id='delete_".$i."' onclick='remove_constraint(".$i.");'><i class='fa fa-trash'></i></button></span></div><p></p>";
                                                            $i++;
                                                        }
                                                    }
                                                ?>
                                                </div>

                                                <button type="submit" class="btn btn-primary  center-block" id="saveBtn">Save</button>
                                            </fieldset>
                                    </div>

                                    </form>
                                    <!-- /.col-lg-6 (nested) -->
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
                $(document).ready(function () {
                    $('#dataTables-example').DataTable({
                        responsive: true
                    });
                });

                /**
                 * Add constraint to the preview
                 * If it has more than 5 constraints it does nothing
                 */
                var i = 0;
                function add_constraint() {
                    if(i >= 5) {
                        window.alert("Maximum 5 constraints")
                        return; } // break if already has 5 constraints
                    i++;
                    document.getElementById("saveBtn").style.display = "block";
                    var e = document.getElementById("interval");
                    var interval = e.options[e.selectedIndex].value;
                    var relative = document.querySelector('input[name = "relative"]:checked').value;
                    var threshhold = document.getElementById("threshold").value;
                    var parameter = document.getElementById("parameters").value;
                    document.getElementById("preview").innerHTML+="<div id='const_"+i+"' class='form-group input-group col-xs-4 col-xs-offset-4'><input type='text' class='form-control text-center' id='input_"+i+"' name='input_"+i+"' value='"+parameter+" "+relative+" "+threshhold+" : "+interval+ "' readonly><span class='input-group-btn'><button class='btn btn-danger' type='button' id='delete_"+i+"' onclick='remove_constraint("+i+");'><i class='fa fa-trash'></i></button></span></div><p></p>";
                }

                /**
                 * Delete constraint from the preview
                 * @param const_id - the constraint id to delete
                 */
                function remove_constraint(const_id) {
                    var constr = document.getElementById("const_"+const_id);
                    var preview = document.getElementById("preview");
                    preview.removeChild(constr);
                    var size = const_id+1;
                    for(var j=size; j<i; j++)
                    {
                        // Set the delete button
                        var const_delete_btn = document.getElementById("delete_"+j);
                        const_delete_btn.setAttribute("onclick","remove_constraint("+(j-1)+");")
                        const_delete_btn.id = "delete_"+(j-1);

                        // Set the div id
                        var const_div = document.getElementById("const_"+j);
                        const_div.id = "const_"+(j-1);

                        // Set the input name
                        var const_input = document.getElementById("input_"+j);
                        const_input.setAttribute("name", "input_"+(j-1));
                        const_input.id = "input_"+(j-1);

                    }

                    i--;
                    if(i == 0) {
                        document.getElementById("saveBtn").style.display = "none";
                    }
                }

                /*function areYouSure(index) {
                    var x = " Removed alert #" + index;
                    if (confirm("Are you sure?") == true) {
                        document.getElementById(index).remove();
                    }
                    document.getElementById("demo").innerHTML = x;
                }

                function editAlert(index) {
                    document.getElementById(index).remove();
                    document.getElementById(index+"edit").remove();
                }

                function saveChanges(index) {
                    // Save the new text
                    document.getElementById(index).value =
                        // Make it visible

                        // Make the edit invisible
                        document.getElementById("1desc").value = "Test";
                }

                function selectFunction (checkall,field)
                {
                    if(checkall.checked==true){
                        for (i = 0; i < field.length; i++)
                            field[i].checked = true ;
                    }else{
                        for (i = 0; i < field.length; i++)
                            field[i].checked = false ;
                    }
                }*/

                $(document).ready(function() {
                    $('#selecctall').click(function(event) {  //on click
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = true;  //select all checkboxes with class "checkbox1"
                            //$(this).prop('readonly', true);
                        });
                    });
                });

                $(document).ready(function() {
                    $('#deselecctall').click(function (event) {  //on click
                        $('.checkbox1').each(function () { //loop through each checkbox
                            this.checked = false; //deselect all checkboxes with class "checkbox1"
                            //$(this).removeAttr("readonly");
                        });
                    });
                });


            </script>

</body>
</html>
<?php
}
?>
