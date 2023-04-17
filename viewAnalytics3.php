<?php
  session_start();
  $employeeID = $_SESSION['employeeID'];
  $deptID = $_SESSION['deptID'];

  //request the "start" and "end" which was posted from viewAnalytics2.php and put their values inside the $start and $end variables
  if( $_REQUEST["start"] && $_REQUEST["end"]) {
    $start = $_REQUEST['start'];
    $end = $_REQUEST['end'];
 }

?>


    <div id="dailyTable">

    <?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "flexis";

        $conn = mysqli_connect($server, $username, $password, $dbname); ?>

        <table class="table table-bordered table-light">
        <thead class="table-dark" style="position:sticky; top:0;">
            <tr>
                <th style="width: 20%">Date</th>
                <th style="width: 20%">Work Location</th>
                <th style="width: 20%">Work Hours</th>
                <th style="width: 5%">Employee ID</th>
            </tr>
        </thead>

        <?php
        if(!empty($start) && !empty($end)){

            // sql query to get the daily schedule data of employees from the chosen department based on the input date range.
            $sql = "SELECT * FROM updatedailyschedule NATURAL JOIN employee
            WHERE departmentID = '$deptID' AND Date BETWEEN '$start' AND '$end'";

            //Execute the sql query in the database or return error if fail to access database
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $count = mysqli_num_rows($result);

            if ($count > 0){
                while($row = mysqli_fetch_assoc($result)){  //Loop through the result and populate the data array
                    $date = $row['Date'];
                    $location = $row['WorkLocation'];
                    $hours = $row['WorkHours'];
                    $empID = $row['employeeID'];
                ?>

                <tbody>
                    <tr>
                        <td style="height:55px"> <?php echo $date ?> </td>
                        <td> <?php echo $location ?> </td>
                        <td> <?php echo $hours ?> </td>
                        <td> <?php echo $empID ?> </td>
                    </tr>
                <?php
                } ?>

                </tbody>
            </table>

            <?php
            }
            else{ ?>
                <tbody>
                    <tr>
                        <td style="height:55px" colspan=4> No daily schedule within this date range</td>
                    </tr>
                </tbody>
            </table>

            <?php
            }
        }


    ?>
    </div>


