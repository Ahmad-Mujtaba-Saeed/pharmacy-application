<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
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

  <a href="index.php" style="text-decoration:none; color:black;">
    <h3>GO home</h3>
  </a>
  <?php
  require 'includes/dbcoon.php';



  $sql = "SELECT * FROM cartid order by id desc";
  $stm = $conn->prepare($sql);
  $stm->execute();

  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  $totalprice = 0;

  foreach ($result as $row) {
    $itemid = $row['itemid'];
    $totalitem = $row['totalitem'];
    $sql = "SELECT * FROM products where id = $itemid";
    $stm = $conn->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    $row = $result[0];
    $name = $row['name'];
    $price = $row['price'] * $totalitem;
    $location = $row['location'];
    $stock = $row['stock'];
    $totalprice = $totalprice + $price;


    echo '<table>
        <tr>
          <th>Product name</th>
          <th>Price</th>
          <th>Stock available</th>
          <th>Location</th>
          <th>Remove item</th>
          <th>plus item </th>
          <th>subtract item </th>
          <th>total item </th>
        </tr>
        <tr>
          <td>
           ' . $name . '
          </td>
          <td>
            ' . $price . ' 
          </td>
          <td>
        ' . $stock . '
          </td>
          <td>
            ' . $location . '
          </td>
         <td>
         <form method="post" action="submit.php">
         <input type="hidden" name="id" value="' . $itemid . '">
         <button type="submit" name="clear_item">Click here to remove item</button>
         </form></td>
         <td>
         <form method="post" action="submit.php">
         <input type="hidden" name="id1" value=' . $itemid . '>
         <button type="submit" name="add_plus">+1</button></form></td>
         <td>
         <form method="post" action="submit.php">
         <input type="hidden" name="id2" value=' . $itemid . '>
         <button type="submit" name="add_plus">-1</button></form></td>
         <td>' . $totalitem . '</td>
        </tr>
  
      </table>


     ';
  }
  echo '<br><br>
    <form method="post" action="submit.php">
    
    <center><button name="clear_cart" type="submit" style="padding-left:20px;padding-right:20px;">Clear cart</button>
    </center></form>';
  echo ' <br><br><br> <table>
<tr>
        <th>Total bill</th>
        <th>Do you want to print the bill</th>
</tr>
<td>' . $totalprice . '</td>
<td><button onclick="window.print()" style="padding-left:20px;padding-right:20px;">Print bill</button></td>
</table>';
  ?>

</body>

</html>