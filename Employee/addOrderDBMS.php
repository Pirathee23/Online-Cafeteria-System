<?php
$itemID = $_POST['itemID'];
$quantity =  $_POST['quantity'];
$specialRequest =  $_POST['specialRequest'];
$accountType = "employee";
$state = "pending";

if (!empty($itemID) || !empty($quantity)) {
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
      $SELECTITEMS = "SELECT itemID From menuItems Where itemID = '".$itemID."' Limit 1";
      $result = mysqli_query($conn, $SELECTITEMS);
      $rowNum = mysqli_num_rows($result);
      if ($rowNum==0) {
        echo '<script type="text/javascript">';
        echo 'alert("Item ID selected does not exist!")';
        echo '</script>';
        echo "<META http-equiv=\"refresh\" content=\"0; URL=addOrderForm.php\">";
      }elseif ($quantity == 1 || $quantity == 2 || $quantity == 3 || $quantity == 4 || $quantity == 5) {
        $SELECTORDERS = "SELECT itemID From orders Where itemID = ? AND username = ? Limit 1";
        //Prepare statement
        $stmt = $conn->prepare($SELECTORDERS);
        $stmt->bind_param("ds", $itemID, $username);
        $stmt->execute();
        $stmt->bind_result($itemID);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        $stmt->close();
        if ($rnum==0) {
          $SELECTMENU = "SELECT * From menuItems Where itemID = '".$itemID."' Limit 1";
          $result = mysqli_query($conn, $SELECTMENU);
          $rowNum = mysqli_num_rows($result);
          while ($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $deliveryDate = $row['deliveryDate'];
          }
          if ($deliveryDate == "Monday" || $deliveryDate == "Tuesday" || $deliveryDate == "Wednesday"){
            echo '<script type="text/javascript">';
            echo 'alert("Order has to be placed 3 days in advance!")';
            echo '</script>';
            echo "<META http-equiv=\"refresh\" content=\"0; URL=addOrderForm.php\">";
          } else{
            $INSERT = "INSERT INTO orders (username, quantity, specialRequest, itemID, name, description, price, deliveryDate, state) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sdsdssdss", $username, $quantity, $specialRequest, $itemID, $name, $description, $price, $deliveryDate, $state);
            $stmt->execute();
            $stmt->close();
            echo '<script type="text/javascript">';
            echo 'alert("Order Successfully Placed!")';
            echo '</script>';
            echo "<META http-equiv=\"refresh\" content=\"0; URL=addOrderForm.php\">";
          }
        }
        else {
          echo '<script type="text/javascript">';
          echo 'alert("Item has already been ordered!")';
          echo '</script>';
          echo "<META http-equiv=\"refresh\" content=\"0; URL=addOrderForm.php\">";
        }
      } else {
        echo '<script type="text/javascript">';
        echo 'alert("Quantity must be greater than 0 and less than 6!")';
        echo '</script>';
        echo "<META http-equiv=\"refresh\" content=\"0; URL=addOrderForm.php\">";
      }
    }
}
else {
  echo '<script type="text/javascript">';
  echo 'alert("Item ID, and Quantity Required!")';
  echo '</script>';
  echo "<META http-equiv=\"refresh\" content=\"0; URL=addOrderForm.php\">";
}
?>
