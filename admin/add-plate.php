<?php
include './admin-header.php';
include('../functions/authenticate.php');
isLoggedIn();
isAdmin();
include('../functions/db.php');
$conn = openDatabaseConnection();
include('../functions/plates-functions.php');  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $targetDir = "../images/food/";  
    $uploadedImage = uploadImage($targetDir);

    // Insert plate into database
    $success = addPlate($conn, $name, $description, $uploadedImage, $price);

    if ($success) {
        header("Location: ./menu.php");
        
    } else {
        echo '<div class="alert alert-danger" role="alert">Failed to add plate. Please try again.</div>';
    }
}

?>

<main class="row">
    <div class="col-md-3">
        <?php include './sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <div class="container">
            <h1 class="fw-bold display-4 mt-4 text-dark">Add Plate</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="fileToUpload" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Plate</button>
            </form>
        </div>
    </div>
</main>

<?php include './admin-footer.php'; ?>
