<?php
//create server and database connection constants
$server = "localhost";
$user = "root";
$password = "password";
$database = "PoultryFarmManagementSystem";

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
  <title>Mortality Report</title>
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
            <h1><a href="index.html">Farm Manager's Portal</a></h1>
          </div>
        </div>
        <div class="col-md-5">

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
                <li><a href="newbrood.html">New Brood</a></li>
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
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="content-box-header">
                  <div class="panel-title">Mortality</div>
                </div>
                <div class="content-box-large box-with-header">

                  <div id="chart-container">
                    <canvas id="mortalitycanvas"></canvas>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6" id = "MortalityTable">
            <div class="row">
              <div class="col-md-12">
                <div class="content-box-header">
                  <!-- <button class = "btn btn-default" onclick = "printcontent('MortalityTable')">Print table</button> -->
                  <div class="panel-title">Mortality Statistics</div>
                </div>
                <div class="content-box-large box-with-header">

                  <table class="table">
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
                      <tr>
                        <th>House</th>
                        <th>Live Birds</th>
                      </tr>
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


                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/Chart.min.js"></script>
  <script type="text/javascript" src="js/mortalityGraph.js"></script>
  <script type = "text/javascript" src = "js/printcontent.js"></script>
</body>
</html>
