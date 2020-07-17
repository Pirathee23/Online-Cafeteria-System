<?php
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$deliveryDate = $_POST['deliveryDate'];
if (!empty($name) || !empty($description) || !empty($price) || !empty($deliveryDate)) {
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
      $SELECT = "SELECT name From menuItems Where name = ? AND deliveryDate = ? Limit 1";
      $INSERT = "INSERT Into menuItems (name, description, price, deliveryDate) values(?, ?, ?, ?)";

      //Prepare statement
      $stmt = $conn->prepare($SELECT);
      $stmt->bind_param("ss", $name, $deliveryDate);
      $stmt->execute();
      $stmt->bind_result($name);
      $stmt->store_result();
      $rnum = $stmt->num_rows;
      if ($rnum==0) {
       $stmt->close();
       $stmt = $conn->prepare($INSERT);
       $stmt->bind_param("ssds", $name, $description, $price, $deliveryDate);
       $stmt->execute();
       echo '<script type="text/javascript">';
       echo 'alert("Item added successfully")';
       echo '</script>';
      } else {
         echo '<script type="text/javascript">';
         echo 'alert("Item exists for chosen delivery date")';
         echo '</script>';
      }
      $stmt->close();
      $conn->close();
      echo "<META http-equiv=\"refresh\" content=\"0; URL=addMenuItems.html\">";
     }
 } else {
   echo '<script type="text/javascript">';
   echo 'alert("All field are required")';
   echo '</script>';
   echo "<META http-equiv=\"refresh\" content=\"0; URL=addMenuItems.html\">";
 }
 ?>
