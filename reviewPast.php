<!-- This page is to search the past FWA request of the employee based on the employeeID from the row selected in reviewFWA.php,
     then display all past request details in a table format. -->

     <?php
    session_start();
    $employeeID = $_SESSION['employeeID'];

    //request the "eid" which was posted from reviewFWA.php and put it inside the $fwaEmp variable
    if( $_REQUEST["eid"] ) {
        $fwaEmp = $_REQUEST['eid'];
     }
?>

<div id="pastReq">
    <caption><h5>Past Request of <?php echo $fwaEmp?></h5></caption>
    <br>

    <table class="table table-light">
        <thead class="thead-dark">
        <tr>
            <th> Request ID </th>
            <th> Status </th>
            <th> Work Type </th>
            <th > Description </th>
            <th> Reason </th>
            <th> Comment </th>
        </tr>
        </thead>
    <?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "flexis";
        define('SITEURL', 'http://localhost/flexis');

        $conn = mysqli_connect($server, $username, $password, $dbname);

        //get all past request of the employee being reviewed
        $sql = "SELECT * FROM fwarequest WHERE status != 'pending' AND employeeID = '$fwaEmp'";

        $run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($run);

        if($count > 0){
            while($row = mysqli_fetch_assoc($run)){
                $empID = $row['employeeID'];
                $prefix = $row['prefix'];
                $requestID = $row['requestID'];
                $status= $row['status'];
                $worktype = $row['workType'];
                $desc = $row['description'];
                $reason = $row['reason'];
                $comment = $row['comment'];
                ?>

                <tr>
                    <td><?php echo $prefix.$requestID; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $worktype; ?></td>
                    <td class="text-break" style="width:20%"><?php echo $desc; ?></td>
                    <td class="text-break" style="width:20%"><?php echo $reason; ?></td>
                    <td class="text-break"><?php echo $comment; ?></td>
                <tr>

                <?php
                }
            }
            else{ ?>
                <tr>
                    <td colspan="8"><?php echo "Employee ($fwaEmp) does not have any past FWA request"; ?></td>
                </tr>
                <?php
            }
        ?>
    </table>
</div>


