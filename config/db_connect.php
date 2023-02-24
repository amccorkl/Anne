<?php 
  $conn = mysqli_connect('localhost', 'root', "test1234", 'pasta');

  // <!-- check connection -->
    if(!$conn){
      echo "Connection failed" . mysqli_connect_error();
    } 

?>