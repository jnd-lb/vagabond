
<?php 
if (!function_exists('authenticateUser')){
function authenticateUser($email, $password, $conn){
    // Assuming you have a 'users' table with columns 'email', 'password', and 'name'
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            // Password is correct
            return $user;
        }
    }

    // Invalid credentials or user not found
    return null;
}
}

function getUserByEmail($email, $conn) {
    $query = "SELECT * FROM users WHERE email = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "s", $email);
    mysqli_stmt_execute($statement);
    
    $result = mysqli_stmt_get_result($statement);
    return mysqli_fetch_assoc($result);
}

function getUserById($userId, $conn) {
    $query = "SELECT * FROM users WHERE id = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "i", $userId);
    mysqli_stmt_execute($statement);
    
    $result = mysqli_stmt_get_result($statement);
    $user = mysqli_fetch_assoc($result);
    
    mysqli_stmt_close($statement);

    return $user;
}


function createUser($name, $email, $password,$address, $conn) {
    // Check if the email already exists
    $existingUser = getUserByEmail($email, $conn);

    if ($existingUser) {
        // Email already exists, handle the error
        return null;
    }

    // Hash the password (for a basic example; use password_hash in a real-world scenario)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $query = "INSERT INTO users (name, email, password, address) VALUES (?, ?, ?, ?)";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "ssss", $name, $email, $hashedPassword, $address);
    $success = mysqli_stmt_execute($statement);

    if ($success) {
        // User created successfully, retrieve the user from the database
        $newUserId = mysqli_insert_id($conn);
        $newUser = getUserById($newUserId, $conn);
        return $newUser;
    } else {
        // Handle the error (you might want to log it or display a user-friendly message)
        return null;
    }
}

function isLoggedIn($redirect=true) {
    // Start the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is logged in
    if (!isset($_SESSION['user'])) {
        if($redirect){
            // Redirect to the login page
            header("Location: /login.php");
            exit();
        }else{
            return false;
        }
    }

    return true;
}


function isAdmin($redirect = true) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user'])) {
        if ($redirect) {
            header("Location: ./login.php");
            exit();
        } else {
            return false;
        }
    }

    // Assuming $_SESSION['user']['is_admin'] stores admin status (1 or 0)
    if (isset($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1) {
        return true;
    } else {
        if ($redirect) {
            // Optional: redirect non-admin users somewhere else
            header("Location: ./no-access.php");
            exit();
        } else {
            return false;
        }
    }
}

?>