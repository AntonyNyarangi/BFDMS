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

//get data to populate chart from db
//$hseID = trim($_POST['houseID']);
$dateValues = "SELECT date FROM Mortality";
$resultDV = $con->query($dateValues);
$mortalityValues = "SELECT number FROM Mortality";
$resultMV = $con->query($mortalityValues);
$mortalityValuesPerHse = "SELECT number FROM Mortality WHERE hse_ID = $hseID";
$resultMVPH = $con->query($mortalityValuesPerHse);
$dateValuesPerHse = "SELECT date FROM Mortality WHERE hseID = $hseID";
$resultDVPH = $con->query($dateValuesPerHse);
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
                 <li><a href="mortalityADMIN.php">Mortality</a></li>
                 <li><a href="feedConsumptionADMIN.php">Feed Consumption</a></li>
                 <li><a href="expenditure.html">Expenditure</a></li>
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
                   <canvas id="myChart" width="400" height="400"></canvas>
                   <script>
                   var ctx = document.getElementById("myChart");
                   var myChart = new Chart(ctx, {
                     type: 'bar',
                     data: {
                       labels: ["Day1", "Day2", "Day3", "Day4", "Day5", "Day6"],
                       datasets: [{
                         label: '# of dead birds',
                         data: [6, 7, 6, 5, 2, 3],
                         backgroundColor: [
                           'red','red','red','red','red','red',],
                         }]
                       },
                       options: {
                         scales: {
                           yAxes: [{
                             ticks: {
                               beginAtZero:true
                             }
                           }]
                         }
                       }
                     });
                     </script>
                   </div>
                 </div>
               </div>
             </div>

             <div class="col-md-6">
               <div class="row">
                 <div class="col-md-12">
                   <div class="content-box-header">
                     <div class="panel-title">Mortality Statistics</div>
                   </div>
                   <div class="content-box-large box-with-header">

                     <table class="table">
     				              <thead>
     				                <tr>
     				                  <th>#</th>
     				                  <th>First Name</th>
     				                  <th>Last Name</th>
     				                  <th>Username</th>
     				                </tr>
     				              </thead>
     				              <tbody>
     				                <tr>
     				                  <td>1</td>
     				                  <td>Mark</td>
     				                  <td>Otto</td>
     				                  <td>@mdo</td>
     				                </tr>
     				                <tr>
     				                  <td>2</td>
     				                  <td>Jacob</td>
     				                  <td>Thornton</td>
     				                  <td>@fat</td>
     				                </tr>
     				                <tr>
     				                  <td>3</td>
     				                  <td>Larry</td>
     				                  <td>the Bird</td>
     				                  <td>@twitter</td>
     				                </tr>
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

     <footer>
       <div class="container">

         <div class="copy text-center">
           Copyright 2014 <a href='#'>Website</a>
         </div>

       </div>
     </footer>

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="https://code.jquery.com/jquery.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="bootstrap/js/bootstrap.min.js"></script>
     <script src="js/custom.js"></script>
   </body>
   </html>
