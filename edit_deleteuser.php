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
//receive  values from user form and trim white spaces
$userID = trim($_POST['userID']);

//push values into db using query

$sql = "DELETE FROM `Users` WHERE `UserID` = $userID";

if ($con->query($sql)=== TRUE){
  $successfulMsg = "User deleted";
  echo "<script type = 'text/javascript'>alert('$successfulMsg');</script>";
}else{
  $errorMsg = "An error occured";
  echo "Error: " . $sql . "<br>" . $con->error;
  echo "<script type = 'text/javascript'>alert('$errorMsg');</script>";
}

?>


<!DOCTYPE html>
<html>
<head>
  <title>View Users</title>
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
                <i class="glyphicon glyphicon-list"></i> Reports
                <span class="caret pull-right"></span>
              </a>
              <!-- Sub menu -->
              <ul>
                <li><a href="mortalityReport.html">Mortality</a></li>
                <li><a href="feedConsumptionReport.html">Feed Consumption</a></li>
                <li><a href="signup.html">Expenditure</a></li>
              </ul>
            </li>
            <li class="submenu">
              <a href="#">
                <i class="glyphicon glyphicon-list"></i> Forms
                <span class="caret pull-right"></span>
              </a>
              <!-- Sub menu -->
              <ul>
                <li><a href="mortality.html">Mortality</a></li>
                <li><a href="feedConsumption.html">Feed Consumption</a></li>
                <li><a href="expenditure.html">Expenditure</a></li>
              </ul>
            </li>

          </ul>
        </div>
      </div>


      <div class="col-md-10">
        <div class="row">
          <div class="content-box-large">
            <div class="panel-heading">
              <div class="panel-title">System Users</div>
            </div>
            <div class="panel-body">

              <form action = "viewusers.php" method = "post">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="systemusers">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $server = "localhost";
                    $user = "root";
                    $password = "48285";
                    $database = "BroilerFarmManagementSystem";

                    $con= new mysqli ($server,$user,$password, $database);

                    if ($con->connect_error){
                      die ("Failed to establish DB connection:". $con->connect_error);
                    }

                    $result = $con->query("SELECT `UserID`,`FirstName`, `LastName`, `Category`, `Username` FROM Users");

                    while($row = $result->fetch_assoc()){
                      echo "<tr>";
                      echo "<td>".$row['FirstName']. " ".$row['LastName']."</td>";
                      echo "<td>".$row['Username']."</td>";
                      echo "<td>".$row['Category']."</td>"; ?>
                      <td>
                        <form method="post" action="edit_deleteuser.php">
                          <input type="submit" name="modifyusers" value="Edit"/>
                          <input type="submit" name="modifyusers" value="Delete"/>
                          <input type="text" name="userID" value="<?php echo $row['UserID']; ?>"/>
                        </form>
                      </td>
                      <?php
                      echo "</tr>";
                    }
                    ?>

                  </tbody>
                </table>
              </form>

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
