<?php 
session_start();

# Database Connection File
include "db_conn.php";

# Book helper function
include "php/func-book.php";
$books = get_all_books($conn);

# author helper function
include "php/func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "php/func-category.php";
$categories = get_all_categories($conn);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ReadWithUs</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">

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
		/* Add your custom styles here */
		body {
      background-color: #f8f9fa;
    }

    .jumbotron {
      background-color: #87CEEB; /* Light Blue */
      color: #ffffff; /* White text */
      text-align: center;
      padding: 100px;
      margin-bottom: 0;
    }

    .featured-books {
      padding: 50px 0;
      background-color: #ffffff;
    }

    .book-card {
      margin-bottom: 20px;
    }

    /* Styling for Suggestions Table */
    #suggestions {
      margin: 20px auto;
      border-collapse: collapse;
      width: 100%; /* Make the table width 100% of the screen */
    }

    #suggestions th, #suggestions td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    #suggestions th {
      background-color: #007bff; /* Blue background for table header cells */
      color: #ffffff; /* White text for table header cells */
    }
      /* Additional Jumbotron Styles */
      #login-jumbotron {
      background-color: #28a745; /* Green background for the login jumbotron */
      color: #ffffff; /* White text for the login jumbotron */
      text-align: center;
      padding: 100px;
      margin-bottom: 0;



    }



    .form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 0vh; /* vh stands for viewport height */
}

form {
  width: 50%; /* adjust this value to control the form's width */
}
    </style>
<body>
	
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">ReadW!thUs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <a class="nav-link" href="admin.php">Admin</a>
                        <?php } else { ?>
                            <a class="nav-link" href="loginu.php">User</a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
     
		  

		</div>


		 <!-- Jumbotron Header -->
		 <div class="jumbotron">
    <h1 class="display-4">Welcome to ReadW!thUS</h1>
    <p class="lead">Discover a world of books that captivate your mind and soul.</p>
    <a class="btn btn-primary btn-lg" href="loginu.php" role="button">Explore Featured Books</a>
  </div>



  <div  class="form-container">
  <form action="search.php"
             method="get" 
             style="width: 100%; max-width: 30rem ">

       	<div class="input-group my-5">
		  <input type="text" 
		         class="form-control"
		         name="key" 
		         placeholder="Search Book..." 
		         aria-label="Search Book..." 
		         aria-describedby="basic-addon2">

		  <button class="input-group-text
		                 btn btn-primary" 
		          id="basic-addon2">
		          <img src="img/search.png"
		               width="20">

		  </button>
		</div>
       </form>



  </div>


<div>

<!-- Suggestions Section -->
<div id="suggestions">
    <h2 class="text-center mb-4">Hot Suggestions</h2>
    <?php
    try {
        $stmt = $conn->query('SELECT * FROM suggesta');
        
        echo '<table id="suggestions">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Book Title</th>';
        echo '<th>Description</th>';
        echo '</tr>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['book_name'] . '</td>';

            echo '<td>' . $row['decs'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
  </div>

    <!-- Login Jumbotron -->
    <div id="login-jumbotron">
    <h1 class="display-4">Log In to Access More Features</h1>
    <p class="lead">Unlock personalized recommendations and exclusive content by logging in.</p>
    <a class="btn btn-success btn-lg" href="loginu.php" role="button">Log In</a>
  </div>

<div>
	   <div>
		<div class="d-flex pt-3">
			<?php if ($books == 0){ ?>
				<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			    There is no book in the database
		       </div>
			<?php }else{ ?>
			<div class="pdf-list d-flex flex-wrap">
				<?php foreach ($books as $book) { ?>
				<div class="card m-1">
					<img src="uploads/cover/<?=$book['cover']?>"
					     class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">
							<?=$book['title']?>
						</h5>
						<p class="card-text">
							<i><b>By:
								<?php foreach($authors as $author){ 
									if ($author['id'] == $book['author_id']) {
										echo $author['name'];
										break;
									}
								?>

								<?php } ?>
							<br></b></i>
							<?=$book['description']?>
							<br><i><b>Category:
								<?php foreach($categories as $category){ 
									if ($category['id'] == $book['category_id']) {
										echo $category['name'];
										break;
									}
								?>

								<?php } ?>
							<br></b></i>
						</p>
                       <a href="uploads/files/<?=$book['file']?>"
                          class="btn btn-success">Open</a>

                        <a href="uploads/files/<?=$book['file']?>"
                          class="btn btn-primary"
                          download="<?=$book['title']?>">Download</a>

                          <a href="trial2.php?id=<?= $book['id'] ?>" class="btn btn-primary"
                          >View </a>

						
					</div>
				</div>
				<?php } ?>
			</div>
		<?php } ?>

		<div class="category">
			<!-- List of categories -->
			<div class="list-group">
				<?php if ($categories == 0){
					// do nothing
				}else{ ?>
				<a href="#"
				   class="list-group-item list-group-item-action active">Category</a>
				   <?php foreach ($categories as $category ) {?>
				  
				   <a href="category.php?id=<?=$category['id']?>"
				      class="list-group-item list-group-item-action">
				      <?=$category['name']?></a>
				<?php } } ?>
			</div>

			<!-- List of authors -->
			<div class="list-group mt-5">
				<?php if ($authors == 0){
					// do nothing
				}else{ ?>
				<a href="#"
				   class="list-group-item list-group-item-action active">Author</a>
				   <?php foreach ($authors as $author ) {?>
				  
				   <a href="author.php?id=<?=$author['id']?>"
				      class="list-group-item list-group-item-action">
				      <?=$author['name']?></a>
				<?php } } ?>
			</div>
		</div>
		</div>
	</div>

 


	
?>
</body>
</html>