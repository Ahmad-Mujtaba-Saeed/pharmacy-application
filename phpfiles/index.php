<?php
require 'includes/dbcoon.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>medic program</title>
</head>

<body>

  <center>
    <br><br><br><br>
    <button onclick="showhide(1)">Enter new product</button>&nbsp;&nbsp;<button onclick="showhide(2)">Find the
      product</button><br><br>
    <form id="1" method="post" action="submit.php" style="display:none;">
      <input type="text" name="name" placeholder="Name of your product"
        style="padding-left:10px; padding-right:30px;"><br><br>
      <input type="text" name="price" placeholder="Price of your product"
        style="padding-left:10px; padding-right:30px;"><br><br>
      <input type="text" name="location" placeholder="location of this product"
        style="padding-left:10px; padding-right:30px;"><br><br>
      <input type="text" name="stock" placeholder="number of stock you have"
        style="padding-left:10px; padding-right:30px;"><br><br>
      <button type="submit" name="insert" style="padding-left:30px;  padding-right:30px;">Submit</button>
    </form>
    <form id="2" method="post" action="submit.php">
      <input type="text" name="name" placeholder="Name of product"
        style="padding-left:10px; padding-right:30px;"><br><br>
      <button type="submit" name="get" style="padding-left:30px;  padding-right:30px;">Search</button>
    </form>
  </center>
  <script>
    function showhide(num) {
      if (num == 1) {
        document.getElementById("1").style.display = "block";
        document.getElementById("2").style.display = "none";
      } else {
        document.getElementById("1").style.display = "none";
        document.getElementById("2").style.display = "block";
      }
    }

  </script>
  <br><br><br>
  <h2>Results</h2>
  <?php
  if (isset($_GET['error'])) {
    if ($_GET['error'] == true) {
      echo "<center><h3>Product added successfully</h3></center>";
    }
  }
  if (isset($_GET['cart'])) {
    if ($_GET['cart'] == true) {
      echo "<center><h3>Product added to cart successfully</h3></center>";

    }
  }
  ?>
  <br>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
  <?php

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $stm = $conn->prepare($sql);
    $stm->execute();

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    $row = $result[0];
    $name = $row['name'];
    $id = $row['id'];
    $price = $row['price'];
    $location = $row['location'];
    $stock = $row['stock'];
    ?>
    <table>
      <tr>
        <th>Product name</th>
        <th>Price</th>
        <th>Stock available</th>
        <th>Location</th>
        <th>Add item</th>
      </tr>
      <tr>
        <td>
          <?php echo $name; ?>
        </td>
        <td>
          <?php echo $price ?>
        </td>
        <td>
          <?php echo $stock ?>
        </td>
        <td>
          <?php echo $location ?>
        </td>
        <center>
          <form method="post" action="submit.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <td id="5" style="background-color:gray;  color:#50f24e;"><button type="submit" name="cart_insert">Add to
                cart</button></td>

          </form>
        </center>
      </tr>

    </table>


    <?php
  }
  echo "   <br><br>
  <center><a href='cartitem.php'>
    <button style='padding-left:20px;padding-right:20px;padding-top:10px;padding-bottom:10px;'>
      View cart
    </button></a>
  </center>";
  ?>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

  <script src="ajax.js"></script>

</body>

</html>