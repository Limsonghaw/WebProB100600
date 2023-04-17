<?php
  session_start();
  $employeeID = $_SESSION['employeeID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="sycFWA.css">

    <title>Submit FWA</title>
</head>
<body>
    <header>
      <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">

          <!-- logo -->
          <a class="navbar-brand" href="homeE.php">
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
                        <a href="homeE.php" class="list-group-item list-group-item-action" aria-current="true">
                          Dashboard
                        </a>
                        <a href="submitFWA.php" class="list-group-item list-group-item-action active">Submit FWA</a>
                        <a href="UpdateDS.php" class="list-group-item list-group-item-action">Update Daily Schedule</a>
                        <a href="logOut.php" class="list-group-item list-group-item-action">Log Out</a>
                    </div>
                </nav>
            </div>
          </div>
        </div>
    </nav>

    </header>

    <main>

    <!-- function to check if the employee FWA status is "New" and alert them to change password before they could submit FWA -->
    <?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "flexis";
        define('SITEURL', 'http://localhost/flexis');

        $conn = mysqli_connect($server, $username, $password, $dbname);

        $sql = "SELECT * FROM employee where employeeID = '$employeeID' and FWAStatus = 'New'";

        $run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($run);

        if($count > 0){
          while($row = mysqli_fetch_assoc($run)){
            echo'<script>alert("Please change a new password."); window.location="homeE.php#info";</script>'
          ?>

        <?php

            }
          }
        ?>

    <div class="container-fluid">
        <br><br><br><br><br>
        <h1>Submit FWA Request</h1>

        <br>
        <form method="POST" action="FWAinsert.php" enctype="multipart/form-data" class="FWArequest">

            <div class = "form-group row">
              <div class = "mb-3">
                <h4>Work Type</h4>
                <input type="radio" name="workType" value="Flexi-hour" id="FH" required>
                <label for="FH">Flexi-hour</label> <br>
                <input type="radio" name="workType" value="Work-from-home" id="WH">
                <label for="WH">Work-from-home</label> <br>
                <input type="radio" name="workType" value="Hybrid" id="HY">
                <label for="HY">Hybrid</label>
              </div>
            </div>


            <div class="mb-3">
              <label for="description" class="form-label"><h4>Description</h4></label>
              <textarea class="form-control" id="description" name="description"  maxlength="500" rows="4" placeholder="(max 500 words)" required></textarea>
            </div>


            <div class="mb-3">
              <label for="reason" class="form-label"><h4>Reason</h4></label>
              <textarea class="form-control" id="reason" name="reason" maxlength="500" rows="4" placeholder="(max 500 words)" required></textarea>
            </div>


            <br>
            <div class="mb-3 text-end">
              <input type="submit" id="btnSubmitFWA" class="btnSubmit" name="submit">
            </div>
        </form>
    </div>

    </div>
    </main>
    <br><br><br>
    <footer class="fixed-bottom">
      &copy; FlexIS 2023
    </footer>


      <!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>