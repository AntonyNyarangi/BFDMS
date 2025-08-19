<?php
//create server and database connection constants
$server = "localhost:3306";
$user = "root";
$password = "@mokaya";
$database = "PoultryFarmManagementSystem";

$con= new mysqli ($server,$user,$password, $database);

//Check server connection
if ($con->connect_error){
  die ("Failed to establish DB connection:". $con->connect_error);
}else{

  $broodID = trim($_POST['broodID']);
  $selectbrooddetails = $con->query("SELECT * FROM Brood WHERE BroodID = '$broodID'");
  $fetchedbrood = $selectbrooddetails->fetch_assoc();
  $availablehouses = $con->query("SELECT * FROM Houses WHERE Status = 0");
}
?>
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
              </ul>
            </li>


          </ul>
        </div>
      </div>

      <div class="col-md-6">
        <div class="content-box-large">
          <div class="panel-heading">
            <div class="panel-title">Select a house for the Brood</div>
          </div>
          <div class="panel-body">
            <form action ="assignhouse.php" method = "post" name = "houseselector" required>
              <fieldset>
                <div class="form-group">
                  <label>Date</label>
                  <input class ="form-control" type="date" name = "date" value="<?php echo $fetchedbrood['Date']; ?>" required>
                  <input type="hidden" name = "broodID" value="<?php echo $fetchedbrood['BroodID']; ?>" required>
                </div>
                <div class="form-group">
                  <label>Initial Brood Size</label>
                  <input class="form-control" type="text" name="InitialSize" value = "<?php echo $fetchedbrood['InitialSize']; ?>" required>
                </div>
                <div class="form-group">
                  <label>Current Brood Size</label>
                  <input class="form-control" type="text" name="CurrentSize" value = "<?php echo $fetchedbrood['CurrentSize']; ?>" required>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <input class="form-control" type="text" name="Status" value = "<?php if($fetchedbrood['Status'] == 0){echo "Available";}else{echo "Sold";}?>" required>
                </div>
                <div class = "form-group">
                  <label>House</label>
                  <p>
                    <select class="selectpicker" name="houseID" required>
                      <?php
                      while($fetchedhouses = $availablehouses->fetch_assoc()){ ?>
                        <option value ="<?php echo $fetchedhouses['hse_ID']; ?>"> <?php echo $fetchedhouses['hseName']." - ".$fetchedhouses['Capacity']; ?></option>
                        <?php  }
                        ?>
                        <!-- <option value="Hse1">Hse1</option>
                        <option value="Hse2">Hse2</option>
                        <option value="Hse3">Hse3</option> -->
                      </select>
                    </p>
                  </div>
                </fieldset>
                <input type="submit" class = "btn btn-primary signup" value="Submit" ></tab>
              </form>
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
