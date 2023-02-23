<?php 

  $conn = mysqli_connect('localhost', 'root', "test1234", 'pasta');

  // //check connection
  // if(!$conn){
  //   echo "Connection failed" . mysqli_connect_error();
  // } else {
  //   echo 'connection successful';
  // }

  // query to access pasta
  $sql = 'SELECT title, ingredients, id FROM pasta ORDER BY created_at';

  //make query and get results
  $result = mysqli_query($conn, $sql);

  //fetch rows as an array format for template on DOM
  $pastas = mysqli_fetch_all($result, MYSQLI_ASSOC);

  //free result from memory
  mysqli_free_result($result);
  //close connection
  mysqli_close($conn);


  // print_r($pastas);
?>

<!DOCTYPE html>
<html lang="en">

  <?php include ('templates/header.php'); ?>

  <h4 class='center'>Pastas Available!</h4>
  <div class="pasta-container">
    <div class="row">
      <!-- output data to card -->
      <?php foreach($pastas as $pasta) {?>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <!-- no malicious code pushed back by using html... -->
              <h4><?php echo htmlspecialchars($pasta['title']) ?></h4>
              
              <ul>
                <!-- explode is like split, $ing is the ingredient index -->
                <?php foreach (explode(',', $pasta['ingredients']) as $ing) {?>
                  <li> <?php echo htmlspecialchars($ing); ?></li>
                <?php } ?>
              </ul>
            </div>
            <div class="card-btn"><a href="#">More Info</a></div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <?php include ('templates/footer.php'); ?>
  
  
</html>