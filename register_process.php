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



$username =$_POST['user_name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (user_name,email, password) VALUES ('$username','$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header('location:loginu.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
} else {
    // Redirect to "../login.php"
    header("Location: ../loginu.php");
}
?>