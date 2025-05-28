<?php  require_once("./functions/authenticate.php"); ?>
<div class="cart">
    <h2 class="p-3">Cart</h2>
    
    <button class="cart-close">
       <i data-lucide="x"></i>
    </button>
    <!--item template-->
    <div class="d-none  cart-item px-3 mb-2 cart-item-template">
        <div class="d-flex gap-3">
            <img src="./images/food/onigiri.jpg"/>
            <div class="d-flex flex-column justify-content-center w-100">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h3 class="fs-4">Food</h3>
                    <button class=" btn btn-danger delete-item-from-cart delete-item-js "><i data-lucide="x"></i></button>
                </div>
                <p class="price">$10</p>
                <div class="d-flex w-50 mt-2" >
                    <button class="btn btn-danger add-item-js"   data-plate-id='1' ><i data-lucide="plus" class="icon"></i></button>
                    <span class="px-2 flex-grow-1 d-flex align-items-center  justify-content-center display-quantity-js">0</span>
                    <button class="btn btn-danger remove-item-js"  data-plate-id='1'><i data-lucide="minus" class="icon"></i></button>
                    
                </div>
            </div>
        </div>
    </div>
        <div class=" " id="cart-container">
            
        </div>
        
        <div class="px-3 d-flex align-items-center gap-3 mt-5 ">
            <h4 class="m-0">Total:</h4>
            <span class="total-js"></span>
        </div>
        <?php 
            if(!isLoggedIn(false)){
        ?>
            <a class="mt-2 ms-3 px-3 btn btn-danger" href="./login.php">Checkout</a>
        <?php
            }else{
        ?>   
            <button class="mt-2 ms-3 px-3 btn btn-danger checkout-js" >Checkout</button>
        <?php
            }
        ?>    
</div>
