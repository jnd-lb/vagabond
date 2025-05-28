<?php
include './admin-header.php';
include('../functions/authenticate.php');
isLoggedIn();
isAdmin();

include('../functions/db.php');
$conn = openDatabaseConnection();
include('../functions/plates-functions.php');  

$plates = getAllPlates($conn); 
?>

<main class="row dashboard">
    <div class="col-md-3">
        <?php include './sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <div class="container">
            <h1 class="fw-bold display-4 mt-4 text-dark">Plates</h1>
            <div class="mt-5 dashboard-table-container">
                <!-- <table class=" table table-striped table-hover" >
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Category</td>
                        <td>Image</td>
                        <td>Price</td>
                        <td>Action</td>
                    </tr>

                    <?php foreach ($plates as $plate): ?>
                        <tr class="cursor-pointer" id="plate-<?php echo $plate['id']?>">
                            <td><?php echo $plate['id']; ?></td>
                            <td><?php echo $plate['name']; ?></td>
                            <td><?php echo $plate['description']; ?></td>
                            <td><?php echo $plate['category_name']; ?></td>
                            <td><img class="menu-plates" src="../images/food/<?php echo $plate['image']; ?>" alt="Plate Image" height="50"></td>
                            <td><?php echo $plate['price']; ?></td>
                            <td>
                                <button class='btn btn-danger delete-js' data-id='<?php echo $plate['id']?>' data-page='plate'>
                                    <i data-lucide="x"></i>
                                </button>
                                <a href="./update-plate.php?id=<?php echo $plate['id']?>" class="btn btn-primary">
                                    <i data-lucide="edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table> -->

                <table class="table table-striped table-hover sortable">
    <thead>
        <tr class="text-nowrap">
            <th>Id <i  class="sort-icon" data-lucide="arrow-up-down"></i></th>
            <th>Name <i  class="sort-icon" data-lucide="arrow-up-down"></i></th>
            <th>Description  <i  class="sort-icon" data-lucide="arrow-up-down"></i></th>
            <th>Category  <i  class="sort-icon" data-lucide="arrow-up-down"></i></th>
            <th>Image</th>
            <th>Price  <i  class="sort-icon" data-lucide="arrow-up-down"></i></th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($plates as $plate): ?>
        <tr id="plate-<?php echo $plate['id']?>">
            <td><?php echo $plate['id']; ?></td>
            <td><?php echo $plate['name']; ?></td>
            <td><?php echo $plate['description']; ?></td>
            <td><?php echo $plate['category_name']; ?></td>
            <td><img class="menu-plates" src="../images/food/<?php echo $plate['image']; ?>" alt="Plate Image" height="50"></td>
            <td><?php echo $plate['price']; ?></td>
            <td>
                <button class='btn btn-danger delete-js' data-id='<?php echo $plate['id']?>' data-page='plate'>
                    <i data-lucide="x"></i>
                </button>
                <a href="./update-plate.php?id=<?php echo $plate['id']?>" class="btn btn-primary">
                    <i data-lucide="edit"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

            </div>
        </div>
    </div>
    <a href="./add-plate.php" class="dashboard-add-btn"><i data-lucide="plus"></i></a>

</main>
<?php include './admin-footer.php'; ?>
