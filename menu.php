<?php

include('./includes/header.php');
include('./functions/db.php');
include('./functions/plates-functions.php');
include('./functions/categories-functions.php');

$conn = openDatabaseConnection();

// Get all categories
$categories = getAllCategories($conn);

// Get selected category
$selectedCategory = $_GET['category'] ?? null;

// Get plates
$plates = $selectedCategory
    ? getPlatesByCategory($conn, $selectedCategory)
    : getAllPlates($conn);
?>
<div id="toast" class="toast">Items has been added</div>

<main class="container py-5">
    <h1 class="fw-bold display-5 text-dark">Our Menu</h1>
    <p class="text-muted mb-4">メニュー</p>

    <!-- Category Filter -->
    <form method="GET" class="mb-4">
        <select name="category" onchange="this.form.submit()" class="form-select w-25 d-inline-block me-2">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $selectedCategory == $cat['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($plates as $plate): ?>
            <div class="col">
                <div class="card position-relative overflow-hidden h-100">
                    <img src="./images/food/<?= $plate['image'] ?>" class="menu-page-plate-image card-img-top" alt="<?= $plate['name'] ?>">
                    <div class="card-body ">
                        <h5 class="card-title text-dark"><?= $plate['name'] ?></h5>
                        <p class="card-text text-muted "><?= $plate['description'] ?></p>
                        <p class="text-warning fw-bold">$<?= $plate['price'] ?></p>
                        <button  data-plate-id='<?php echo $plate['id']; ?>' class="btn btn-danger flex align-items-center gap-2 show-quantity-selector-js"><i data-lucide="plus" class="icon"></i>Add to cart</button>
                <div class="item-quantity-selector quantity-selector-<?php echo $plate['id']; ?>" >
                    <span class="fs-5">Specify Quantity</span>
                    
                    <div class="d-flex w-50 mt-2 z-3" data-name="<?php echo $plate['name']; ?>" data-image="<?php echo $plate['image']; ?>" data-price="<?php echo $plate['price']; ?>">
                        <button class="btn btn-danger add-item-js" data-plate-id='<?php echo $plate['id']; ?>'  ><i data-lucide="plus" class="icon"></i></button>
                        <span class="flex-grow-1 d-flex align-items-center  justify-content-center display-quantity-<?php echo  $plate['id']; ?>">0</span>
                        <button class="btn btn-danger remove-item-js"  data-plate-id='<?php echo $plate['id']; ?>'><i data-lucide="minus" class="icon"></i></button>
                    </div>
                    <button class="btn btn-success w-50 mt-3 hide-quantity-selector-js" data-plate-id='<?php echo $plate['id']; ?>'>Done</button>
                </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    </main>

    <?php include './includes/footer.php'; ?>
    
