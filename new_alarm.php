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
                                                <input class="form-control" id="author" type="text" placeholder="Dr Israel Israeli" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <label>Date: </label>
                                                <input class="form-control" id="author" type="text" placeholder="<?php echo date("d/m/Y");?>" disabled="">
                                            </div>

                                            <div>
                                                <label class="radio-inline"><input type="radio" name="optradio" id="deselecctall" checked="checked">Target Patient(s)</label>
                                                <label class="radio-inline"><input type="radio" name="optradio" id="selecctall">ICU Population</label>
                                            </div>

                                            <div class="well" style="max-height: 300px;overflow: auto;">
                                                <input type="checkbox" class="checkbox1" name="check[]" value="1"> Israel Israeli<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="2"> Israela Israeli<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="3"> John Doe<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="4"> Israela Israeli<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="5"> Jane Doe<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="6"> Jane Doe<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="7"> Israel Israeli<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="8"> Israela Israeli<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="9"> John Doe<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="10"> Israela Israeli<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="11"> Jane Doe<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="12"> Jane Doe<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="13"> Israel Israeli<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="14"> Israela Israeli<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="15"> John Doe<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="16"> Israela Israeli<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="17"> Jane Doe<br>
                                                <input type="checkbox" class="checkbox1" name="check[]" value="18"> Jane Doe<br>
                                            </div>


                                            <legend>Add up to 5 constraints:</legend>
                                            <div class="form-group col-xs-offset-2">
                                                <select class="form-control">
                                                    <option>MAP</option>
                                                    <option>VAP</option>
                                                    <option>BP</option>
                                                    <option>Glucose</option>
                                                </select>
                                                <label for="user_lic">Threshold: </label><input id="threshold" type="number" min="0" max="100" step="1" value ="50"/>
                                            </div>

                                            <div class="col-xs-offset-3">
                                                <label class="radio-inline"><input type="radio" name="optradio2" checked="true">Over <i class="fa fa-chevron-right"></i></label>
                                                <label class="radio-inline"><input type="radio" name="optradio2" >Under <i class="fa fa-chevron-left"></i></label>
                                            </div>

                                            <div class="col-xs-offset-2">
                                                <span>Interval to monitor: </span>
                                                <select class="form-control">
                                                    <option>24h</option>
                                                    <option>48h</option>
                                                    <option>72h</option>
                                                    <option>Until Discharge</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-default col-xs-offset-3">Add Constraint</button>
                                        </form>
                                    </div>


                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                        <h1 class="col-xs-offset-3">Preview</h1>
                                        <form role="form">
                                            <fieldset>
                                                <div class="form-group input-group col-xs-4 col-xs-offset-2">
                                                    <input type="text" class="form-control text-center" placeholder="MAP > 95" disabled="">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                    </span>
                                                </div>
                                                <div class="form-group input-group col-xs-4 col-xs-offset-2">
                                                    <input type="text" class="form-control text-center" placeholder="VAP < 90" disabled="">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                    </span>
                                                </div>
                                                <div class="form-group input-group col-xs-4 col-xs-offset-2">
                                                    <input type="text" class="form-control text-center" placeholder="BP > 120" disabled="">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                    </span>
                                                </div>

                                                <button type="submit" class="btn btn-primary  col-xs-offset-5">Save</button>
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

                function areYouSure(index) {
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
                    window.alert("Hey");
                    if(checkall.checked==true){
                        for (i = 0; i < field.length; i++)
                            field[i].checked = true ;
                    }else{
                        for (i = 0; i < field.length; i++)
                            field[i].checked = false ;
                    }
                }

                $(document).ready(function() {
                    $('#selecctall').click(function(event) {  //on click
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = true;  //select all checkboxes with class "checkbox1"
                        });
                    });
                });

                $(document).ready(function() {
                    $('#deselecctall').click(function (event) {  //on click
                        $('.checkbox1').each(function () { //loop through each checkbox
                            this.checked = false; //deselect all checkboxes with class "checkbox1"
                        });
                    });
                });


            </script>

</body>
</html>
