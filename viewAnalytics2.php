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

    <link rel="stylesheet" type="text/css" href="sycFWA2.css">

    <title>View FWA Analytics</title>

    <!-- AJAX -->
	  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- JS file -->
    <script type="text/javascript" src = "sycViewAnalytics.js"></script>

</head>
<body>

    <header>
        <!-- Navbar -->
      <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
          <!-- Container wrapper -->
          <div class="container-fluid">

            <?php
            if ($employeeID[0] == 'H'){ ?>
              <!-- admin logo -->
              <a class="navbar-brand" href="homeH.php">
                <img
                  src="Flexis.png"
                  height="50"
                  alt="FlexIS Logo"
                  loading="lazy"
                />
              </a>
            <?php
            }
            else if($employeeID[0] == 'S'){ ?>
              <!-- supervisor logo -->
              <a class="navbar-brand" href="homeS.php">
                <img
                  src="Flexis.png"
                  height="50"
                  alt="FlexIS Logo"
                  loading="lazy"
                />
              </a>
            <?php
            }
            ?>

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
                      <?php
                        if ($employeeID[0] == 'H'){ ?>
                          <!-- admin menu -->
                          <div class="list-group">
                              <a href="homeH.php" class="list-group-item list-group-item-action" aria-current="true">
                                Dashboard
                              </a>
                              <a href="RegisterEmployee.php" class="list-group-item list-group-item-action ">Register Employee</a>
                              <a href="viewAnalytics.php" class="list-group-item list-group-item-action active">View FWA Analytics</a>
                              <a href="logOut.php" class="list-group-item list-group-item-action">Log Out</a>
                          </div>
                        <?php
                        }
                        else if($employeeID[0] == 'S'){ ?>
                          <!-- supervisor menu -->
                          <div class="list-group">
                            <a href="homeS.php" class="list-group-item list-group-item-action" aria-current="true">
                              Dashboard
                            </a>
                            <a href="reviewFWA.php" class="list-group-item list-group-item-action ">Review FWA</a>
                            <a href="reviewS.php" class="list-group-item list-group-item-action">Review Schedule</a>
                            <a href="viewAnalyticSupervisor.php" class="list-group-item list-group-item-action active">View FWA Analytics</a>
                            <a href="logOut.php" class="list-group-item list-group-item-action">Log Out</a>
                          </div>
                        <?php
                        }
                      ?>
                  </nav>
              </div>
            </div>
          </div>
      </nav>

    </header>

      <main>
      <br><br><br><br><br>
      <h1>FWA Analytics</h1>

            <?php
                $server = "localhost";
                $username = "root";
                $password = "";
                $dbname = "flexis";
                define('SITEURL', 'http://localhost/flexis');

                $conn = mysqli_connect($server, $username, $password, $dbname);

                if(isset($_POST['submitDept'])){
                    $dept = $_POST['submitDept'];
                    $_SESSION['deptID'] = $dept; //create a session to pass the deptID to another page
                     ?>

                  <div>
                    <?php
                      if ($employeeID[0] == 'H'){ ?>
                        <button class="btn btn-primary" onclick="location.href='viewAnalytics.php'"> Back </button>
                      <?php
                      }
                      else if($employeeID[0] == 'S'){ ?>
                        <button class="btn btn-primary" onclick="location.href='viewAnalyticSupervisor.php'"> Back </button>
                      <?php
                      }
                    ?>
                    <h4 style="color:white; display:inline; margin-left: 35%; margin-right:30%;"><?php echo "Department: ".$dept; ?></h4>
                  </div>
                  <br>


              <div class="container-fluid" id="container">
                  <div id="numFWAEmp">
                    <h6>No. of Employees making FWA request</h6>
                    <div>
                      <input class="form-control" type="date" id="dateInput" style="width:auto; display:inline;">
                      <button onclick="showDate()"> Filter </button>
                      <button onclick="refresh()"> Clear </button>
                    </div>
                    <br>

                    <div id="fwatable">
                    <table class="table table-bordered table-light" id="mytable">
                        <thead class="table-dark" style="position:sticky; top:0;">
                            <tr>
                                <th style="width: 20%">Date</th>
                                <th style="width: 20%">No. of Employees</th>
                            </tr>
                        </thead>

                    <?php
                    // sql query to get the count of employees from the chosen department who made FWA requests on each date.
                    $sql = "SELECT requestDate, COUNT(DISTINCT employeeID) AS countEmp 
                            FROM fwarequest NATURAL JOIN employee WHERE departmentID = '$dept' GROUP BY requestDate";

                    //Execute the sql query in the database or return error if fail to access database
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    $count = mysqli_num_rows($result);

                    if ($count > 0){  //row with the data is found
                        while($row = mysqli_fetch_assoc($result)){  //Loop through the result and populate the data array
                            $date = $row['requestDate'];
                            $empNo = $row['countEmp'];
                        ?>

                        <tbody>
                            <tr>
                                <td style="height:55px"> <?php echo $date ?> </td>
                                <td> <?php echo $empNo ?> </td>
                            </tr>

                        <?php
                        } ?>

                        </tbody>
                        <tfoot></tfoot>
                    </table>
                    </div>

                    <?php
                    }
                    else{ ?>
                        <tbody>
                            <tr>
                                <td style="height:55px" colspan=2> No employee making FWA request </td>
                            </tr>
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                    </div>
                    <?php
                    }
                }

            ?>
            </div>

            <div id="numDaily">
              <h6>Summarized daily schedules</h6>

              <div>
                <input class="form-control" type="date" id="startDate" name="startDate" style="width:auto; display:inline;" required>
                <p style="display:inline;"> to </p>
                <input class="form-control" type="date" id="endDate" name="endDate" style="width:auto; display:inline;" required>
                <button id="btnDaily" onclick="find()"> View </button>
              </div>
              <script>
                const startInput = document.getElementById('startDate');
                const endInput = document.getElementById('endDate');

                // Add event listener to update the minimum date of the endDate datepicker
                startInput.addEventListener('change', () => {
                    // Set the minimum date as the startDate value for the endDate datepicker,
                    // so that user cannot choose a date earlier than the start date in the endDate datepicker
                    endInput.min = startInput.value;
                    if (endInput.value < startInput.value) {
                        endInput.value = startInput.value;
                    }
                });
              </script>
              <br>

              <table class="table table-bordered table-light" id="beforeTable">
                <thead class="table-dark" style="position:sticky; top:0;">
                    <tr>
                        <th style="width: 20%">Date</th>
                        <th style="width: 20%">Work Location</th>
                        <th style="width: 20%">Work Hours</th>
                        <th style="width: 5%">Employee ID</th>
                    </tr>
                </thead>
              </table>

              <!-- Empty div which shows the output data from viewFWAAnalytics3.php -->
              <div id="dailyList"></div>

            </div>

        </div>
    </main>

    <br><br><br><br>
    <footer class="fixed-bottom">
      &copy; FlexIS 2023
    </footer>

    <!-- JavaScript Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>