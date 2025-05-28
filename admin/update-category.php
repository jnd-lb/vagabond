<?php
include './admin-header.php';
include('../functions/authenticate.php');
isLoggedIn();

isAdmin();
include('../functions/db.php');
$conn = openDatabaseConnection();
include('../functions/categories-functions.php');

$id = $_GET['id'];
$category = getCategoryById($conn, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $success = updateCategory($conn, $id, $name, $description);

    if ($success) {
        header("Location: ./categories.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">Failed to update category. Please try again.</div>';
    }
}
?>

<main class="row">
    <div class="col-md-3">
        <?php include './sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <div class="container">
            <h1 class="fw-bold display-4 mt-4 text-dark">Edit Category</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="<?php echo $category['name']; ?>" type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $category['description']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
        </div>
    </div>
</main>

<?php include './admin-footer.php'; ?>
