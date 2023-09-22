<?php
require 'dbcoon.php';

class product
{
    public $name;
    public $price;
    public $location;
    public $stock;

    public function search($name, $conn)
    {
        $sql = "SELECT * FROM products WHERE name = '$name'";
        $stm = $conn->prepare($sql);
        $stm->execute();

        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $row = $result[0];
        $id = $row['id'];


        header("location:../index.php?id=$id");
        exit;
    }
    public function insert_product($name, $location, $stock, $price, $conn)
    {
        $sql = "INSERT INTO products(name,stock,location,price) VALUES('$name','$stock','$location','$price');";
        $stm = $conn->prepare($sql);
        $stm->execute();

        header("location:index.php?error=true");
        exit;
    }
    public function insert_item_cart($itemid, $conn)
    {
        $sql = "INSERT INTO cartid(itemid) VALUES('$itemid');";
        $stm = $conn->prepare($sql);
        $stm->execute();
        header("Location:index.php?cart=done");
        exit;
    }
    public function clear_cart($conn)
    {

        $sql = 'DELETE FROM cartid';

        $statement = $conn->prepare($sql);
        $statement->execute();
        header("location:cartitem.php?error=clearcart");
        exit;
    }
    public function clear_item_cart($id, $conn)
    {
        $sql = 'DELETE FROM cartid where itemid = ' . $id;

        $statement = $conn->prepare($sql);
        $statement->execute();
        header("location:cartitem.php?error=clearitem");
        exit;
    }
    public function plus1($itemid, $conn)
    {
        $sql = "UPDATE cartid SET totalitem = totalitem + 1 WHERE itemid = $itemid;";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $sql = "UPDATE products SET stock = stock - 1 WHERE id = $itemid;";
        $stm = $conn->prepare($sql);
        $stm->execute();
        header("Location:cartitem.php?cart=ok");
        exit;
    }
    public function sub1($itemid, $conn)
    {
        $sql = "UPDATE cartid SET totalitem = totalitem - 1  WHERE itemid = $itemid;";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $sql = "UPDATE products SET stock = stock + 1 WHERE id = $itemid;";
        $stm = $conn->prepare($sql);
        $stm->execute();
        header("Location:cartitem.php?cart=ok");
        exit;
    }
}
?>