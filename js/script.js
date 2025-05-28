
function _displayCart() {

    var cart = JSON.parse(localStorage.getItem('cart')) || {};

    
    var cartContainer = document.getElementById('cart-container');

    // Clear existing content in the cart container
    cartContainer.innerHTML = '';

    // Iterate through the cart object and create HTML for each item
    Object.keys(cart).forEach(function (plateId) {
        var plateInfo = cart[plateId];

        // Create HTML for each item
        var itemHTML = `
            <div class="cart-item">
                <img src="./images/food/${plateInfo.image}" alt="${plateInfo.name}">
                <h3 class="fw-bold">${plateInfo.name}</h3>
                <p>Quantity: ${plateInfo.quantity}</p>
                <p>Unit Price: $${plateInfo.unitPrice}</p>
                <p>Total Price: $${plateInfo.quantity * plateInfo.unitPrice}</p>
            </div>
        `;

        // Append the item HTML to the cart container
        cartContainer.innerHTML += itemHTML;
    });
}
function showToast(message, duration = 3000) {

    const toast = document.getElementById("toast");
    toast.textContent = message;
    toast.className = "toast show";
    setTimeout(() => {
      toast.className = "toast";
    }, duration);
  }



function closeCart(){
    var cartPage = document.querySelector('.cart'); 
    cartPage.classList.remove('show-cart')
    var closeButton = document.querySelector('.cart-close')
    closeButton.classList.remove('show-cart-close')
}

function updateTotalPrice(cart) {
    let totalPrice = 0
    Object.keys(cart).forEach(function (plateId) {
      totalPrice+=cart[plateId].quantity*cart[plateId].unitPrice
    })  
    var totalPriceElement = document.querySelector('.total-js'); 
    totalPriceElement.innerHTML = "$"+totalPrice;
}


function deleteItemFromCart(id){

    let cart = JSON.parse(localStorage.getItem('cart'));
    // Check if the item with the given ID exists in the cart
    if (cart.hasOwnProperty(id)) {
        // Remove the item from the cart
        delete cart[id];

        // Update the local storage with the modified cart object
        localStorage.setItem('cart', JSON.stringify(cart));

        updateCartCount()
        updateTotalPrice(cart);
        displayCart()
        
        console.log(`Item with ID ${id} removed from the cart.`);
    } else {
        console.log(`Item with ID ${id} not found in the cart.`);
    }
}


function displayCart() {
    updateCartCount()
    var cartPage = document.querySelector('.cart'); 
    cartPage.classList.add('show-cart')
    var closeButton = document.querySelector('.cart-close')
    closeButton.classList.add('show-cart-close')
    
    var cart = JSON.parse(localStorage.getItem('cart')) || {};
    updateTotalPrice(cart)
    var template = document.querySelector('.cart-item-template'); // Use a class for the template
    var cartContainer = document.getElementById('cart-container');
    cartContainer.innerHTML = ""
    Object.keys(cart).forEach(function (plateId) {
        var plateInfo = cart[plateId];
            // Clone the template
            var clonedCartItem = template.cloneNode(true);
            clonedCartItem.classList.remove("d-none")
            // Update the cloned item with new values
            var imageElement = clonedCartItem.querySelector('img');
            var nameElement = clonedCartItem.querySelector('h3');
            var priceElement = clonedCartItem.querySelector('p');
            var quantityDisplayElement = clonedCartItem.querySelector('.display-quantity-js');
           
            quantityDisplayElement.textContent = `${plateInfo.quantity}`;
            quantityDisplayElement.classList.add(`display-quantity-${plateId}`)
            var addButton = clonedCartItem.querySelector('.add-item-js');
            var removeButton = clonedCartItem.querySelector('.remove-item-js')
            
            var deleteItemButton = clonedCartItem.querySelector('.delete-item-js')
            
            deleteItemButton.addEventListener('click', function () {
                deleteItemFromCart(plateId)
            });
            
            addButton.addEventListener('click', function () {
                quantityChange(plateId, 'add',plateInfo.unitPrice,plateInfo.name,plateInfo.image);
            });
            
            removeButton.addEventListener('click', function () {
                quantityChange(plateId, 'remove',plateInfo.unitPrice,plateInfo.name,plateInfo.image);
            });

            imageElement.src = `./images/food/${plateInfo.image}`;
            nameElement.textContent = plateInfo.name;
            priceElement.textContent = `${plateInfo.unitPrice}`;
            addButton.dataset.plateId = plateId;
            removeButton.dataset.plateId = plateId;
        
            // Append the cloned item to the container
            cartContainer.appendChild(clonedCartItem);
        
    });

    
}


function checkout() {
    var cart = JSON.parse(localStorage.getItem('cart')) || {};

    // Assuming you have a server-side URL to handle the checkout process (checkout.php)
    var checkoutUrl = 'checkout.php';

    $.ajax({
        type: 'POST',
        url: checkoutUrl,
        // contentType: 'application/json',
        data: {data:JSON.stringify(cart)},
        success: function (response) {
            // The server response is received, you can handle it here
            console.log('Checkout successful');
            
            // Clear the local storage after successful checkout
            localStorage.setItem('cart', JSON.stringify({}));
            displayCart()
            alert("Order has been placed");
        },
        error: function (xhr, status, error) {
            // Handle the error
            console.error('Error during checkout:', status, error);
        }
    });
}






