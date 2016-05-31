<?php
include_once 'connection/checkUser.php';
include_once 'database/Notification.php';

include_once 'parts/header.php';

$err = '';
$success = '';

// ************** Delete the alert **************//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Parse the $_POST['delete_*id*'] to get the *id* only
    $notificationId = explode("_", key(array_intersect_key($_POST, array_flip(preg_grep('/^delete_/', array_keys($_POST))))))[1];
    Notification::deleteNotification($notificationId);
    header('Location: alarm.php');
}
//else {

//$results = Notification::getNotifications();

// Delete old notifications
Notification::deleteOldNotifications();

$results = Notification::getNotifications();

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

            <form role="form" id="alerts_form" method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Recent Events List
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <div class="list-group">

                                <button
                                    type="button" class="btn btn-success btn-success btn-xs"
                                    onclick="window.location='new_alarm.php'">Add New Alarm
                                </button>
                                <p></p>
                                <!-- </br></br>

                               -- <input type="text" name="searchAlert" id="searchAlert" class="form-control"  placeholder="Search">
                                 -->
                                <datalist id="datalist1">
                                    <?php
                                    foreach ($results as $value) {
                                    ?>
                                    <option value="<?php echo $value['title']; ?>">
                                        <?php
                                        }
                                        ?>

                                </datalist>

                                </br>

                                <?php
                                $i = 0;
                                foreach ($results as $value) {

                                    $createdTime = new DateTime($value['created_time']);
                                    date_default_timezone_set('Asia/Tel_Aviv');
                                    $currentTime = new DateTime();

                                    $diff = get_timespan_string($createdTime, $currentTime);
                                    if ($diff == FALSE) {
                                        $dateToDisplay = date_format($createdTime, 'd/m/Y H:i');
                                    } else {
                                        $dateToDisplay = $diff . " ago";
                                    }

                                    if($i == 0) {
                                    ?>
                                        <div class="panel-group" id="accordion">
                                    <?php
                                    }
                                    ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <div data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $value['id']; ?>">

                                                        <?php echo $value['title']; ?> <em>by <?php echo $value['author']; ?></em>
                                                        <span class="pull-right text-muted small"><em><?php echo $dateToDisplay; ?></em>
                                                        </span>
                                                    </div>
                                                </h4>
                                            </div>
                                            <div id="collapse<?php echo $value['id']; ?>" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <?php if($value['author'] == $_SESSION['name'] || $_SESSION['auth'] == 1) { ?>
                                                    <button type="button" class="btn btn-warning btn-warning btn-xs" onclick="location.href = 'edit_alarm.php?id=<?php echo $value['id']; ?>';">
                                                            <i class="fa fa-pencil-square-o"></i> Edit
                                                    </button>

                                                    <button
                                                        type="submit" class="btn btn-danger btn-danger btn-xs"
                                                        name="delete_<?php echo $value['id']; ?>" onclick="return confirm('Are you sure you want to delete this alert?');"><i
                                                            class="fa fa-times"></i> Delete
                                                    </button>
                                                    <?php } ?>
                                                    <p></p>
                                                    <?php
                                                    // Display the constraints
                                                    $parts = explode(" ", $value['content']);
                                                    $ids = explode("id:", $parts[0])[1];
                                                    $ids = str_replace(",",", ", $ids);

                                                    echo "<b>Ids:</b></br>";
                                                    ?>
                                                    <textarea class='form-control' style="resize: vertical;" readonly><?php echo $ids; ?></textarea>
                                                    <?php
                                                    echo "</br><b>Constraints:</b></br>";

                                                    $constraints = $parts[1];
                                                    $parts = explode("constraints:", $constraints);
                                                    $constraints = explode(".", $parts[1]);
                                                    foreach($constraints as $constraint) {
                                                        if(!empty($constraint)) {
                                                            $constraint = str_replace("for-", " : ", $constraint);
                                                            echo "<div class='form-group input-group col-xs-3 col-md-3 col-lg-3'>
                                                                    <input type='text' class='form-control' size='50' value='".$constraint."' readonly>
                                                                  </div>";
                                                        }
                                                    }
                                                    ?>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    $i=1;
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->

                        <span id="demo"></span>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /#page-wrapper -->

                </div>
                <!-- /#wrapper -->
            </form>

        </div>
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
         * Remove alert from page and database
         */
        function deleteAlert() {
            var el = document.getElementById('alerts_form');

            el.addEventListener('submit', function(){
                return confirm('Are you sure you want to delete the alert?');
            }, false);
        }
    </script>

</body>
</html>
<?php
//}
?>
