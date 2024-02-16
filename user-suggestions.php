<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "db_conn.php";
  




?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>suggestions</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<style>
    
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
<body>
<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="admin.php">Admin</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" 
		         id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link" 
		             aria-current="page" 
		             href="index.php">Store</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-book.php">Add Book</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-category.php">Add Category</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-author.php">Add Author</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="logout.php">Logout</a>
		        </li>
			<li class="nav-item">
		        <div class="dropdown">
  					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  								  Select
  					</button>
  						<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    							<li><a class="dropdown-item" href="displayCat.php">Categories</a></li>
    							<li><a class="dropdown-item" href="displayAuth.php">Authors</a></li>
  	  							<li><a class="dropdown-item" href="displaybook.php">Books</a></li>
									<li><a class="dropdown-item" href="SuggestA.php">Suggest</a></li>
									<li><a class="dropdown-item" href="user-suggestions.php">User Suggetions</a></li>

  						</ul>
				</div>
		    </li>
		      </ul>
		    </div>
		  </div>
	</div>	  
		</nav>

<?php
try {
    $stmt = $conn->query('SELECT * FROM sugg');
    
    echo '<table>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Book Title</th>';
    echo '<th>Description</th>';
    echo '</tr>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['book_title'] . '</td>';
        echo '<td>' . $row['book_description'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>





</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>