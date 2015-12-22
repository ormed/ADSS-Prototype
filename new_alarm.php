<?php
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
                                                <label class="radio-inline"><input type="radio" name="optradio" checked="checked">Target Patient(s)</label>
                                                <label class="radio-inline"><input type="radio" name="optradio">ICU Population</label>
                                            </div>

                                            <div class="well" style="max-height: 300px;overflow: auto;">
                                                <ul class="list-group checked-list-box">
                                                    <li class="list-group-item">Israel Israeli</li>
                                                    <li class="list-group-item">Israela Israeli</li>
                                                    <li class="list-group-item">John Doe</li>
                                                    <li class="list-group-item">Jane Doe</li>
                                                    <li class="list-group-item">Jane Doe</li>
                                                    <li class="list-group-item">Jane Doe</li>
                                                    <li class="list-group-item">Jane Doe</li>

                                                </ul>
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

                function cancelChanges(index) {

                }

                $(function () {
                    $('.list-group.checked-list-box .list-group-item').each(function () {

                        // Settings
                        var $widget = $(this),
                            $checkbox = $('<input type="checkbox" class="hidden"/>'),
                            color = ($widget.data('color') ? $widget.data('color') : "primary"),
                            style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
                            settings = {
                                on: {
                                    icon: 'glyphicon glyphicon-check'
                                },
                                off: {
                                    icon: 'glyphicon glyphicon-unchecked'
                                }
                            };

                        $widget.css('cursor', 'pointer')
                        $widget.append($checkbox);

                        // Event Handlers
                        $widget.on('click', function () {
                            $checkbox.prop('checked', !$checkbox.is(':checked'));
                            $checkbox.triggerHandler('change');
                            updateDisplay();
                        });
                        $checkbox.on('change', function () {
                            updateDisplay();
                        });


                        // Actions
                        function updateDisplay() {
                            var isChecked = $checkbox.is(':checked');

                            // Set the button's state
                            $widget.data('state', (isChecked) ? "on" : "off");

                            // Set the button's icon
                            $widget.find('.state-icon')
                                .removeClass()
                                .addClass('state-icon ' + settings[$widget.data('state')].icon);

                            // Update the button's color
                            if (isChecked) {
                                $widget.addClass(style + color + ' active');
                            } else {
                                $widget.removeClass(style + color + ' active');
                            }
                        }

                        // Initialization
                        function init() {

                            if ($widget.data('checked') == true) {
                                $checkbox.prop('checked', !$checkbox.is(':checked'));
                            }

                            updateDisplay();

                            // Inject the icon if applicable
                            if ($widget.find('.state-icon').length == 0) {
                                $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
                            }
                        }
                        init();
                    });

                    $('#get-checked-data').on('click', function(event) {
                        event.preventDefault();
                        var checkedItems = {}, counter = 0;
                        $("#check-list-box li.active").each(function(idx, li) {
                            checkedItems[counter] = $(li).text();
                            counter++;
                        });
                        $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
                    });
                });

                function selectAllPatients()
                {
                    document.getElementById('myCheck1').setAttribute('data-checked', "true");
                }
            </script>

</body>
</html>
