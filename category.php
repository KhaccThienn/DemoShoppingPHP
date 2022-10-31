<?php 
  include "connection/connect.php";

  if($conn -> connect_error){
    die("Error connecting to database" .$conn->connect_error) ;
  }

  $sql = "SELECT id, name, CASE WHEN status = 1 THEN 'In Stock' WHEN status = 0 THEN 'Out Of Stock' END AS 'Status' FROM category";
  $result = $conn -> query($sql);

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Categories</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="header">
      <div class="navbar">
        <div class="menu d-flex justify-content-between w-50">
          <a href="index.php" class="text-white text-decoration-none">Home</a>
          <a href="category.php" class="text-white text-decoration-none">Categories</a>
          <a href="product.php" class="text-white text-decoration-none">Products</a>
        </div>
        <form method="GET" class="search-box d-flex" action="search.php">
          <input type="text" class="form-control" placeholder="Search Product..." name="search">
          <button class="btn btn-danger" type="submit">Search</button>
        </form>
        <div class="btn-gr">
          <a href="Creating/createCate.php">
            <button class="btn btn-primary">Add New Category</button>
          </a>
          <a href="Creating/createPro.php">
            <button class="btn btn-primary">Add New Products</button>
          </a>
        </div>
      </div>
      
    </div>

    <div class="main">
      <table class="table table-bordered">
        <thead class="thead-inverse">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody>
            <?php 
              if($result -> num_rows > 0){
                while($row = $result -> fetch_assoc()){
                  echo "
                    <tr>
                      <td scope='row'>$row[id]</td>
                      <td>$row[name]</td>
                      <td>$row[Status]</td>
                    </tr>
                  ";
                }
              }
            ?>
            
          </tbody>
      </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>