function getTotalQuantityInCart() {
    var cart = JSON.parse(localStorage.getItem('cart')) || {};
    var totalQuantity = 0;

    Object.keys(cart).forEach(function (plateId) {
        totalQuantity += cart[plateId].quantity;
    });

    return totalQuantity;
}

if (!localStorage.getItem('cart')) {
    localStorage.setItem('cart', JSON.stringify({}));
}

function showQuantitySelector(plateId) {
    $(`.quantity-selector-${plateId}`).css('top', 0);
}

function closeQuantitySelector(plateId) {
    $(`.quantity-selector-${plateId}`).css('top', '100%');
}

function quantityChange(plateId, action,unitPrice,name,image) {
    var cart = JSON.parse(localStorage.getItem('cart')) || {};
    var quantity = cart[plateId] ? cart[plateId].quantity : 0;
    var unitPrice = cart[plateId] ? cart[plateId].unitPrice : unitPrice;
    var name = cart[plateId] ? cart[plateId].name : name;
    var image = cart[plateId] ? cart[plateId].image : image;

    if (action === 'add') {
        quantity++;
    } else if (action === 'remove') {
        if (quantity > 0) {
            quantity--;
        }
    }

    // Update cart with quantity and unitPrice
    cart[plateId] = { quantity: quantity, unitPrice: unitPrice, name:name, image:image };
    localStorage.setItem('cart', JSON.stringify(cart));

    // Update the display
    $(`.display-quantity-${plateId}`).text(quantity);
    
    // Update cart discounter
    $(`.cart-items-counter-js`).text(getTotalQuantityInCart());
    updateTotalPrice(cart)
}

function updateCartCount(){
    $(`.cart-items-counter-js`).text(getTotalQuantityInCart());
    }
    
    $(document).ready(function(){
    //update cart
    updateCartCount();
    $(window).scroll(function(){
        // sticky navbar on scroll script
        if(this.scrollY > 20){
            $('.navbar').addClass("sticky");
        }else{
            $('.navbar').removeClass("sticky");
        }
        
        // scroll-up button show/hide script
        if(this.scrollY > 500){
            $('.scroll-up-btn').addClass("show");
        }else{
            $('.scroll-up-btn').removeClass("show");
        }
    });

    // slide-up script
    $('.scroll-up-btn').click(function(){
        $('html').animate({scrollTop: 0});
        // removing smooth scroll on slide-up button click
        $('html').css("scrollBehavior", "auto");
    });

    $('.navbar .menu li a').click(function(){
        // applying again smooth scroll on menu items click
        $('html').css("scrollBehavior", "smooth");
    });

    // toggle menu/navbar script
    $('.menu-btn').click(function(){
        $('.navbar .menu').toggleClass("active");
        $('.menu-btn i').toggleClass("active");
    });

    // typing text animation script
    if($(".typing").length > 0){
    
        var typed = new Typed(".typing", {
            strings: ["Traditional.", "Authentic.", "Fresh.", "Sushi."],
            typeSpeed: 100,
            backSpeed: 60,
            loop: true
        });
    }

    // owl carousel script
    $('.carousel').owlCarousel({
        margin: 20,
        loop: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: false
            }
            }
        });



        //Hero

        var images = $(".hero-image");
        var currentIndex = 0;

        function showImage(index) {
            images.fadeOut();
            images.eq(index).fadeIn();
        }

        // Call the showImage function initially
        showImage(currentIndex);

        // Set an interval to switch images every 3000 milliseconds (3 seconds)
        setInterval(function () {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }, 3000);
        

       

          // Menu
    // Fetch cart data from localStorage
    var cart = JSON.parse(localStorage.getItem('cart')) || {};

    // Update quantity display for each plate
    Object.keys(cart).forEach(function (plateId) {
        var quantity = cart[plateId].quantity;
        $(`.display-quantity-${plateId}`).text(quantity);
    });

    $(".show-quantity-selector-js").on("click", function () {
        var plateId = $(this).data('plate-id');
        showQuantitySelector(plateId);
    });

    $(".hide-quantity-selector-js").on("click", function () {
        var plateId = $(this).data('plate-id');
        closeQuantitySelector(plateId);
    });

    $(".add-item-js").on("click", function () {
      
        var plateId = $(this).data('plate-id');
        var unitPrice = parseFloat($(this).closest('.d-flex').data('price'));
        var name = $(this).closest('.d-flex').data('name');
        var image = $(this).closest('.d-flex').data('image');
        quantityChange(plateId, 'add',unitPrice,name,image);
        showToast("Plate updated successfully!");

    });

    $(".remove-item-js").on("click", function () {
        var plateId = $(this).data('plate-id');
        
        var unitPrice = parseFloat($(this).closest('.d-flex').data('price'));
        var name = $(this).closest('.d-flex').data('name');
        var image = $(this).closest('.d-flex').data('image');
        quantityChange(plateId, 'remove',unitPrice,name,image);
    });

    $(".cart-js").on("click", function () {
        displayCart()
    })

    $(".cart-close").on("click", function () {
        closeCart()
    })


    $(".checkout-js").on("click", function () {
        checkout()
    })
   
    
    });    



