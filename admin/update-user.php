<?php
include './admin-header.php';
include('../functions/authenticate.php');
isLoggedIn();
isAdmin(); // Make sure only admins can access
include('../functions/db.php');
$conn = openDatabaseConnection();

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ./users.php");
    exit();
}

// Get user data
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo '<div class="alert alert-danger">User not found.</div>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $address  = $_POST['address'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $hashedPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : $user['password'];

    $update = "UPDATE users SET 
        name = '$name',
        email = '$email',
        password = '$hashedPassword',
        address = '$address',
        is_admin = $is_admin
        WHERE id = $id";
    
    if (mysqli_query($conn, $update)) {
        header("Location: ./users.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">Failed to update user.</div>';
    }
}
?>

<main class="row">
    <div class="col-md-3">
        <?php include './sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <div class="container">

                <h1 class="fw-bold display-4 mt-4 text-dark">Edit User</h1>
            
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input name="email" class="form-control" type="email" value="<?= htmlspecialchars($user['email']) ?>" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password (leave blank to keep current)</label>
                            <input name="password" class="form-control" type="password" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input name="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>" />
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_admin" value="1" <?= $user['is_admin'] ? 'checked' : '' ?> />
                            <label class="form-check-label">Is Admin</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
        </div>
    </div>
</main>

<?php include './admin-footer.php'; ?>
