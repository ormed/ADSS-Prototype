<?php
//include_once 'connection/checkUser.php';
include_once 'parts/header.php';

$db = new Database();
if($db) {
    echo "Good";
}
else
{
    echo "Bad";
}
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
                                    <form class="form-inline col-xs-10 col-xs-offset-1" role="form">

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

                                        <button type="submit" class="btn btn-success col-xs-offset-5">Search</button>
                                    </form>
                                </div>


                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <h1 class="col-xs-offset-3">Preview</h1>
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



</body>
</html>
