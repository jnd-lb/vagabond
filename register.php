<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Form is submitted
    include('./functions/authenticate.php');
    require_once('./functions/db.php');
    
    $conn = openDatabaseConnection();

    
    // Validate and sanitize the input data
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $password2 = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;

    
    // Perform additional validation as needed
    if(!$name || !$password || !$email || !$address){
      $errors =  "Please fill all the required fields";
    }else{
      // Check if passwords match
      if ($password !== $password2) {
        $errors =  "Passwords do not match.";
        // You might want to redirect back to the registration form or handle the error appropriately
      } else {
        // Passwords match, and other validations can be added
        $result = createUser($name, $email, $password,$address, $conn);
        if(!$result){
          $errors = "Email already exit";
        }else{
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            // Store user data in session

            // Store user data in session
            $_SESSION['user'] = [
              'user_id' => $result['id'],
              'name' => $name,
              'email' => $email,
            ];

            
            // Redirect to a success page or do further processing
            header("Location: ./index.php");
            exit();
        }
      }
    }
}
?>
<?php include './includes/header.php'; ?>

<section class="container">

<?php echo (isset($errors)) ? "<p class='text-danger'>$errors</p>" : "" ?>


<h1 class=" fw-bold text-danger">Register</h1>
<form action="./register.php" method="post">

<div class="mb-3">
  <label for="name" class="form-label">Name</label>
  <input name="name" type="text" class="form-control" id="name" >
</div>

<div class="mb-3">
  <label for="exampleInputEmail1" class="form-label">Email address</label>
  <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
</div>

<div class="mb-3">
  <label for="exampleInputPassword1" class="form-label">Password</label>
  <input name="password" type="password" class="form-control" id="exampleInputPassword1">
</div>

<div class="mb-3">
  <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
  <input name="confirm-password" type="password" class="form-control" id="exampleInputPassword2">
</div>

<div class="mb-3">
  <label for="address" class="form-label">Address</label>
  <input name="address" type="text" class="form-control" id="address" >
</div>

<button type="submit" class="btn btn-danger">Submit</button>

</form>
    <a class="mt-4 d-block " href="./login.php">You have an account? Login</a>
</section>

<?php include './includes/footer.php'; ?>
