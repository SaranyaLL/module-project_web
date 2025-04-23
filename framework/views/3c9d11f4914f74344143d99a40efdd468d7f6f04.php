<!doctype html>
<html lang="en">
<head>
    <?php echo $__env->make('user.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        /* CSS for the Hero Image alignment */
        .hero-img-wrap {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .hero-image {
            width: 100%;
            max-height: 350px;
            object-fit: cover;
        }

        /* Optional styling to adjust spacing and alignment */
        .product-item {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            position: relative; /* For positioning the button */
        }

        .product-thumbnail {
            max-height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        /* Hide the button and input field by default */
        .add-to-cart-wrap {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: none; /* Hidden by default */
        }

        /* Input box for quantity */
        .product-quantity {
            width: 60px;
            padding: 5px;
            margin-bottom: 5px;
            text-align: center;
        }

        /* Show the input and button on hover */
        .product-item:hover .add-to-cart-wrap {
            display: block;
        }

        /* Style the "Add to Cart" button */
        .add-to-cart {
            background-color: orange;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }

        .cart-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8); /* Dark background with transparency */
    overflow-y: auto;
}


        .modal-content {
    background-color: #fff;
    margin-top:100px;
    /* Remove the margin */
    padding: 20px;
    width: 100vw; /* Full viewport width */
    height: 100vh; /* Full viewport height */
    position: fixed; /* Fixed positioning to cover the entire page */
    top: 0;
    left: 0;
    border-radius: 0; /* Optional: remove rounded corners */
    overflow: auto; /* Allows scrolling if the content exceeds the screen height */
    padding-bottom: 150px;
}


        .close-button {
            position: absolute;
            top:10px;
            right: 30px;
            cursor: pointer;
            font-size: 20px;
        }

       /* Cart Item Styling */
    .cart-list .cart-item {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding: 15px 0;
    }

  /* Cart Items Styling */
.cart-list {
    display: flex;
    gap: 5%;
    padding-top: 20px;
}
.cart-item {
    width: calc(33.333% - 10px); /* Three items per row */
    box-sizing: border-box;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}
.cart-item img {
    max-width: 100px;
    max-height: 100px;
    object-fit: cover;
    margin-bottom: 10px;
}
    .cart-list .cart-item img {
        max-width: 60px; /* Adjusted image size */
        height: 60px; /* Adjusted image height */
        margin-right: 15px;
        object-fit: cover;
    }

    .cart-item-info {
        flex: 1;
    }

    .cart-item-info h5 {
        margin: 0;
        font-size: 18px;
    }

    .cart-item-info p {
        margin: 5px 0;
        color: #555;
    }

    .cart-item-info .cart-item-price {
        font-weight: bold;
        color: #000;
    }

    .cart-item-info .cart-item-quantity {
        font-size: 14px;
        color: #777;
    }

    .cart-item-remove {
        color: red;
        cursor: pointer;
    }

    .cart-item-remove:hover {
        text-decoration: underline;
    }

        /* Cart Icon Styles */
        .cart-icon {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 8px;
            font-size: 14px;
        }
        .PayNow-cart {
            
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            margin-top: 5px;
            cursor: pointer;
            z-index:1001;
            width:200px;

        }

        /* Optional: Adjust grid styles for small screens */
@media  screen and (max-width: 768px) {
    .cart-list {
        grid-template-columns: repeat(2, 1fr); /* 2 items per row on smaller screens */
    }
}

@media  screen and (max-width: 480px) {
    .cart-list {
        grid-template-columns: 1fr; /* 1 item per row on very small screens */
    }
}
    </style>
</head>

<body>

    <!-- Header/Navigation -->
    <nav class="custom-navbar sticky-top navbar navbar-expand-md navbar-dark" style="height:80px;" aria-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand">
                <img src="images/furniture_logo-removebg-preview.png" width="100px" height="100px" alt="logo" style="height: 60px;">
                Wood Furniture<span></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item active"><a class="nav-link" href="/">Home</a></li>
                    <li><a class="nav-link" href="shop.html">Category</a></li>
                    <li><a class="nav-link" href="services.html">Booking Orders</a></li>
                    <li><a class="nav-link" href="blog.html">Profile</a></li> 
                    
                    <?php if(Auth::check()): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           LOGOUT (<?php echo e(Auth::user()->name); ?>)
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li>
                        <a class="nav-link cart-icon" href="javascript:void(0);" onclick="document.getElementById('cartModal').style.display='block'">
                            <img src="images/cart.svg">
                            <span id="cartCount" class="cart-count" style="display: none;">0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header/Navigation -->

    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>HandMade <span class="d-block">Wood Product</span></h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="images/couch.png" class="img-fluid hero-image" alt="Couch">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">
                <!-- Left side (Categories) -->
                <div class="col-3">
                    <h2 class="mb-4 section-title">Wood Categories</h2>
                    <ul id="categoryList"></ul>
                </div>
                <!-- Right side (Products) -->
                <div class="col-9">
                    <div class="row" id="productList">
                        <!-- Products will be loaded here dynamically -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Cart Modal -->
<div id="cartModal" class="cart-modal">
    <div class="modal-content">
        <span class="close-button" onclick="document.getElementById('cartModal').style.display='none'">&times;</span>
        <h2>Your Cart</h2>
        <div id="cartList" style="display:flex; gap:5%">
            <!-- Cart items will be dynamically added here -->
        </div>
        <div id="cartTotal" style="text-align: right; font-weight: bold; font-size: 18px; margin-top: 20px;">
            Total: ₹<span id="totalAmount">0.00</span>
        </div>
        <!-- Submit button moved under total amount in the bottom right -->
        <button class="btn PayNow-cart" style="margin-left:auto;">Pay Now</button>
    </div>
</div>

    <!-- Footer -->
    <?php echo $__env->make('user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Footer -->

    <script src="home/js/bootstrap.bundle.min.js"></script>
    <script src="home/js/tiny-slider.js"></script>
    <script src="home/js/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            let cart = [];
            let cartCount = 0;

            // Load Categories on page load
            $.ajax({
                url: '/usercategory',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#categoryList').empty();
                        $('#categoryList').append('<li class="category-item" style="cursor: pointer;" data-category-name="all">All</li>');
                        $.each(response.data, function(index, category) {
                            $('#categoryList').append(`
                                <li class="category-item" style="cursor: pointer;" data-category-name="${category.category_name}">
                                    ${category.category_name}
                                </li>
                            `);
                        });

                        $('.category-item').on('click', function() {
                            const categoryName = $(this).data('category-name');
                            loadProductsByCategory(categoryName);
                        });

                        loadProductsByCategory('all');
                    } else {
                        alert('Failed to retrieve categories.');
                    }
                },
                error: function() {
                    alert('An error occurred while fetching categories.');
                }
            });

            function loadProductsByCategory(categoryName) {
                $.ajax({
                    url: '/userproduct/' + categoryName,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#productList').empty();
                        if (response.success) {
                            $.each(response.products, function(index, product) {
                                $('#productList').append(`
                                    <div class="col-md-4 product-item">
                                        <img src="product/${product.image || 'default-image.jpg'}" class="img-fluid product-thumbnail" alt="${product.title || 'Product'}">
                                        <h5>${product.title}</h5>
                                        <p>${product.description || 'No description available'}</p>
                                        <p>${product.price}</p>
                                        <div class="add-to-cart-wrap">
                                            <input type="number" class="product-quantity" value="1" min="1">
                                            <button class="btn add-to-cart" data-id="${product.id}" data-title="${product.title}" data-price="${product.price}" data-image="${product.image}">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                `);
                            });
                        } else {
                            $('#productList').html('<p>No products found for this category.</p>');
                        }
                    },
                    error: function() {
                        $('#productList').html('<p>There was an error retrieving the products.</p>');
                    }
                });
            }

            function addToCart(product, quantity) {
                const itemIndex = cart.findIndex(item => item.id === product.id);
                if (itemIndex !== -1) {
                    cart[itemIndex].quantity += quantity;
                } else {
                    cart.push({...product, quantity});
                }
                cartCount += quantity;
                updateCartView();
                updateCartIcon();
                updateTotalAmount(); // Update the total amount
            }

            function updateCartView() {
    $('#cartList').empty();
    $.each(cart, function(index, item) {
        $('#cartList').append(`
            <div class="cart-item">
                <img src="product/${item.image || 'default-image.jpg'}" alt="${item.title}" class="cart-item-image">
                <div>
                    <h5>${item.title}</h5>
                    <p>${item.description || 'No description available'}</p>
                    <p class="cart-item-price">₹${item.price} x ${item.quantity}</p>
                    <span class="cart-item-remove" data-id="${item.id}">Remove</span>
                </div>
            </div>
        `);
    });

    $('.cart-item-remove').on('click', function() {
        const productId = $(this).data('id');
        removeItemFromCart(productId);
    });

    updateTotalAmount();
}


            function updateCartIcon() {
                if (cartCount > 0) {
                    $('#cartCount').text(cartCount).show();
                } else {
                    $('#cartCount').hide();
                }
            }

            function updateTotalAmount() {
                let total = 0;
                cart.forEach(item => {
                    total += item.price * item.quantity;
                });
                $('#totalAmount').text(total.toFixed(2)); // Display the total amount with two decimal places
            }

            $(document).on('click', '.add-to-cart', function() {
                const product = {
                    id: $(this).data('id'),
                    title: $(this).data('title'),
                    price: $(this).data('price'),
                    image: $(this).data('image'),
                    description: $(this).closest('.product-item').find('p').first().text() // Capture description
                };
                const quantity = parseInt($(this).siblings('.product-quantity').val());
                addToCart(product, quantity);
            });

            function removeItemFromCart(productId) {
                cart = cart.filter(item => item.id !== productId);
                cartCount = cart.reduce((total, item) => total + item.quantity, 0);
                updateCartView();
                updateCartIcon();
                updateTotalAmount(); // Update the total amount after removing an item
            }
              



            $(document).ready(function () {
    // Serialize cart data into JSON string and store it in the hidden field
    function getCartData() {
        let cartData = cart.map(item => ({
            product_id: item.id,
            quantity: item.quantity
        }));
        return JSON.stringify(cartData);
    }

    // Update the hidden input with serialized cart data
    $('#cartForm').submit(function (e) {
        e.preventDefault();
        $('#cartData').val(getCartData());

        // Submit the form with the cart data
        this.submit();  // You can also use AJAX here to avoid page reload
    });
});

        });

        
    </script>
 

    
</body>
</html><?php /**PATH C:\laravel\wood furniture\wood\resources\views\user\userhome.blade.php ENDPATH**/ ?>