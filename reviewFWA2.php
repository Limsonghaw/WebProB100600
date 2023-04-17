<!-- This page is to find the FWA request based on the requestID from the row selected in reviewFWA.php, then show the FWA request details,
     and allow supervisor to choose to accept/reject and add comment to the FWA request.-->

<?php
    session_start();
    $employeeID = $_SESSION['employeeID'];

    //request the "rid" which was posted from reviewFWA.php and put it inside the $FWA variable
    if( $_REQUEST["rid"] ) {
        $FWA = $_REQUEST['rid'];
        $_SESSION['fwaID'] = $FWA; //to pass the FWA requestID to another page
     }

?>

<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "flexis";
    define('SITEURL', 'http://localhost/flexis');

    $conn = mysqli_connect($server, $username, $password, $dbname);

    $sql = "SELECT * FROM fwarequest WHERE requestID = '$FWA'"; //get the FWA request details based on the requestID

    $run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $count = mysqli_num_rows($run);

    if($count > 0){
        while($row = mysqli_fetch_assoc($run)){
            $empID = $row['employeeID'];
            $requestID = $row['requestID'];
            $prefix = $row['prefix'];
            $date = $row['requestDate'];
            $status = $row['status'];
            $worktype = $row['workType'];
            $comment = $row['comment'];
            $description = $row['description'];
            $reason = $row['reason'];

            $_SESSION['fwaEmp'] = $empID;
            ?>
            <br>
            <div class="form-wrap max-width-700 mx-auto">
                <div id="fwaReq" >
                <h4 style="text-align:center; "><?php echo $empID; ?> FWA Request</h4><br>
                    <h6 style="color:blue;">Request ID &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $prefix.$requestID; ?></h6>
                    <h6 style="color:blue;">Request Date : <?php echo $date; ?></h6>
                    <h6 style="color:blue;">Status &emsp;&emsp;&emsp;&nbsp;: <?php echo $status; ?></h6>
                    <br><hr>

                    <h5>FWA Details</h5>
                    <hr>
                    <h6 >Work Type </h6>
                    <p><?php echo $worktype; ?></p>

                    <h6>Description </h6>
                    <p><?php echo $description; ?></p>

                    <h6>Reason </h6>
                    <p><?php echo $reason; ?></p>
                    <hr>

                    <!-- Form to let supervisor choose to accept/reject the request and leave comment -->
                    <form method="POST" action="reviewFWA3.php" enctype="multipart/form-data">
                        <div class="text-center" style="margin-top: 30px; ">
                            <input type="radio" id="accept" name = "decision" value ="accepted" style="height:18px; width:18px;" required>
                            <label for="accept" style="font-size:22px; color:green; margin-right:10%">Accept</label>
                            <input type="radio" id="reject" name = "decision" value ="rejected" style="height:18px; width:18px;">
                            <label for="reject" style="font-size:22px; color:red;">Reject</label>
                        </div>
                        <h6 style="margin-bottom: 10px;">Comment:</h6>
                        <textarea class="form-control h-50" id="comment" name="comment"  maxlength="300" rows="4" placeholder="(optional) max 300 words"></textarea>
                        <div style="text-align:right; margin-top: 20px;">
                            <button type="submit" name="confirmReview" class="btnSubmit">
                                Confirm
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="sycFWA.css">
</head>
</html>