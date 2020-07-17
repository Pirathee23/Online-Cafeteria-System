<html>
<head>
  <style>
    body {
      color: white;
    }
    .tableFormat {
    font-size: 20px;
    text-align: left;
  }
  .tableFormat {
  font-size: 20px;
  text-align: left;
  width: 30%
}
.form-control{
  text-align:center;
	height: 30px;
	font-size: 20px;
	color:white;
	border: 1px solid black;
	background: #330000;
	opacity: 0.9;
	box-shadow: none !important;
}


    .tableFormat tr {
      background-color: #333;
      border-bottom:1px;

    }
     .tableFormat td {
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
					?>
					<form class = "tableFormat" action="modifyMenuItemDBMS.php" method="post">

					<tr>
          <td><input class="form-control" type="text" name="name" placeholder="<?php echo $row["name"]; ?>"></td>
					<td><input class="form-control" type="text" name="description" placeholder="<?php echo $row["description"]; ?>"></td>
					<td><input class="form-control" type="text" name="price" placeholder="<?php echo $row["price"]; ?>"></td>
          <td><input class="form-control" type="text" name="deliveryDate" placeholder="<?php echo $row["deliveryDate"]; ?>"></td>

					<td><input hidden type="text" name="modifyItem" value="<?php echo $row["itemID"]; ?>">
					<input type="submit" name="updateChoice" value=remove>
					<input type="submit" name="updateChoice" value=update></td>
					</tr>
        </form>

					<?php
        }
      }
      $stmt->close();
      $conn->close();
    }
?>
