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

    <title>Review FWA</title>

    <!-- AJAX -->
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- JS file -->
    <script type="text/javascript" src = "sycReviewFWA.js"></script>

</head>
<body>
    <header>
      <!-- Navbar -->
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
                        <a href="reviewFWA.php" class="list-group-item list-group-item-action active">Review FWA</a>
                        <a href="reviewS.php" class="list-group-item list-group-item-action">Review Schedule</a>
                        <a href="viewAnalyticSupervisor.php" class="list-group-item list-group-item-action ">View FWA Analytics</a>
                        <a href="logOut.php" class="list-group-item list-group-item-action">Log Out</a>
                    </div>
                </nav>
            </div>
          </div>
        </div>
    </nav>

    </header>

    <main>

     <!-- function to check if the supervisor FWA status is "New" and alert them to change password before they could review FWA -->
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
            echo'<script>alert("Please change a new password."); window.location="homeS.php#info";</script>'
          ?>

        <?php

            }
          }
        ?>

    <div class="container-fluid">
        <br><br><br><br><br>
        <h1>Review FWA Request</h1>

        <br>

        <div id="listEmp">
						<caption><h5>List of My Employees</h5></caption>
						<br>

						<table class="table table-hover table-responsive">
							<thead class="table-dark" >
							<tr>
                <th> Request ID </th>
								<th> Employee ID </th>
								<th style="width:35%"> Employee Name </th>
                <th> Request Status </th>
							</tr>
							</thead>

            <!-- function to get all employees under this supervisor who has "pending" FWA request and return it in a table format-->
						<?php

                $server = "localhost";
                $username = "root";
                $password = "";
                $dbname = "flexis";

                $conn = mysqli_connect($server, $username, $password, $dbname);

                $sql1 = "SELECT * FROM fwarequest NATURAL JOIN employee WHERE status = 'pending' AND supervisorID='$employeeID'";

                //Execute the sql query in the database
                $run1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                $count1 = mysqli_num_rows($run1);  //return the number of rows of the results return from the query

                if($count1 > 0){  //count1 > 0 means the data is found exist in the database after running the query

                    while($row = mysqli_fetch_assoc($run1)){  //loop the result data and fetch them from the database as associative array
                        $employeeID = $row['employeeID'];
                        $name = $row['name'];
                        $prefix = $row['prefix'];
                        $requestID = $row['requestID'];
                        $status= $row['status'];

                        ?>

                        <tr class="row_submit" style="cursor: pointer;">
                          <td><?php echo $prefix.$requestID; ?></td>
                          <td><?php echo $employeeID; ?></td>
                          <td><?php echo $name; ?></td>
                          <td><?php echo $status; ?></td>
                        <tr>

                        <?php
                        }
                    }
                    //else (there is no data found from running the query)
                    else{ ?>
                      <tr>
                        <td colspan=4><?php echo "There is no employee with a pending FWA request.";?></td>
                      </tr>
                    <?php
                    }
                ?>
						</table>
				</div>

        <div id="fwaBtn" style="text-align:right;display:none;">
							<button id="backBtn" class="btn btn-primary" onclick="showList()">
								Back
							</button>

              <button id="pastBtn" class="btn btn-primary" onclick="showPast()">
                Past Request
              </button>

				</div>

        <!-- Empty div which shows the output data (FWA request details) from reviewFWA2.php -->
        <div id="selectFWA"></div>

        <div id="backFWA" style="text-align:right; display:none;">
          <button class="btn btn-primary" onclick="showFWA()">
            Back to FWA
          </button>
        </div>
        <br>

        <!-- Empty div which shows the output data (past FWA requests) from reviewFWA3.php -->
        <div id="pastList" style="display:none"></div>


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