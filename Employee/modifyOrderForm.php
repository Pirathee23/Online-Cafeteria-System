<html>
<head>
    <title>Modify/Delete Order Form</title>
    <style>
        body {
            background-color: #333;
        }
        nav {
          width: 100%;
          height: 45px;
          margin: 0;
          padding: 0;
          background-color: #111;
        }
        nav ul {
          list-style-type: none;
          margin: 0;
          padding: 0;
          display: inline-block;
        }
        nav ul li {
            float: left;
            list-style: none;
            position: relative;
            border-right: 1px solid #bbb;
            border-left: 1px solid #bbb;
        }
        nav ul li a {
          display:block;
          color: #fff;
          padding: 13px 20px;
          text-decoration: none;
        }
        nav ul li a:hover {
          background-color: #111;
        }
       .current {
          background-color: #911;
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
  <h1 style="color:white">Modify/Delete Order Form</h1>
  </center>
    <table>
        <tr>
            <th>Name</th>
            <th>Special Request</th>
						<th>Delivery Date</th>
					  <th>Quantity</th>
            <th>Price</th>
						<th>Total</th>
            <th>Action</th>
        </tr>
          <?php include 'modifyOrderFormDBMS.php';?>
    </table>
  </body>
</html>
