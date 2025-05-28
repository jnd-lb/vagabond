<?php
include './admin-header.php';
include('../functions/authenticate.php');
isLoggedIn();

isAdmin();
include('../functions/db.php');
$conn = openDatabaseConnection();
include('../functions/plates-functions.php');
include('../functions/categories-functions.php');

$id = $_GET['id'];
$plate = getPlateById($conn, $id);
$categories = getAllCategories($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    $image = $plate['image'];
    if ($_FILES['fileToUpload']['name']) {
        $targetDir = "../images/food/";
        $image = uploadImage($targetDir);
    }

    $success = updatePlate($conn, $id, $name, $description, $image, $price, $category_id);

    if ($success) {
        header("Location: ./menu.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">Failed to update plate.</div>';
    }
}
?>

<main class="row">
    <div class="col-md-3">
        <?php include './sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <div class="container">
            <h1 class="fw-bold display-4 mt-4 text-dark">Edit Plate</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="<?= $plate['name'] ?>" type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3" required><?= $plate['description'] ?></textarea>
                </div>
                <div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select name="category_id" class="form-control" required>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $plate['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input value="<?= $plate['price'] ?>" type="number" class="form-control" name="price" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <img src="../images/food/<?= $plate['image'] ?>" height="50"><br><br>
                    <label for="image" class="form-label">Change Image</label>
                    <input type="file" class="form-control" name="fileToUpload" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Update Plate</button>
            </form>
        </div>
    </div>
</main>

<?php include './admin-footer.php'; ?>
