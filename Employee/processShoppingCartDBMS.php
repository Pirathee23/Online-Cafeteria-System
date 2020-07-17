<?php
$updateChoice = $_POST['updateChoice'];
$modifyItem = $_POST['modifyItem'];
$specialRequest = $_POST['specialRequest'];
$quantity = $_POST['quantity'];

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
  if ($updateChoice=="remove"){
    $SELECT = "SELECT orderID From orders Where orderID = ? Limit 1";
    $DELETE = "DELETE From orders Where orderID = ?";
    //Prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("d", $modifyItem);
    $stmt->execute();
    $stmt->bind_result($modifyItem);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    if ($rnum==0) {
      echo '<script type="text/javascript">';
      echo 'alert("Order provided does not exist!")';
      echo '</script>';
      echo "<META http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
    } else {
      $stmt->close();
      $stmt = $conn->prepare($DELETE);
      $stmt->bind_param("d", $modifyItem);
      $stmt->execute();
      $stmt->close();
      echo '<script type="text/javascript">';
      echo 'alert("Order deleted successfully!")';
      echo '</script>';
      echo "<META http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
    }
  } else {
    if (empty($specialRequest)) {
      if ($quantity >= 1 && $quantity < 6){
        $UPDATE = "UPDATE orders set quantity = '".$quantity."' WHERE orderID ='".$modifyItem."'";
      } else if ($quantity == 0){
        $UPDATE = "DELETE From orders Where orderID ='".$modifyItem."' ";
      } else {
        echo '<script type="text/javascript">';
        echo 'alert("Quantity must be greater than 0 or less than 6!")';
        echo '</script>';
        echo "<META http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
      }
    } else if (empty($quantity)) {
        $UPDATE = "UPDATE orders set specialRequest = '".$specialRequest."' WHERE orderID ='".$modifyItem."'";
    } else {
      if ($quantity >= 1 && $quantity < 6){
        $UPDATE = "UPDATE orders set specialRequest = '".$specialRequest."', quantity = '".$quantity."' WHERE orderID ='".$modifyItem."'";
      } else {
        echo '<script type="text/javascript">';
        echo 'alert("Quantity must be less than 6!")';
        echo '</script>';
        echo "<META http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
      }
    }
    //Prepare statement

    $stmt = $conn->prepare($UPDATE);
    $stmt->execute();
    $stmt->close();
    echo '<script type="text/javascript">';
    echo 'alert("Order updated successfully!")';
    echo '</script>';
    echo "<META http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
  }


  $conn->close();

}

?>
