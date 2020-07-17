<?php
$fullname = $_POST['fullname'];
$companyID = $_POST['companyID'];
$username = $_POST['username'];
$password = $_POST['password'];
$accountType = "employee";
if (!empty($fullname) || !empty($companyID) || !empty($username) || !empty($password) || !empty($accountType)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "root";
    $dbname = "ocs";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT username From users Where username = ? Limit 1";
     $INSERT = "INSERT Into users (fullname, companyID, username, password, accountType) values(?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $stmt->bind_result($username);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssss", $fullname, $companyID, $username, $password, $accountType);
      $stmt->execute();
      echo '<script type="text/javascript">';
      echo 'alert("Registration Sucessful!")';
      echo '</script>';
     } else {
        echo '<script type="text/javascript">';
        echo 'alert("Username exists")';
        echo '</script>';
     }
     $stmt->close();
     $conn->close();
     echo "<META http-equiv=\"refresh\" content=\"0; URL=registerAccount.html\">";
    }
} else {
  echo '<script type="text/javascript">';
  echo 'alert("All field are required")';
  echo '</script>';
  echo "<META http-equiv=\"refresh\" content=\"0; URL=registerAccount.html\">";
}
?>
