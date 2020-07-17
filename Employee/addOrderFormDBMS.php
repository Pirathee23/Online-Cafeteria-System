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
      $SELECT = "SELECT * From menuItems";
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
      ?>
      <form action="addOrderDBMS.php" method="post">
        <table class="addItem">
          <h2>Add items to cart</h2>
          <p>Enter ID of the item you want to add to the cart with special request</p>
          <tr>
            <td>Item ID:</td>
            <td><input type="text" name="itemID" required></td>
          </tr>
          <tr>
           <td>Quantity:</td>
           <td><input type="text" name="quantity" required></td>
          </tr>
          <tr>
           <td>Special Requests:</td>
           <td><input type="text" name="specialRequest"></td>
          </tr>
          <tr>
           <td><input type="submit" value="Submit"></td>
          </tr>
        </table>
      </form>
<?php
      $stmt->close();
      $conn->close();
    }
?>
