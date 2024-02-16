<?php
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {

$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "online_book_store_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    echo "Login successful!";
    $_SESSION['email'] = $email;
 

    header('location:ReadBook.php');
} else {
    echo "Login failed. Invalid email or password.";
    

}

$conn->close();
} else {
    // Redirect to "../login.php"
    header("Location: ../loginu.php");
}
?>

 