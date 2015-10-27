<?php 
//include_once 'connection/checkUser.php';
include_once 'parts/header.php';
include_once 'database/Products.php';
include_once 'database/Balance.php';
include_once 'database/Customer.php';
include_once 'database/Invoice.php';
include_once 'database/Order.php';
?>

<body>

	<div id="wrapper">
        <?php include_once 'parts/nav.php';?>
        <!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Prototype System</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<div class="row">
	                <div class="col-lg-3 col-md-6">
	                    <div class="panel panel-red">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="fa fa-exclamation-triangle fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div class="huge">2</div>
	                                    <div>New Alerts</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="alerts.php">
	                            <div class="panel-footer">
	                                <span class="pull-left">View All Alerts</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
	                <div class="col-lg-3 col-md-6">
	                    <div class="panel panel-green">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                	<i class="fa fa-users fa-5x"></i>        
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div class="huge">3</div>
	                                    <div>Rounds This Week</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="rounds.php">
	                            <div class="panel-footer">
	                                <span class="pull-left">View All Rounds</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
            </div>
            <div class="row">
	               <div class="col-lg-3 col-md-6">
	                    <div class="panel panel-yellow">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                	<i class="fa fa-binoculars fa-5x"></i>        
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div class="huge">Similar</div>
	                                    <div>Cases</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="similar_cases.php">
	                            <div class="panel-footer">
	                                <span class="pull-left">Search Similar Cases</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
	                <div class="col-lg-3 col-md-6">
	                    <div class="panel panel-primary">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                	<i class="fa fa-history fa-5x"></i>        
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div class="huge">Simulation</div>
	                                    <div>Module</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="graphs.php">
	                            <div class="panel-footer">
	                                <span class="pull-left">View All Simulations</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
            </div>

			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->

    
<?php include_once 'parts/bottom.php';?>

</body>

</html>
