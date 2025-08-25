<?php
//create server and database connection constants
$server = "localhost:3306";
$user = "root";
$password = "#Mokaya232";
$database = "PoultryFarmManagementSystem";

$con= new mysqli ($server,$user,$password, $database);

//Check server connection
if ($con->connect_error){
  die ("Failed to establish DB connection:". $con->connect_error);
}else{


  $houses = $con->query("SELECT * FROM Houses");
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Mortality Entry</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- styles -->
	<link href="css/styles.css" rel="stylesheet">
	<script src="js/Chart.min.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<!-- Logo -->
					<div class="logo">
						<h1><a href="index.html">Manager Portal</a></h1>
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
						<li class="current"><a href="index.html"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>

            <li class="submenu">
							<a href="#">
								<i class="glyphicon glyphicon-list"></i> Forms
								<span class="caret pull-right"></span>
							</a>
							<!-- Sub menu -->
							<ul>
								<li><a href="mortalityADMIN.php">Mortality</a></li>
								<li><a href="feedConsumptionADMIN.php">Feed Consumption</a></li>
							</ul>
						</li>

            <li class="submenu">
							<a href="#">
								<i class="glyphicon glyphicon-list"></i> Reports
								<span class="caret pull-right"></span>
							</a>
							<!-- Sub menu -->
							<ul>
								<li><a href="mortalityReport.php">Mortality</a></li>
								<li><a href="feedConsumptionReport.php">Feed Consumption</a></li>
							</ul>
						</li>

						<li class="submenu">
              <a href="#">
                <i class="glyphicon glyphicon-list"></i> Broods
                <span class="caret pull-right"></span>
              </a>
              <!-- Sub menu -->
              <ul>
                <li><a href="viewbroods.php">View Broods</a></li>
                <li><a href="newbrood.php">New Brood</a></li>
              </ul>
            </li>

						<li class="submenu">
							<a href="#">
								<i class="glyphicon glyphicon-list"></i> Users
								<span class="caret pull-right"></span>
							</a>
							<!-- Sub menu -->
							<ul>
								<li><a href="viewusers.php">View Users</a></li>
								<li><a href="createUser.html">Create New</a></li>
							</ul>
						</li>

						<li class="submenu">
							<a href="#">
								<i class="glyphicon glyphicon-list"></i> Houses
								<span class="caret pull-right"></span>
							</a>
							<!-- Sub menu -->
							<ul>
								<li><a href="viewhouses.php">View Houses</a></li>
								<li><a href="newhouse.html">New House</a></li>
							</ul>
						</li>



					</ul>
				</div>
			</div>

			<div class="col-md-6">
				<div class="content-box-large">
					<div class="panel-heading">
						<div class="panel-title">Mortality Record, please fill all fields</div>
					</div>
					<div class="panel-body">
						<form onsubmit="return validateNumberFields()" action ="mortality.php" method = "post" name = "mortality" required>
							<fieldset>
								<div class="form-group">
									<label>Date NB: You can only enter today's date</label>
									<input class ="form-control" id="datefield" type="date" name="date" max = "11" required>
								</div>
								<div class="form-group">
									<label>Number of Dead Birds</label>
									<input class="form-control" type="text" name="number" required>
								</div>
								<div class = "form-group">
									<label>House</label>
									<p>
										<select class="selectpicker" name="house" required>
											<?php
											while($fetchedhouses = $houses->fetch_assoc()){ ?>
												<option value ="<?php echo $fetchedhouses['hse_ID']; ?>"><?php echo $fetchedhouses['hseName']; ?></option>
												<?php  }
												?>
										</select>
									</p>
								</div>
								<div class="form-group">
									<label>Remarks</label>
									<textarea class="form-control" rows="3" name="remark"></textarea>
								</div>

							</fieldset>
							<input type="submit" class = "btn btn-primary signup" value="Submit" ></tab>
						</form>
					</div>
				</div>
			</div>




		</div>
	</div>
</div>

<footer>
	<div class="container">
		<div class="copy text-center">
			PFMS
		</div>
	</div>
</footer>

<script>
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	if(dd<10){
		dd='0'+dd
	}
	if(mm<10){
		mm='0'+mm
	}

	today = yyyy+'-'+mm+'-'+dd;
	document.getElementById("datefield").setAttribute("max", today);
	document.getElementById("datefield").setAttribute("value", today);
</script>
<script>
	function validateNumberFields() {
		var x = document.mortality.number.value;
		if (/[^\d\.]/.test(x)) {
			alert("Number of Dead Birds must be a number");
			document.mortality.number.focus();
			document.mortality.number.style.borderColor = "red";
			return false;
		}
	}
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
