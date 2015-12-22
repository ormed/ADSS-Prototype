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
                    <h1 class="page-header">Search Case Form</h1>
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
                                            <fieldset>
                                            <legend> Lab Result: </legend>
                                                <div class="form-group">

                                                </div>
                                            </fieldset>

                                            <fieldset>
                                                <legend> Vital Sign: </legend>
                                                <div class="form-group">

                                                </div>
                                            </fieldset>

                                            <fieldset>
                                                <legend> Demographics: </legend>

                                            </fieldset>

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
