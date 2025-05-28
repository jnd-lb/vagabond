<div id="toast" class="toast">Items has been added</div>

<section class="menu1" id="menu">
    <div class="container">
        <div class="d-flex  align-items-center justify-content-between">
            <h2 class=" display-5 text-dark fw-bold ">Our Menu</h2>
<!--add link to all plates-->
            <a class="fs-5 text-danger" href="./menu.php">See All Plates</a>
        </div>
        <p class="text-muted">メニュー</p>
    </div>
    
    <div class="carousel owl-carousel">


    <?php foreach ($plates as $plate): ?>
   
        <div class="menu-card position-relative">
            <img class="menu-image" src="./images/food/<?php echo $plate['image']; ?>" alt="Onigiri">
            <h3 class="fw-bold mt-3">
                <?php echo $plate['name']; ?>
            </h3>
            <p><?php echo $plate['description']; ?></p>
            <p class="text-warning">Price: $<?php echo $plate['price']; ?></p>
                <button  data-plate-id='<?php echo $plate['id']; ?>' class="btn btn-danger flex align-items-center gap-2 show-quantity-selector-js"><i data-lucide="plus" class="icon"></i>Add to cart</button>
                <div class="item-quantity-selector quantity-selector-<?php echo $plate['id']; ?>" >
                    <span class="fs-5">Specify Quantity</span>
                    
                    <div class="d-flex w-50 mt-2" data-name="<?php echo $plate['name']; ?>" data-image="<?php echo $plate['image']; ?>" data-price="<?php echo $plate['price']; ?>">
                        <button class="btn btn-danger add-item-js" data-plate-id='<?php echo $plate['id']; ?>'  ><i data-lucide="plus" class="icon"></i></button>
                        <span class="flex-grow-1 d-flex align-items-center  justify-content-center display-quantity-<?php echo  $plate['id']; ?>">0</span>
                        <button class="btn btn-danger remove-item-js"  data-plate-id='<?php echo $plate['id']; ?>'><i data-lucide="minus" class="icon"></i></button>
                    </div>
                    <button class="btn btn-success w-50 mt-3 hide-quantity-selector-js" data-plate-id='<?php echo $plate['id']; ?>'>Done</button>
                </div>
            </div>
<?php endforeach; ?>

    </div>
    </section>