<?php 

//create variables for input values
//set form fields as empty on loading
$email = $title = $ingredients = '';
$errors = array('email' => '', 'title' => '', 'ingredients' => '');

	if(isset($_POST['submit'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			//if the email doesn't validate, the typed info is returned to be fixed
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

		// check title, (originally had name of pasta but title allows us more leeway for info)
		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

		// check ingredients
		if(empty($_POST['ingredients'])){
			$errors['ingredients'] = 'At least one ingredient is required';
		} else{
			$ingredients = $_POST['ingredients'];
			// the \s is a space in the regex
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list';
			}
		}

    if(array_filter($errors)){
      //returns true there is an error
      echo 'error(s) in the form';
    } else {
      // form is valid, redirecting to the index page
			header('Location: index.php');
    }

	} // end POST check


?>

<!DOCTYPE html>
<html lang="en">

  <?php include ('templates/header.php'); ?>
  
  <section class="container gray">
    <h4 class="red">Add pasta</h4>
		<!-- method of POST matches php work above -->
    <form action="addPasta.php" class="white" method="POST">
      <label for="email">Email </label>
      <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
      <div class="pink"><?php echo $errors['email']; ?></div>
      <br>
      <label for="title">Pasta Type</label>
      <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
      <div class="pink"><?php echo $errors['email']; ?></div>
      <br>
      <label for="ingredients">Ingredients (comma separated)</label>
      <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
      <div class="pink"><?php echo $errors['email']; ?></div>
      <br>
      <div class="center">
        <input type="submit" name="submit" value="submit" class="btn">
      </div>
    </form>
  </section>

  
  <?php include ('templates/footer.php'); ?>
</html>