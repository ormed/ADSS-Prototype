<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'database/Patient.php'
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
                                    <div class="col-lg-6">
                                        <form class="form-inline col-xs-10 col-xs-offset-1" role="form">
                                            <div class="form-group">
                                                <label>Author: </label>
                                                <input class="form-control" id="author" type="text" placeholder="<?php echo $_SESSION['name'];?>" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <label>Date: </label>
                                                <input class="form-control" id="author" type="text" placeholder="<?php echo date("d/m/Y");?>" disabled="">
                                            </div>

                                            <div>
                                                <label class="radio-inline"><input type="radio" name="optradio" id="deselecctall" checked="checked">Target Patient(s)</label>
                                                <label class="radio-inline"><input type="radio" name="optradio" id="selecctall">ICU Population</label>
                                            </div>

                                            <?php
                                            $results = Patient::getPatients();
                                            ?>

                                            <div class="well" style="max-height: 300px;overflow: auto;">
                                                <?php
                                                foreach ($results as $result) {
                                                    echo "<input type='checkbox' class='checkbox1' name='check[]' value='$result[id]'> $result[id]<br>";
                                                }
                                                ?>
                                            </div>


                                            <legend>Add up to 5 constraints:</legend>
                                            <div class="form-group col-xs-offset-2">
                                                <select class="form-control" id="parameters">
                                                    <option value="MAP">MAP</option>
                                                    <option value="VAP">VAP</option>
                                                    <option value="BP">BP</option>
                                                    <option value="Glucose">Glucose</option>
                                                </select>
                                                <label for="user_lic">Threshold: </label><input id="threshold" type="number" min="0" max="100" step="1" value ="50"/>
                                            </div>

                                            <div class="col-xs-offset-3">
                                                <label class="radio-inline"><input type="radio" name="relative" checked="true" value=">">Over <i class="fa fa-chevron-right"></i></label>
                                                <label class="radio-inline"><input type="radio" name="relative" value="<">Under <i class="fa fa-chevron-left"></i></label>
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
                                            <button type="button" class="btn btn-default col-xs-offset-3" onclick="add_constraint();">Add Constraint</button>
                                        </form>
                                    </div>


                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                        <h1 class="col-xs-offset-5">Preview</h1>
                                        <form role="form">
                                            <fieldset>
                                                <div id="preview" class="center-block">

                                                </div>
                                                <button type="submit" class="btn btn-primary  center-block">Save</button>
                                            </fieldset>
                                        </form>

                                    </div>
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
                    var e = document.getElementById("interval");
                    var interval = e.options[e.selectedIndex].value;
                    var relative = document.querySelector('input[name = "relative"]:checked').value;
                    var threshhold = document.getElementById("threshold").value;
                    var parameter = document.getElementById("parameters").value;
                    document.getElementById("preview").innerHTML+="<div id='const_"+i+"' class='form-group input-group col-xs-4 col-xs-offset-4'><input type='text' class='form-control text-center' placeholder='"+parameter+" "+relative+" "+threshhold+" : "+interval+ "' disabled><span class='input-group-btn'><button class='btn btn-danger' type='button' onclick='remove_constraint("+i+");'><i class='fa fa-trash'></i></button></span></div>";
                }

                function remove_constraint(const_id) {
                    window.alert(i);
                    var constr = document.getElementById("const_"+const_id);
                    var preview = document.getElementById("preview");
                    preview.removeChild(constr);
                    for(var j=const_id+1; j<=i; j++)
                    {
                        document.getElementById("const_"+j).id = "const_"+(j-1);
                    }

                    i--;
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
                            $(this).prop('disabled', true);
                        });
                    });
                });

                $(document).ready(function() {
                    $('#deselecctall').click(function (event) {  //on click
                        $('.checkbox1').each(function () { //loop through each checkbox
                            this.checked = false; //deselect all checkboxes with class "checkbox1"
                            $(this).removeAttr("disabled");
                        });
                    });
                });


            </script>

</body>
</html>
