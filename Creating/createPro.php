<?php 
  include "../connection/connect.php";
  
  if($conn -> connect_error){
    die("Error connecting to Database" .$conn->connect_error);
  }

  $name = "";
  $status = "";
  $price = "";
  $sale_price = "";
  $category_id = "";
  $image = "";

  $errMessage = "";
  $succMessage = "";

  $sqlpro = "SELECT id, name FROM category ORDER BY id ASC";
  $result = $conn -> query($sqlpro);

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $category_id = $_POST['category_id'];
    $image = $_POST['image'];

    do{
      if(empty($name) ){
        $errMessage = "All Fields are required";
        break;
      };
      
      $stmt = $conn->prepare("INSERT INTO products(name, status, price, sale_price, category_id, image) VALUES (?,?, ?, ?, ?, ?)");
      
      $stmt -> bind_param('sissss', $name, $status, $price, $sale_price, $category_id, $image);
      $stmt -> execute();
      echo "<script type='text/javascript'>alert('Submit Successfully');</script>";
      $stmt -> close();
      $conn -> close();

      $name = "";
      $status = "";

      $succMessage = "Succesfully";
      header("location: ../product.php");
      exit;
    } while (false);
  }


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Create Category</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
          <a href="createCate.php">
            <button class="btn btn-primary">Add New Category</button>
          </a>
          <a href="createPro.php">
            <button class="btn btn-primary">Add New Products</button>
          </a>
        </div>
      </div>
    </div>

    <div class="main p-5">
      <div class="text-center">
        <h1 class="text-success">Create A New Product</h1>
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
          <div class="d-flex align-items-center">
            <div class="form-group w-100">
              <label for="name">Product's Name</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Product's Name" aria-describedby="helpId">
            </div>
            <div class="form-group w-100">
              <label for="status">Status</label>
              <select class="form-select" id="status" name="status" aria-label="Default select example">
                <option value="1">In Stock (Default)</option>
                <option value="0">Out Of Stock</option>
              </select>
            </div>
          </div>

          <div class="d-flex align-items-center mt-3">
            <div class="form-group w-100">
              <label for="price">Product's Price</label>
              <input type="text" name="price" id="price" class="form-control" placeholder="Product's Price" aria-describedby="helpId">
            </div>
            <div class="form-group w-100">
              <label for="sale_price">Product's Sale Price</label>
              <input type="text" name="sale_price" id="sale_price" class="form-control" placeholder="Product's Sale Price" aria-describedby="helpId">
            </div>
          </div>

          <div class="d-flex align-items-center mt-3">
            <div class="form-group w-100">
              <label for="CategoryID">CategoryID</label>
              <select class="form-select" name="category_id" id="CategoryID" aria-label="Default select example">
                <?php 
                  if($result -> num_rows > 0){
                    while($row = $result -> fetch_assoc()){
                      echo "
                        <option value=$row[id]> $row[id] ($row[name])</option>
                      ";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group w-100">
              <label for="image">Product's Image</label>
              <input type="text" name="image" id="image" class="form-control" placeholder="Product's Image" aria-describedby="helpId">
            </div>
          </div>


          <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </div>
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>