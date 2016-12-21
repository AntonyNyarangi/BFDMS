<!DOCTYPE html>
<html>
<head>
  <title>Broods</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- styles -->
  <link href="css/styles.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
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

            <li class="submenu">
              <a href="#">
                <i class="glyphicon glyphicon-list"></i> Reports
                <span class="caret pull-right"></span>
              </a>
              <!-- Sub menu -->
              <ul>
                <li><a href="mortalityReport.php">Mortality</a></li>
                <li><a href="feedConsumptionReport.html">Feed Consumption</a></li>
              </ul>
            </li>
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

          </ul>
        </div>
      </div>


      <div class="col-md-10">
        <div class="row">
          <div class="content-box-large box-with-header">
            <div class="panel-heading">
              <div class="panel-title">All Broods</div>
            </div>
            <div class="panel-body">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="broods">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Initial Size</th>
                      <th>Current Size</th>
                      <th>House Assigned</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    if(isset($_GET['Message'])){
                      ?>
                      <div id='alert'><div class=' alert alert-block alert-info fade in center'><?php echo $_GET['Message']?></div></div>
                      <?php
                    }
                    $server = "localhost";
                    $user = "root";
                    $password = "48285";
                    $database = "BroilerFarmManagementSystem";

                    $con= new mysqli ($server,$user,$password, $database);

                    if ($con->connect_error){
                      die ("Failed to establish DB connection:". $con->connect_error);
                    }

                    $result = $con->query("SELECT`BroodID`, `Date`,`InitialSize`, `CurrentSize`, `HouseAssigned`, `Status` FROM Brood");

                    while($row = $result->fetch_assoc()){
                      echo "<tr>";
                      echo "<td>".$row['Date']."</td>";
                      echo "<td>".$row['InitialSize']."</td>";
                      echo "<td>".$row['CurrentSize']."</td>";
                      if ($row['HouseAssigned'] == 0){ ?>
                        <td>
                          <form method="post" action="houseselector.php">
                            <input type="submit" name="assign" value="Assign House"/>
                            <input type="hidden" name="broodID" value="<?php echo $row['BroodID']; ?>"/>
                          </form>
                        </td>
                        <!-- // echo "<td>"."Unassigned"."</td>"; -->
                        <?php
                      }else{
                        $housenames = $con->query("SELECT hseName FROM Houses where hse_ID = '$row[HouseAssigned]'");
                        $fetched = $housenames->fetch_assoc();
                        ?>
                        <td>
                          <form method="post" action="houseselector.php">
                            <input type="submit" name="assign" value="<?php echo $fetched['hseName']; ?>"/>
                            <input type="hidden" name="broodID" value="<?php echo $row['BroodID']; ?>"/>
                          </form>
                        </td>

                        <?php
                      }
                      if ($row['Status'] == 0){
                        echo "<td>"."Available"."</td>";
                      }else{
                        echo "<td>"."Sold"."</td>";
                      }
                      ?>
                      <td>
                        <form method="post" action="deletebrood.php">
                          <input type="submit" name="delete" value="Delete"/>
                          <input type="hidden" name="broodID" value="<?php echo $row['BroodID']; ?>"/>
                        </form>
                      </td>
                      <?php
                      echo "</tr>";
                    }
                    ?>
                    <tr>
                      <td>
                        <form method="post" action="newbrood.html">
                          <input type="submit" name="newbrood" value="New"/>
                        </form>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
</body>
</html>
