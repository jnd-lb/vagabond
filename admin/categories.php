<?php
include './admin-header.php';
include('../functions/authenticate.php');
isLoggedIn();
isAdmin();
include('../functions/db.php');
$conn = openDatabaseConnection();
include('../functions/categories-functions.php');  

$categories = getAllCategories($conn); 
?>

<main class="row dashboard">
    <div class="col-md-3">
        <?php include './sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <div class="container">
            <h1 class="fw-bold display-4 mt-4 text-dark">Categories</h1>
            <div class="mt-5 dashboard-table-container">
                <table class=" table table-striped table-hover">
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Action</td>
                    </tr>

                    <?php foreach ($categories as $cat): ?>
                        <tr class="cursor-pointer" id="category-<?php echo $cat['id']?>">
                            <td><?php echo $cat['id']; ?></td>
                            <td><?php echo $cat['name']; ?></td>
                            <td><?php echo $cat['description']; ?></td>
                            <td>
                                <button class='btn btn-danger delete-js' data-id='<?php echo $cat['id']?>' data-page='category'>
                                    <i data-lucide="x"></i>
                                </button>
                                <a href="./update-category.php?id=<?php echo $cat['id']?>" class="btn btn-primary">
                                    <i data-lucide="edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <a href="./add-category.php" class="dashboard-add-btn"><i data-lucide="plus"></i></a>
</main>
<?php include './admin-footer.php'; ?>
