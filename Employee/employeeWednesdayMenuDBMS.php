<html>
<head>
  <style>
    body {
      color: white;
    }
    .addItem {
    font-size: 20px;
    text-align: left;
  }
  .addItem {
  font-size: 20px;
  text-align: left;
  width: 30%
}
    .addItem tr {
      background-color: #333;
    }
    .addItem td {
        border-right: none;
        border-left: none;
      }

  </style>
</head>
</html>

<?php
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
      $SELECT = "SELECT * From menuItems WHERE deliveryDate = 'Wednesday'";
      $result = mysqli_query($conn, $SELECT);
      $rowNum = mysqli_num_rows($result);

      if ($rowNum == 0) {
      }
      else {
        while ($row = mysqli_fetch_assoc($result)){
            echo "<tr>
                    <td>" . $row['itemID']. "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['description']. "</td>
                    <td>" . $row['price'] . "</td>
                    <td>" . $row['deliveryDate'] . "</td>
                </tr>";
        }
            echo "</table>";
      }
      $stmt->close();
      $conn->close();
    }
?>
