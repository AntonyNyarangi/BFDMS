<?php
// ---------- Database connection ----------
$server   = "localhost:3306";
$user     = "root";
$password = "abcd1234";
$database = "PoultryFarmManagementSystem";

$con = new mysqli($server, $user, $password, $database);
if ($con->connect_error) {
    die("DB connection failed: " . $con->connect_error);
}

// ---------- Handle form submission ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date          = $_POST['date'] ?? null;
    $size          = isset($_POST['size']) ? (int)$_POST['size'] : 0;
    $houseassigned = isset($_POST['houseassigned']) ? (int)$_POST['houseassigned'] : 0;

    if ($date && $size > 0 && $houseassigned > 0) {
        // Insert with status = 1 by default
        $stmt = $con->prepare("
            INSERT INTO Brood (Date, InitialSize, CurrentSize, HouseAssigned, status) 
            VALUES (?, ?, ?, ?, 0)
        ");
        $stmt->bind_param("siii", $date, $size, $size, $houseassigned);

        if ($stmt->execute()) {
            echo "<script>alert('Brood registered successfully!');</script>";
        } else {
            echo "<script>alert('Error saving brood: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please fill all fields correctly.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>New Brood</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- styles -->
	<link href="css/styles.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="logo">
						<h1><a href="index.html">Farm Manager's Portal</a></h1>
					</div>
				</div>
				<div class="col-md-2">
					<div class="navbar navbar-inverse" role="banner">
						<nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
							<ul class="nav navbar-nav">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
									<ul class="dropdown-menu animated fadeInUp">
										<li><a href="profile.html">Profile</a></li>
										<li><a href="login.html">Logout</a></li>
									</ul>
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
						<li class="current"><a href="index.html"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
						
						<li class="submenu">
							<a href="#"><i class="glyphicon glyphicon-list"></i> Forms<span class="caret pull-right"></span></a>
							<ul>
								<li><a href="mortalityADMIN.html">Mortality</a></li>
								<li><a href="feedConsumptionADMIN.html">Feed Consumption</a></li>
							</ul>
						</li>
						
						<li class="submenu">
							<a href="#"><i class="glyphicon glyphicon-list"></i> Reports<span class="caret pull-right"></span></a>
							<ul>
								<li><a href="mortalityReport.html">Mortality</a></li>
								<li><a href="feedConsumptionReport.html">Feed Consumption</a></li>
							</ul>
						</li>
						
						<li class="submenu">
							<a href="#"><i class="glyphicon glyphicon-list"></i> Broods<span class="caret pull-right"></span></a>
							<ul>
								<li><a href="viewbroods.php">View Broods</a></li>
								<li><a href="newbrood.php">New Brood</a></li>
							</ul>
						</li>
						
						<li class="submenu">
							<a href="#"><i class="glyphicon glyphicon-list"></i> Users<span class="caret pull-right"></span></a>
							<ul>
								<li><a href="viewusers.html">View Users</a></li>
								<li><a href="createUser.html">Create New</a></li>
							</ul>
						</li>
						
						<li class="submenu">
							<a href="#"><i class="glyphicon glyphicon-list"></i> Houses<span class="caret pull-right"></span></a>
							<ul>
								<li><a href="viewhouses.html">View Houses</a></li>
								<li><a href="newhouse.html">New House</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>

			<div class="col-md-6">
				<div class="content-box-large">
					<div class="panel-heading">
						<div class="panel-title">Brood registration, enter details below.</div>
					</div>
					<div class="panel-body">
						<form action="newbrood.php" method="post" name="newbrood">
						  <fieldset>
						    <div class="form-group">
						      <label>Date (Day they were brought to the farm)</label>
						      <input class="form-control" id="datefield" type="date" name="date" required>
						    </div>
						    <div class="form-group">
						      <label>Number of birds</label>
						      <input class="form-control" type="number" name="size" min="1" required>
						    </div>
						    <div class="form-group">
						      <label>Assign House</label>
						      <select class="form-control" name="houseassigned" required>
						        <option value="">-- Select House --</option>
						        <?php
						        $result = $con->query("SELECT hse_ID, hseName FROM Houses");
						        if ($result) {
						          while ($row = $result->fetch_assoc()) {
						            echo "<option value='" . $row['hse_ID'] . "'>" . htmlspecialchars($row['hseName']) . "</option>";
						          }
						        }
						        ?>
						      </select>
						    </div>
						  </fieldset>
						  <input type="submit" class="btn btn-primary signup" value="Submit">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

  <script>
  	// Set default date to today
  	var today = new Date();
  	var dd = today.getDate();
  	var mm = today.getMonth()+1;
  	var yyyy = today.getFullYear();
  	if(dd<10){ dd='0'+dd }
  	if(mm<10){ mm='0'+mm }
  	document.getElementById("datefield").setAttribute("value", yyyy+'-'+mm+'-'+dd);
  </script>

	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>
