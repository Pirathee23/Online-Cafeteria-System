<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbname = "ocs";
//create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
if (mysqli_connect_error()) {
  die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} else {
  $SELECT_ACTIVE = "SELECT username From users Where active = 'active' Limit 1";
  $resultUser = mysqli_query($conn, $SELECT_ACTIVE);
  $rowNum = mysqli_num_rows($resultUser);
  while ($rowUser = mysqli_fetch_assoc($resultUser)){
    $username = $rowUser['username'];
  }
    $UPDATE = "UPDATE orders set state = 'confirmed' WHERE state = 'pending'   AND username = '".$username."'";
    //Prepare statement
    $stmt = $conn->prepare($UPDATE);
    $stmt->execute();
    echo '<script type="text/javascript">';
    echo 'alert("Order has been successfully placed!")';
    echo '</script>';
    echo "<META http-equiv=\"refresh\" content=\"0; URL=employee.html\">";
  $stmt->close();
  $conn->close();
}

?>
