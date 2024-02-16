<?php  
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: loginu.php");
    exit;
} else {
        $username = $_SESSION['email'];
        # Database Connection File
        include "db_conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Userpanel</title>

    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <style>
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
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="ReadBook.php">User</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Store</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Suggest-by-user.php">Suggest</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div> 

    <div class="jumbotron text-center">
    <h1 class="display-4">Hello, <?php echo $username; ?>!</h1>
    <p class="lead">Welcome to your User Control Panel. We're excited to have you here.</p>
</div>


    <!-- Login Jumbotron -->
    <div id="login-jumbotron">
        <h1 class="display-4">Suggest Now</h1>
        <p class="lead">You can suggest your great picks for others from here</p>
        <!-- <a class="btn btn-success btn-lg" href="Suggest-by-user.php" role="button">Send It</a> -->
        <a class="btn btn-success btn-lg" href="Suggest-by-user.php?username=<?php echo urlencode($username); ?>" role="button">Send It</a>
      
      <?  $_SESSION['email'] = $email; ?>

    </div>


 <!-- Display Suggestions Table -->
 <div class="mt-5">
            <h2>Books Suggested by You </h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Book Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch data from the 'sugg' table
                    $stmt = $conn->prepare("SELECT book_title, book_description FROM sugg WHERE username = :username");
                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt->execute();

                    // Loop through the results and display them in the table
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['book_title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['book_description']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>



        <!-- Display Reviews Table -->
<div class="mt-5">
    <h2>Reviews by You</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
         
                <th>Rating</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch data from the 'reviews' table
            $stmtReviews = $conn->prepare("SELECT book_id, rating, comment FROM reviews WHERE name = :username");
            $stmtReviews->bindParam(':username', $username, PDO::PARAM_STR);
            $stmtReviews->execute();

            // Loop through the results and display them in the table
            while ($rowReviews = $stmtReviews->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                
                echo "<td>" . htmlspecialchars($rowReviews['rating']) . "</td>";
                echo "<td>" . htmlspecialchars($rowReviews['comment']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>










</body>
</html>

<?php  } ?>
