<?php  
session_start();

// if (!isset($_SESSION['email'])) {
//     header("Location: loginu.php");
//     exit;
// } else {
//         $username = $_SESSION['email'];
//         # Database Connection File
//         include "db_conn.php";
// book-details.php


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

    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if 'id' is set in the query parameters
if (isset($_GET['id'])) {
        $bookId = $_GET['id'];


                
        if (!isset($_SESSION['email'])) {
            header("Location: loginu.php");
            exit;
        } else
         {
            $username = $_SESSION['email'];

        // Fetch book details from the database
        $stmt = $conn->prepare('SELECT b.id as book_id, b.title, a.name as author_name, b.description
        FROM books b
        JOIN authors a ON b.author_id = a.id
        WHERE b.id = :id');
        $stmt->bindParam(':id', $bookId);
        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        // Display book details
        if ($book) {
            $pageTitle = $book['title'];
            ?>


<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php echo $pageTitle; ?></title>
                <style>
                    body {
                        background-color: #f8f9fa;
                    }

                    .container {
                        max-width: 800px;
                        margin: auto;
                        margin-top: 50px;
                    }

                    h1 {
                        color: #007bff;
                    }

                    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        border: 1px solid #dee2e6;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    th {
        background-color: #007bff;
        color: #ffffff;
    }


                   
                    .book-image {
                        max-width: 100%;
                        height: auto;
                        margin-top: 20px;
                    }

                    .btn-primary {
                        margin-top: 20px;
                    }

                      /* ... (existing styles) ... */
    .review-form {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        background-color: #ffffff;
    }

    .review-form h2 {
        color: #007bff;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
  </style>
    </head>
            <body>

            <div class="jumbotron text-center">
    <h1 class="display-4">Hello, <?php echo $username; ?>!</h1>
    <p class="lead"> We're excited to have you here.</p>
</div>
            
                <div class="container">

                    <h1><?php echo $book['title']; ?></h1>
                

                    <table class="table">
                        <tr>
                            <th>Book ID</th>
                            <td><?php echo $book['book_id']; ?></td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td><?php echo $book['title']; ?></td>
                        </tr>
                        <tr>
                            <th>Author</th>
                            <td><?php echo $book['author_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?php echo $book['description']; ?></td>
                        </tr>
                        <!-- Add more details as needed -->
                    </table>

                    


<div>

<a href="index.php" class="btn btn-primary">Back to Home</a>


</div>
                </div>



                <!-- Reviews Section -->
<div class="reviews-section">
    <h2>Book Reviews</h2>
    <?php
    // Fetch reviews for the book
    $stmtReviews = $conn->prepare('SELECT * FROM reviews WHERE book_id = :book_id ORDER BY rating DESC');
    $stmtReviews->bindParam(':book_id', $bookId);
    $stmtReviews->execute();
    $reviews = $stmtReviews->fetchAll(PDO::FETCH_ASSOC);

    if ($reviews) {
        ?>
        <table class="table">
            <tr>
                <th>Reviewer Name</th>
                <th>Comment</th>
            </tr>
            <?php
            foreach ($reviews as $review) {
                ?>
                <tr>
                    <td><?php echo $review['name']; ?></td>
                    <td><?php echo $review['comment']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    } else {
        echo "No reviews available for this book.";
    }
    ?>
</div>

                 <!-- Review Form -->
                 <div class="review-form">
                        <h2>Add a Review</h2>
                        <form action="php/submit-review.php" method="post">
                        <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
                        <div class="form-group">
            <label for="name">Your Name:</label>
            <!-- Set the value of the input field to the username from the session -->
            <input type="text" name="name" id="name" value="<?php echo isset($username) ? htmlspecialchars($username, ENT_QUOTES, 'UTF-8') : ''; ?>" required>
        </div>
                            <div class="form-group">
                             <label for="rating">Rating:</label>
                            <input type="number" name="rating" id="rating" min="1" max="5" required>
                            </div>

                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea name="comment" id="comment" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>

            </body>
            </html>

            <?php
        } else {
            echo "Book not found";
        }
         }
    } else {
        echo "Invalid request. Book ID is missing.";
    }
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }




