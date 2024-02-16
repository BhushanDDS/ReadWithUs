<?php  
session_start();



	# Database Connection File
	include "../db_conn.php";

    # Validation helper function
    include "func-validation.php";

    # File Upload helper function
    include "func-file-upload.php";



	if (isset($_POST['book_title'])       &&
        isset($_POST['book_description'])
     ) {
		
		$username=$_POST['username'];
		$title       = $_POST['book_title'];
		$description = $_POST['book_description'];
		

		
		$user_input = '&username'.$username.'&title='.$title.'&desc='.$description;

		

        // $text = "Book title";
        // $location = "../Suggest-by-user.php";
        // $ms = "error";
		// is_empty($title, $text, $location, $ms, $user_input);

		// $text = "Book description";
        // $location = "../Suggest-by-user.php";
        // $ms = "error";
		// is_empty($description, $text, $location, $ms, $user_input);

		
                # Insert the data into database
                $sql  = "INSERT INTO sugg ( username,
											book_title,
                                            book_description
											)
                         VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
			    $res  = $stmt->execute([$username,$title, $description]);

			
		     if ($res) {
		     	# success message
		     	$sm = "The book successfully created!";
                
				 header("Location: ../Readbook.php");
	            exit;
		     }else{
		     	# Error message
		     	$em = "Unknown Error Occurred!";
				// header("Location: ../Readbook.php?error=$em");
	            exit;
		     }

		    
	    

		
	}else {
      header("Location: ../Readbook.php");
      exit;
	}

