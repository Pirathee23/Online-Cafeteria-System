
<html>
<head>
    <title>Order Form</title>
    <h1>Current Day: Monday</h1>
    <style>
        body {
            background-color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            color: #588c7e;
            font-family: monospace;
            font-size: 25px;
            text-align: center;

        }
        th {
            background-color: #330000;
            color: white;
            padding: 0px 20px;
            border-right: 2px solid #bbb;
            border-left: 2px solid #bbb;
            border-top: 2px solid #bbb;
            border-bottom: 2px solid #bbb;

        }
        tr {
            background-color: #440000;
            color: white;

        }
        td {
          border-right: 2px solid #bbb;
          border-left: 2px solid #bbb;
        }
    </style>
</head>
<body>
  <div align="right">
    <button type="button"><a href="employee.html">Go Back</a></button>
    <button type="button"><a href="shoppingCart.php">Cart</a></button>
    <button type="button"><a href="../login.html">Logout</a></button>
  </div>
<center>
  <h1 style="color:white">Order Form</h1>
</center>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Delivery Date</th>
        </tr>
          <?php include 'addOrderFormDBMS.php';?>
    </table>
  </body>
</html>
