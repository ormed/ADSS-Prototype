<?php
include_once 'parts/header.php';
include_once 'database/Products.php';
include_once 'database/Inventory.php';
?>

<body>

<div id="wrapper">

    <?php include_once 'parts/nav.php'; ?>

    <!-- Page Content -->
    <div id="page-wrapper">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Search Similar Cases</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            </br>
            <!-- /.row -->
            <form action="all_patients.php">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Search
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form">
                                            <div class="form-group">
                                                <label>Syndrome 1</label>
                                                <input class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Syndrome 2</label>
                                                <input class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Syndrome 3 - Multiple Selects</label>

                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="">Option 1
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="">Option 2
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="">Option 3
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Syndrome 4 - 1 Select</label>
                                                <select class="form-control">
                                                    <option>0</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Syndrome 5 - Multiple Selects</label>
                                                <select multiple="" class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input class="form-control" maxlength="3"
                                                       onkeypress='return event.charCode >= 46 && event.charCode <= 57'>
                                            </div>
                                            <button type="submit" class="btn btn-outline btn-success">Search</button>
                                            <button type="reset" class="btn btn-outline btn-danger">Reset</button>
                                        </form>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
            </form>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>


</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php
include_once 'parts/bottom.php';
?>

</body>

</html>
