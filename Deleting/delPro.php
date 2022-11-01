<?php 
  include '../connection/connect.php';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE products FROM products WHERE id = $id";
    $conn -> query($sql);
  };
  header("location: ../product.php");
  exit;
?>