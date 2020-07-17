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
.form-control{
	height: 30px;
	font-size: 20px;
	color:white;
	border: 1px solid black;
	background: #330000;
	opacity: 0.9;
	box-shadow: none !important;
}
.form-control-quantity{
	text-align:center;
	height: 30px;
	width: 50px;
	font-size: 20px;
	color:white;
	border: 1px solid black;
	background: #330000;
	opacity: 0.9;
	box-shadow: none !important;
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
      $SELECT_ACTIVE = "SELECT username From users Where active = 'active' Limit 1";
      $resultUser = mysqli_query($conn, $SELECT_ACTIVE);
      $rowNum = mysqli_num_rows($resultUser);
      while ($rowUser = mysqli_fetch_assoc($resultUser)){
        $username = $rowUser['username'];
      }
      $SELECT = "SELECT * FROM orders WHERE state = 'pending' AND username = '".$username."'";
      $result = mysqli_query($conn, $SELECT);
      $rowNum = mysqli_num_rows($result);

      if ($rowNum == 0) {
      }
      else {
        while ($row = mysqli_fetch_assoc($result)){
					?>
					<form action="processShoppingCartDBMS.php" method="post">

					<tr>
					<td><?php echo $row['name']; ?></td>
					<td><input class="form-control" type="text" name="specialRequest" placeholder="<?php echo $row["specialRequest"]; ?>"></td>
					<td><?php echo $row['deliveryDate']; ?></td>
					<td><input class="form-control-quantity" type="text" name="quantity" placeholder="<?php echo $row["quantity"]; ?>"></td>
					<td>$ <?php echo $row["price"]; ?></td>
					<td>$ <?php echo number_format($row["quantity"] * $row["price"], 2);?></td>

					<td><input hidden type="text" name="modifyItem" value="<?php echo $row["orderID"]; ?>">
					<input type="submit" name="updateChoice" value=remove>
					<input type="submit" name="updateChoice" value=update></td>
					</tr>
					<?php
					$total = $total + ($row["quantity"] * $row["price"]);
        }
				?>
				<tr>
				<td colspan="5" align="right">Total</td>
				<td align="right">$ <?php echo number_format($total, 2); ?></td>
				<td></td>
				</tr>
			</form>
    </table>
      <table>
        <br>
        <br>
        <div align="center">
          <button type="button" class="btn btn-primary"><a href="checkout.php">Checkout</a></button>
        </div>
      </table>
				<?php
      }
      $stmt->close();
      $conn->close();
    }
?>
