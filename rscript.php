<?php
include_once 'connection/checkUser.php';
include_once 'parts/header.php';

$err = '';
$success = '';
$result = '';

//check if postback
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if file already exists
    /*if (file_exists($target_file)) {
        $err = "Sorry, file already exists.";
        $uploadOk = 0;
    }*/
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $err = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if( $fileType != "R" ) {
        $err = "Sorry, only R files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $err = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $success = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded successfully";
        } else {
            $err = "Sorry, there was an error uploading your file.";
        }
    }
}

if (($_SERVER["REQUEST_METHOD"] == "POST") && empty($err)) {
    chdir("C:/Program Files/R/R-3.2.3/bin/i386");
    $result = shell_exec("Rscript ".$_FILES["fileToUpload"]["name"]);
    if(empty($result))
    {

        //$result = "<embed width='100%' height='100%' src='http://localhost/ADSS-Prototype/uploads/Rplots.pdf' type='application/pdf'></embed>";
    }
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
                    <h1 class="page-header">Run Algorithm</h1>
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
                                    <legend>Upload R File:</legend>
                                    <?php if (!empty($err)) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign"
                                                  aria-hidden="true"></span>
                                            <?php echo $err ?>
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($success)) { ?>
                                        <div class="alert alert-success" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign"
                                                  aria-hidden="true"></span>
                                            <?php echo $success ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (!empty($result)) { ?>
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    Result
                                                </div>
                                                <div class="panel-body">
                                                    <?php echo $result ?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    <form role="form" method="POST" enctype="multipart/form-data" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                                    <div class="form-group">
                                        <select id="algorithm" name="algorithm" class="form-control">
                                            <option>SOFA</option>
                                            <option>Morbidity</option>
                                            <option>New</option>
                                        </select>
                                        <div id="new_algo" style="display: none;">
                                            <p></p>
                                            <select id="algorithm" name="algorithm" class="form-control">
                                                <option>Retro</option>
                                                <option>Pre</option>
                                            </select>
                                            <p></p>
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                        </div>
                                    </div>
                                        <p></p>
                                        <input type="submit" class="btn btn-success" value="Submit" name="submit">
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <script type="text/javascript">
                    window.onload = function() {
                        var eSelect = document.getElementById('algorithm');
                        var totalAlgorithms = eSelect.options.length-1;
                        var optOtherReason = document.getElementById('new_algo');
                        eSelect.onchange = function() {
                            if(eSelect.selectedIndex === totalAlgorithms) {
                                optOtherReason.style.display = 'block';
                            } else {
                                optOtherReason.style.display = 'none';
                            }
                        }
                    }
                </script>


                <?php
                include_once 'parts/bottom.php';
               // }
                ?>
</body>
</html>
