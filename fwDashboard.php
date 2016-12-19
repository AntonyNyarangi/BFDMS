<?php
//create server and database connection constants
$server = "localhost";
$user = "root";
$password = "48285";
$database = "BroilerFarmManagementSystem";

$con= new mysqli ($server,$user,$password, $database);

//Check server connection
if ($con->connect_error){
	die ("Failed to establish DB connection:". $con->connect_error);
}

$getmortalitybyhouse = "SELECT Houses.hseName, SUM(Mortality.number) as total FROM Mortality INNER JOIN Houses on Mortality.hse_ID = Houses.hse_ID GROUP BY Mortality.hse_ID";
$result = $con->query($getmortalitybyhouse);

$getnumberoflivebirdsperhouse = "SELECT Houses.hseName, Brood.CurrentSize FROM Brood INNER JOIN Houses on Brood.HouseAssigned = Houses.hse_ID GROUP BY Brood.HouseAssigned";
$result2 = $con->query($getnumberoflivebirdsperhouse);

$getinitialandcurrent = "SELECT Houses.hseName, Brood.InitialSize, SUM(Mortality.number) as mortality FROM Brood INNER JOIN Mortality INNER JOIN Houses on Brood.HouseAssigned = Mortality.hse_ID = Houses.hse_ID GROUP BY "
?>



<!DOCTYPE html>
<html>
<head>
	<title>Worker Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- jQuery UI -->
	<link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

	<!-- Bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- styles -->
	<link href="css/styles.css" rel="stylesheet">

	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link href="vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
	<link href="vendors/select/bootstrap-select.min.css" rel="stylesheet">
	<link href="vendors/tags/css/bootstrap-tags.css" rel="stylesheet">

	<link href="css/forms.css" rel="stylesheet">

</head>
<body>
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<!-- Logo -->
					<div class="logo">
						<h1><a href="fwDashboard.php">Farm Worker Portal</a></h1>
					</div>
				</div>
				<div class="col-md-5">

				</div>
				<div class="col-md-2">
					<div class="navbar navbar-inverse" role="banner">
						<nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
							<ul class="nav navbar-nav">
								<li>
									<a ><li><a href="login.html">Logout</a></li></a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-content">
		<div class="row">
			<div class="col-md-2">
				<div class="sidebar content-box" style="display: block;">
					<ul class="nav">
						<!-- Main menu -->
						<li><a href="fwDashboard.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
						<li class="submenu">
							<a href="#">
								<i class="glyphicon glyphicon-list"></i>Forms
								<span class="caret pull-right"></span>
							</a>
							<!-- Sub menu -->
							<ul>
								<li><a href="mortality.html">Mortality</a></li>
								<li><a href="feedConsumption.html">Feed Consumption</a></li>
								<!--li><a href="weight.html">Weight</a></li-->
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">
					<!--Calendar showing vaccination events  -->
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="content-box-large box-with-header">
									<!-- <div class="panel-heading"> -->
									<div class="panel-title">Calendar of Events</div>
									<!-- </div> -->
									<div class="panel-body">
										<iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showTz=0&amp;height=500&amp;wkst=1&amp;bgcolor=%23ccccff&amp;src=4npjbk00ff85he8ra7qjijgh0o%40group.calendar.google.com&amp;color=%23060D5E&amp;ctz=Africa%2FNairobi" style="border:solid 1px #777" width="1000" height="450" frameborder="0" scrolling="no"></iframe>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="content-box-large">
							<div class="panel-heading">
								<div class="panel-title">Mortality per House</div>
							</div>
							<div class="panel-body">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>House</th>
											<th>Total Mortality</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while ($row = $result->fetch_assoc()) {
											# code...
											echo "<tr>";
											echo "<td>".$row['hseName']."</td>";
											echo "<td>".$row['total']."</td>";
											echo "</tr>";
										}
										?>
									</tbody>
								</table>
								<b>Percentage Mortality: </b>
								<?php echo " "; ?>
								<br /><br />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="content-box-large">
							<div class="panel-heading">
								<div class="panel-title">Live Birds per House</div>
							</div>
							<div class="panel-body">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>House</th>
											<th>Live Birds</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while ($row2 = $result2->fetch_assoc()) {
											# code...
											echo "<tr>";
											echo "<td>".$row2['hseName']."</td>";
											echo "<td>".$row2['CurrentSize']."</td>";
											echo "</tr>";
										}
										?>
									</tbody>
								</table>
								<br/><br/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>





	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery.js"></script>
	<!-- jQuery UI -->
	<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<script src="vendors/form-helpers/js/bootstrap-formhelpers.min.js"></script>

	<script src="vendors/select/bootstrap-select.min.js"></script>

	<script src="vendors/tags/js/bootstrap-tags.min.js"></script>

	<script src="vendors/mask/jquery.maskedinput.min.js"></script>

	<script src="vendors/moment/moment.min.js"></script>

	<script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

	<!-- bootstrap-datetimepicker -->
	<link href="vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
	<script src="vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>


	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

	<script src="js/custom.js"></script>
	<script src="js/forms.js"></script>
</body>
</html>
