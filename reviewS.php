<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week Date</title>
    <link rel="stylesheet" href="reviewS.css"/>
</html>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <?php
  session_start();
  $employeeID = $_SESSION['employeeID'];
  ?>
<header>
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">

          <!-- logo -->
          <a class="navbar-brand" href="homeS.php">
            <img
              src="Flexis.png"
              height="50"
              alt="FlexIS Logo"
              loading="lazy"
            />
          </a>

          <!-- title -->
          <h2 style = "position:fixed; left:80px;">FlexIS</h2>
          <h4><?php echo $employeeID?></h4>

          <!-- menu -->
          <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#flexisMenu" aria-controls="flexisMenu">
            Menu
          </button>

          <div class="offcanvas offcanvas-end" tabindex="-1" id="flexisMenu" aria-labelledby="menuLabel">
            <div class="offcanvas-header">
              <h4 class="offcanvas-title" id="menuLabel">FlexIS</h4>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <nav id="sidebarMenu">
                    <div class="list-group">
                    <a href="homeS.php" class="list-group-item list-group-item-action" aria-current="true">
                          Dashboard
                        </a>
                        <a href="reviewFWA.php" class="list-group-item list-group-item-action ">Review FWA</a>
                        <a href="reviewS.php" class="list-group-item list-group-item-action active">Review Schedule</a>
                        <a href="viewAnalyticSupervisor.php" class="list-group-item list-group-item-action ">View FWA Analytics</a>
                        <a href="logOut.php" class="list-group-item list-group-item-action">Log Out</a>
                </nav>
            </div>
          </div>
        </div>
    </nav>

    </header>
    <main>
    <br><br><br><br><br>
    <h1>Week Dates</h1>
    <br>
  <body>


    <div class="container">
<form action="reviewDate.php" method="post">
  <!-- use the php function to get the current week-->
  <button type="submit" name="day" value="<?php echo date('Y-n-j', strtotime('monday this week')); ?>"><?php echo date('Y-n-j', strtotime('monday this week')); ?></button>
  <button type="submit" name="day" value="<?php echo date('Y-n-j', strtotime('tuesday this week')); ?>"><?php echo date('Y-n-j', strtotime('tuesday this week')); ?></button>
  <button type="submit" name="day" value="<?php echo date('Y-n-j', strtotime('wednesday this week')); ?>"><?php echo date('Y-n-j', strtotime('wednesday this week')); ?></button>
  <button type="submit" name="day" value="<?php echo date('Y-n-j', strtotime('thursday this week')); ?>"><?php echo date('Y-n-j', strtotime('thursday this week')); ?></button>
  <button type="submit" name="day" value="<?php echo date('Y-n-j', strtotime('friday this week')); ?>"><?php echo date('Y-n-j', strtotime('friday this week')); ?></button>
  <button type="submit" name="day" value="<?php echo date('Y-n-j', strtotime('saturday this week')); ?>"><?php echo date('Y-n-j', strtotime('saturday this week')); ?></button>
  <button type="submit" name="day" value="<?php echo date('Y-n-j', strtotime('sunday this week')); ?>"><?php echo date('Y-n-j', strtotime('sunday this week')); ?></button>
  </ul>
<form>
</div>
</main>

    
        
    
</body>

<footer class="fixed-bottom">
  &copy; FlexIS 2023
</footer>


<!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>