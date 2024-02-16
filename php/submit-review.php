<?php  
session_start();



	# Database Connection File
	include "../db_conn.php";

    # Validation helper function
    include "func-validation.php";

    # File Upload helper function
    include "func-file-upload.php";



	if (isset($_POST['book_id'])      
     ) {
		
        $bookId=$_POST['book_id'];
        $name=$_POST['name'];
		$rating       = $_POST['rating'];
		$comment = $_POST['comment'];
		

		
		$user_input = 'book_id='.$bookId.'&name='.$name.'$rating'.$rating.'$comment'.$comment;

		

        // $text = "Book title";
        // $location = "../Suggest-by-user.php";
        // $ms = "error";
		// is_empty($title, $text, $location, $ms, $user_input);

		// $text = "Book description";
        // $location = "../Suggest-by-user.php";
        // $ms = "error";
		// is_empty($description, $text, $location, $ms, $user_input);

		
                # Insert the data into database
                $sql  = "INSERT INTO reviews (book_id,
                                                name,
                                                rating,
                                                comment
                                            
											)
                         VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
			    $res  = $stmt->execute([$bookId,$name,$rating,$comment]);

			
		     if ($res) {
		     	# success message
		     	$sm = "The book successfully created!";
                
				 header("Location: ../index.php");
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

