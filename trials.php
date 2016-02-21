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
                    <h1 class="page-header">Trials</h1>
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

                                    <legend>Enter Inclusion Criteria:</legend>

                                    <form class="form-inline col-xs-10 col-xs-offset-1" role="form">
                                        <div class="form-group">
                                            <label>Trial Name: </label>
                                            <input class="form-control" id="trial_name" type="text" placeholder="Enter text here...">
                                        </div>
                                        <div class="form-group">
                                            <label>Creation Date: </label>
                                            <input class="form-control" id="author" type="text" placeholder="<?php echo date("d/m/Y");?>" disabled="">
                                        </div>

                                        <p></p>
                                        <legend></legend>

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
                                            <button type="submit" class="btn btn-default">Submit</button>
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
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </div>

                                        <p></p>
                                        <legend></legend>

                                        <button type="submit" class="btn btn-default col-xs-offset-5">Create Trial</button>
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
