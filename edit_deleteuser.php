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
$action = trim($_POST['modifyusers']);
//push values into db using query
if ($action == 'Delete'){
  $sql = "DELETE FROM `Users` WHERE `UserID` = $userID";

  if ($con->query($sql)=== TRUE){
    $successfulMsg = "User deleted";
    echo "<script type = 'text/javascript'>alert('$successfulMsg');</script>";
  }else{
    $errorMsg = "An error occured";
    echo "Error: " . $sql . "<br>" . $con->error;
    echo "<script type = 'text/javascript'>alert('$errorMsg');</script>";
  }
  $successfulMsg = "User deleted";
  header("Location:viewusers.php?Message=".$successfulMsg);
}else if ($action == 'Reset password'){
  $sql = "UPDATE Users SET Password = 123456 WHERE `UserID` = $userID";

  if ($con->query($sql)=== TRUE){
    $successfulMsg = "Password Reset";
    echo "<script type = 'text/javascript'>alert('$successfulMsg');</script>";
  }else{
    $errorMsg = "An error occured";
    echo "Error: " . $sql . "<br>" . $con->error;
    echo "<script type = 'text/javascript'>alert('$errorMsg');</script>";
  }
  $successfulMsg = "Password Reset! New password is 123456";
  header("Location:viewusers.php?Message=".$successfulMsg);
}else if($action == 'Edit'){
  $getuserdetails = $con->query("SELECT * FROM Users WHERE UserID = '$userID'");
  $fetcheduserdetails = $getuserdetails->fetch_assoc();
  ?>


  <!DOCTYPE html>
  <html>

  <head>
    <title>Edit User</title>
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
                </ul>
              </li>

            </ul>
          </div>
        </div>



        <div class="col-md-6">
          <div class="content-box-large">
            <div class="panel-heading">
              <div class="panel-title">Edit User Details</div>
            </div>
            <div class="panel-body">
              <form action="updateuserdetails.php" method="post" name="newuser" required>
                <fieldset>
                  <div class="form-group">
                    <label>First Name</label>
                    <input class="form-control" type="text" name="firstname" value="<?php echo $fetcheduserdetails['FirstName']; ?>"required>
                    <input type = "hidden" name = "userID" value = value="<?php echo $fetcheduserdetails['UserID']; ?>"
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input class="form-control" type="text" name="lastname" value="<?php echo $fetcheduserdetails['LastName']; ?>"required>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" type="text" name="username"value="<?php echo $fetcheduserdetails['Username']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <p>
                      <select class="selectpicker" name="category" value="<?php echo $fetcheduserdetails['Category']; ?>"required>
                        <option value="Manager">Manager</option>
                        <option value="Worker">Worker</option>
                      </select>
                    </p>
                  </div>
                </fieldset>
                <input type="submit" class="btn btn-primary" value="update"></tab>
              </form>
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
  <?php
}
