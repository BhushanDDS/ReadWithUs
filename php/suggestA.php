<?php  
session_start();



	# Database Connection File
	include "../db_conn.php";

    # Validation helper function
    include "func-validation.php";

    # File Upload helper function
    include "func-file-upload.php";



	if (isset($_POST['book_name'])       &&
	isset($_POST['book_author'])       &&
	isset($_POST['decs'])       &&
        isset($_POST['avl'])
     ) {
		
		$title       = $_POST['book_name'];
		$author       = $_POST['book_author'];
		$description       = $_POST['decs'];
		$avl = $_POST['avl'];
		

		
		$user_input = 'book_name='.$title.'&book_author='.$author.'&decc='.$description.'&avl='.$avl;

		

        $text = "Book title";
        $location = "../Suggest-by-user.php";
        $ms = "error";
		is_empty($title, $text, $location, $ms, $user_input);

		$text = "Book description";
        $location = "../Suggest-by-user.php";
        $ms = "error";
		is_empty($description, $text, $location, $ms, $user_input);

		
                # Insert the data into database
                $sql  = "INSERT INTO suggesta (book_name,
                                            book_author,
											decs,avl
											)
                         VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
			    $res  = $stmt->execute([$title,$author, $description,$avl]);

			
		     if ($res) {
		     	# success message
		     	$sm = "The book successfully created!";
                
				 header("Location: ../SuggestA.php");
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

