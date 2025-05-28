<?php
include('./functions/authenticate.php');
require_once('./functions/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form is submitted

    $conn = openDatabaseConnection();

    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if (!$email || !$password) {
        $errors = "Please provide both email and password.";
    } else {
        // Authenticate user
        $user = authenticateUser($email, $password, $conn);

        if ($user) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            // Store user data in session
            $_SESSION['user'] = [
                'user_id'=> $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'is_admin' => $user['is_admin'],
            ];

            
            // Redirect to user dashboard
            header("Location: ./index.php");
            exit();
        } else {
            $errors = "Invalid email or password.";
        }
    }
}
?>

<?php include './includes/header.php'; ?>

<section class="container">
<?php echo (isset($errors)) ? "<p class='text-danger'>$errors</p>" : "" ?>


<h1 class=" fw-bold text-danger">Login</h1>


        <form action="" method="post">
            <div class="">
                <label for="inputEmail4" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="inputEmail4">
            </div>
        <div class="">
            <label for="inputPassword4" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="inputPassword4">
        </div>
      
        <div class="col-12 mt-4 ">
            <button type="submit" class="btn btn-danger">Sign in</button>
        </div>
        <a class="mt-4 d-block " href="./register.php">Don't have an account? Create a new one</a>

        </form>
</section>

<?php include './includes/footer.php'; ?>
