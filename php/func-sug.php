<?php 
function get_all_sugg($con){
   $sql  = "SELECT * FROM sugg";
   $stmt = $con->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() > 0) {
   	  $sugg = $stmt->fetchAll();
   }else {
      $sugg = 0;
   }

   return $sugg;
}


?>