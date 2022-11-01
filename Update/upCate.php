<?php
  include "../connection/connect.php";

  $name = "";
  $status = "";

  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(!isset($_GET['id'])){
      header("location: ../category.php");
      exit;
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM category WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result -> fetch_assoc();

    $name = $row['name'];
    $status = $row['status'];
  } else {
    
  }
  
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <div class="header">
      <div class="navbar">
        <div class="menu d-flex justify-content-between w-50">
          <a href="../index.php" class="text-white text-decoration-none">Home</a>
          <a href="../category.php" class="text-white text-decoration-none">Categories</a>
          <a href="../product.php" class="text-white text-decoration-none">Products</a>
        </div>
        <form method="GET" class="search-box d-flex" action="../search.php">
          <input type="text" class="form-control" placeholder="Search Product..." name="search">
          <button class="btn btn-danger" type="submit">Search</button>
        </form>
        <div class="btn-gr">
          <a href="../Creating/createCate.php">
            <button class="btn btn-primary">Add New Category</button>
          </a>
          <a href="../Creating/createPro.php">
            <button class="btn btn-primary">Add New Products</button>
          </a>
        </div>
      </div>
    </div>
    <div class="main p-5">
      <div class="text-center">
        <h1 class="text-success">Update Category: </h1>
      </div>
      <?php 
        if(!empty($errMessage)){
          echo "
          <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>
              $errMessage
            </strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
            </button>
          </div>
        ";
        };

        if(!empty($succMessage)){
          echo "
          <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>
              $succMessage
            </strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
            </button>
          </div>
        ";
        };
        
      ?>
      <form method="POST">
        <div class="container">
          <div class="d-flex">
            <input type="text" name="name" placeholder="Category's Name" class="form-control" value="<?php echo $name?>">
            <select name="status" id="">
              <option value="1">In Stock</option>
              <option value="0">Out Of Stock</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </div>
      </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>