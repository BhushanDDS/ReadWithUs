<?php

# Database Connection File
include "db_conn.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookstore Home</title>
  <!-- Bootstrap CSS link -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
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
  </style>
</head>
<body>

 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Bookstore</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#featured-books">Featured Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </nav>


  <!-- Jumbotron Header -->
  <div class="jumbotron">
    <h1 class="display-4">Welcome to Our Bookstore</h1>
    <p class="lead">Discover a world of books that captivate your mind and soul.</p>
    <a class="btn btn-primary btn-lg" href="#featured-books" role="button">Explore Featured Books</a>
  </div>
<!-- Suggestions Section -->
<div id="suggestions">
    <h2 class="text-center mb-4">Suggestions</h2>
    <?php
    try {
        $stmt = $conn->query('SELECT * FROM suggesta');
        
        echo '<table id="suggestions">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Book Title</th>';
        echo '<th>Book Author</th>';
        echo '<th>Description</th>';
        echo '</tr>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['book_name'] . '</td>';
            echo '<td>' . $row['book_author'] . '</td>';
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
    <a class="btn btn-success btn-lg" href="#login" role="button">Log In</a>
  </div>

  <!-- Featured Books Section -->
  <div id="featured-books" class="container-fluid featured-books">
    <h2 class="text-center mb-4">Featured Books</h2>
    <div class="row">
      <!-- Replace the content in each card with your book details -->
      <div class="col-md-4">
        <div class="card book-card">
          <img src="book1.jpg" class="card-img-top" alt="Book 1">
          <div class="card-body">
            <h5 class="card-title">Book Title 1</h5>
            <p class="card-text">Author: Author Name</p>
            <a href="#" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card book-card">
          <img src="book2.jpg" class="card-img-top" alt="Book 2">
          <div class="card-body">
            <h5 class="card-title">Book Title 2</h5>
            <p class="card-text">Author: Author Name</p>
            <a href="#" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card book-card">
          <img src="book3.jpg" class="card-img-top" alt="Book 3">
          <div class="card-body">
            <h5 class="card-title">Book Title 3</h5>
            <p class="card-text">Author: Author Name</p>
            <a href="#" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
