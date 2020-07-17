<?php
$username = $_POST['username'];
$password = $_POST['password'];
$active = "active";

if (!empty($username) || !empty($password)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "root";
    $dbname = "ocs";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
      die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }
    else {
      $UPDATE_INACTIVE = "UPDATE users set active = 'inactive'";
      //Prepare statement
      $stmt = $conn->prepare($UPDATE_INACTIVE);
      $stmt->execute();
      $stmt->close();

      $SELECT = "SELECT * From users Where username = '".$username."' AND password = '".$password."' Limit 1";
      $result = mysqli_query($conn, $SELECT);
      $rowNum = mysqli_num_rows($result);

      if ($rowNum == 0) {
        echo '<script type="text/javascript">';
        echo 'alert("The username and/or password you have entered is incorrect!")';
        echo '</script>';
        echo "<META http-equiv=\"refresh\" content=\"0; URL=login.html\">";
      }
      else {
        $UPDATE_ACTIVE = "UPDATE users set active = 'active' WHERE username = '".$username."'";
        //Prepare statement
        $stmt = $conn->prepare($UPDATE_ACTIVE);
        $stmt->execute();
        $stmt->close();

        while ($row = mysqli_fetch_assoc($result)){
          if($row['accountType'] == "admin") {
?>
            <script type="text/javascript">
            window.location.href="Admin/admin.html"</script>
<?php
          }
          elseif($row['accountType'] == "caterer") {
?>
            <script type="text/javascript">
            window.location.href="Caterer/caterer.html"</script>
<?php
          }
          else {
?>
            <script type="text/javascript">
            window.location.href="Employee/employee.html"</script>
<?php
          }
        }
      }
      $conn->close();
    }
}
else {
  echo '<script type="text/javascript">';
  echo 'alert("All fields required!")';
  echo '</script>';
  echo "<META http-equiv=\"refresh\" content=\"0; URL=login.html\">";
}
?>
