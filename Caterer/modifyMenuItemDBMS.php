<?php
$updateChoice = $_POST['updateChoice'];
$modifyItem = $_POST['modifyItem'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$deliveryDate = $_POST['deliveryDate'];

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
    $SELECT = "SELECT itemID From menuItems Where itemID = ? Limit 1";
    $DELETE = "DELETE From menuItems Where itemID = ?";
    //Prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("d", $modifyItem);
    $stmt->execute();
    $stmt->bind_result($modifyItem);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    if ($rnum==0) {
      echo '<script type="text/javascript">';
      echo 'alert("Item ID provided does not exist!")';
      echo '</script>';
      echo "<META http-equiv=\"refresh\" content=\"0; URL=modifyMenuItems.php\">";
    } else {
      $stmt->close();
      $stmt = $conn->prepare($DELETE);
      $stmt->bind_param("d", $modifyItem);
      $stmt->execute();
      echo '<script type="text/javascript">';
      echo 'alert("Item deleted successfully!")';
      echo '</script>';
      echo "<META http-equiv=\"refresh\" content=\"0; URL=modifyMenuItems.php\">";
    }
  } else {
    $UPDATE = "UPDATE menuItems set name = '".$name."', description = '".$description."', price = '".$price."', deliveryDate = '".$deliveryDate."' WHERE itemID ='".$modifyItem."'";

    //Prepare statement
    $stmt = $conn->prepare($UPDATE);
    $stmt->execute();
    echo '<script type="text/javascript">';
    echo 'alert("Item updated successfully!")';
    echo '</script>';
    echo "<META http-equiv=\"refresh\" content=\"0; URL=modifyMenuItems.php\">";
  }


  $stmt->close();
  $conn->close();

}

?>
