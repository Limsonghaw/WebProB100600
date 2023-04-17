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

    <title>View FWA Analytics</title>
</head>
<body>

    <header>
        <!-- Navbar -->
      <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
          <!-- Container wrapper -->
          <div class="container-fluid">

            <!-- logo -->
            <a class="navbar-brand" href="homeH.php">
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
                          <a href="homeH.php" class="list-group-item list-group-item-action" aria-current="true">
                            Dashboard
                          </a>
                          <a href="RegisterEmployee.php" class="list-group-item list-group-item-action ">Register Employee</a>
                          <a href="viewAnalytics.php" class="list-group-item list-group-item-action active">View FWA Analytics</a>
                          <a href="logOut.php" class="list-group-item list-group-item-action">Log Out</a>
                      </div>
                  </nav>
              </div>
            </div>
          </div>
      </nav>

    </header>

      <main>
        <div class="container-fluid">
            <br><br><br><br><br>
            <h1>FWA Analytics</h1>
            <br>
          <div id="numEmp">
            <h6 style="text-align:center;">No. of employees of each FWA status </h6>
            <form method="POST" action="viewAnalytics2.php">
            <table class="table table-bordered table-hover table-light">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 10%">Dept</th>
                        <th style="width: 20%">Flexi-hour</th>
                        <th style="width: 20%">Work-from-home</th>
                        <th style="width: 20%">Hybrid</th>
                    </tr>
                </thead>

                <?php
                  $server = "localhost";
                  $username = "root";
                  $password = "";
                  $dbname = "flexis";
                  define('SITEURL', 'http://localhost/flexis');

                  $conn = mysqli_connect($server, $username, $password, $dbname);

                  //sql query to get the count of number of employees of each FWA status for each department group
                  //and assign different column aliases to the COUNT expressions
                  $sql = "SELECT departmentID,
                          COUNT(CASE WHEN FWAStatus='Flexi-hour' THEN 1 END) AS totalFlexi,
                          COUNT(CASE WHEN FWAStatus='Work-from-home' THEN 1 END) AS totalHome,
                          COUNT(CASE WHEN FWAStatus='Hybrid' THEN 1 END) AS totalHybrid
                          FROM employee GROUP BY departmentID";

                  //Execute the sql query in the database or return error if fail to access database
                  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                  $count = mysqli_num_rows($result);

                  if ($count > 0){  //row with the data is found
                    while($row = mysqli_fetch_assoc($result)){  //Loop through the result data and fetch them from the database as associative array
                      $deptID = $row['departmentID'];
                      $flexi = $row['totalFlexi'];
                      $home = $row['totalHome'];
                      $hybrid = $row['totalHybrid'];
                    ?>

                    <tbody>
                        <tr>
                            <!-- For each department, create a submit button with the departmentID, and print count of employees of each FWA status -->
                            <td style="height:60px"><input type="submit" id="submitDept" name="submitDept" value="<?php echo $deptID?>" style="width:90%;" class="btn btn-warning"> </td>
                            <td> <?php echo $flexi ?> </td>
                            <td> <?php echo $home ?> </td>
                            <td> <?php echo $hybrid ?> </td>
                        </tr>

                    <?php
                    }
                  }
                ?>
                    </tbody>
            </table>
                </form>
          </div>
        </div>
    </main>

    <br><br>
    <footer class="fixed-bottom">
      &copy; FlexIS 2023
    </footer>

    <!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>