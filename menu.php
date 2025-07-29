<?php
// This MUST be the very first thing in the file
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Check if the add to cart button is clicked
if (isset($_POST["add_to_cart"])) {
    // Validate and sanitize input
    $product_id = filter_input(INPUT_POST, "product_id", FILTER_VALIDATE_INT);
    $product_quantity = filter_input(INPUT_POST, "product_quantity", FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 10]
    ]);

    // Validate inputs
    if ($product_id === false || $product_quantity === false) {
        $_SESSION['error'] = "Invalid product data";
        header("Location: menu.php");
        exit();
    }

    // Initialize cart if it doesn't exist
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    // Add/update the product in cart
    $_SESSION["cart"][$product_id] = $product_quantity;
    
    // Set success message
    $_SESSION['success'] = "Item added to cart!";
    header("Location: cart.php");
    exit();
}

// Now include your header after all session operations
include 'includes/header.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Brew Haven Coffee Shop</title>
        <link rel="stylesheet" href="css/styles.css">
        <style>
            :root {
                --primary: #6F4E37;
                --secondary: #C4A484;
                --light: #F5F5DC;
                --dark: #3E2723;
                --accent: #D2B48C;
            }
            
            body {
                font-family: 'Poppins', sans-serif;
                background-color: var(--light);
                color: var(--dark);
                margin: 0;
                padding: 0;
                line-height: 1.6;
            }
        
            
            h1 {
                margin: 0;
                font-size: 2rem;
            }
    
     
   
            main {
                padding: 2rem;
                max-width: 1200px;
                margin: 0 auto;
            }
            
            section h2 {
                text-align: center;
                color: var(--primary);
                font-size: 2rem;
                margin-bottom: 2rem;
                border-bottom: 2px solid var(--accent);
                padding-bottom: 0.5rem;
                display: inline-block;
                margin-left: 50%;
                transform: translateX(-50%);
            }
            
            .products-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }
            
            .product-card {
                background: white;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                transition: transform 0.3s, box-shadow 0.3s;
            }
            
            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            }
            
            .product-image {
                width: 100%;
                height: 200px;
                object-fit: cover;
            }
            
            .product-info {
                padding: 1.5rem;
            }
            
            .product-info h3 {
                margin-top: 0;
                color: var(--primary);
            }
            
            .product-info p {
                margin-bottom: 1rem;
            }
            
            .price {
                font-weight: bold;
                color: var(--dark);
                font-size: 1.2rem;
            }
            
            form {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            label {
                font-weight: 500;
            }
            
            input[type="number"] {
                padding: 0.5rem;
                border: 1px solid var(--accent);
                border-radius: 4px;
                width: 60px;
            }
            
            button {
                background-color: var(--primary);
                color: white;
                border: none;
                padding: 0.75rem;
                border-radius: 4px;
                cursor: pointer;
                font-weight: 500;
                transition: background-color 0.3s;
            }
            
            button:hover {
                background-color: var(--dark);
            }
            
         
            
            @media (max-width: 900px) {
                .products-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
            
            @media (max-width: 600px) {
                .products-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>Welcome <?php
            $user = $_SESSION["user"];
            echo $user["name"];
            ?> to Brew Haven Coffee Shop</h1>
        </header>
   
        <main>
            <section>
                <h2>Our Coffee Selection</h2>
                <div class="products-grid">
                    <!-- Product 1 -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/6a/89/b0/6a89b03acb7d3070a038be705eee4059.jpg" 
                             alt="Espresso" class="product-image">
                        <div class="product-info">
                            <h3>Classic Espresso</h3>
                            <p>A rich, concentrated coffee served in a small cup</p>
                            <p class="price">$3.50</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="1">
                                <label for="product1_quantity">Quantity:</label>
                                <input type="number" id="product1_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 2 -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/736x/d7/23/3a/d7233a04fd31b7c6e93a2f62fd454c78.jpg" 
                             alt="Cappuccino" class="product-image">
                        <div class="product-info">
                            <h3>Mocha Coffee</h3>
                            <p>Espresso with steamed milk and silky foam</p>
                            <p class="price">$4.50</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="2">
                                <label for="product2_quantity">Quantity:</label>
                                <input type="number" id="product2_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 3 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1534778101976-62847782c213" 
                             alt="Latte" class="product-image">
                        <div class="product-info">
                            <h3>Smooth Latte</h3>
                            <p>Espresso with a lot of steamed milk and light foam</p>
                            <p class="price">$4.75</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="3">
                                <label for="product3_quantity">Quantity:</label>
                                <input type="number" id="product3_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 4 -->
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1572442388796-11668a67e53d" 
                             alt="Cold Brew" class="product-image">
                        <div class="product-info">
                            <h3>Cold Brew</h3>
                            <p>Smooth, cold-extracted coffee served over ice</p>
                            <p class="price">$4.00</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="4">
                                <label for="product4_quantity">Quantity:</label>
                                <input type="number" id="product4_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 5 -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/f3/06/2e/f3062eed3e95c531b0604f2ebb892112.jpg" 
                             alt="Mocha" class="product-image">
                        <div class="product-info">
                            <h3>Chocolate Chip Muffin</h3>
                            <p>Choc Chip muffin chocolate and steamed milk</p>
                            <p class="price">$5.00</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="5">
                                <label for="product5_quantity">Quantity:</label>
                                <input type="number" id="product5_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 6 -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/736x/0e/c2/80/0ec2802439f04c81cc709bcdbbc56a86.jpg" 
                             alt="Americano" class="product-image">
                        <div class="product-info">
                            <h3>Oreo Schoko Cookies</h3>
                            <p>Oreo Schoko Cookies served with Milk / Hot Chocolate</p>
                            <p class="price">$3.75</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="6">
                                <label for="product6_quantity">Quantity:</label>
                                <input type="number" id="product6_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 7 -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/37/de/82/37de8268e09baba9fcab253c19070977.jpg" 
                             alt="Flat White" class="product-image">
                        <div class="product-info">
                            <h3>RooiBoss Tea Pot</h3>
                            <p>RooiBoss Tea Pot served with a muffin</p>
                            <p class="price">$10.00</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="7">
                                <label for="product7_quantity">Quantity:</label>
                                <input type="number" id="product7_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 8 -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/736x/0e/f6/0d/0ef60dd825a187ee65f0ffd6bda47164.jpg" 
                             alt="Macchiato" class="product-image">
                        <div class="product-info">
                            <h3>Macchiato</h3>
                            <p>Hot Chocolate with a  of milk condensed</p>
                            <p class="price">$3.75</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="8">
                                <label for="product8_quantity">Quantity:</label>
                                <input type="number" id="product8_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 9 -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/09/d2/ba/09d2ba1949cd949727eeeea2f0892545.jpg" 
                             alt="Iced Coffee" class="product-image">
                        <div class="product-info">
                            <h3>Iced Coffee</h3>
                            <p>Chilled coffee served over ice with milk options</p>
                            <p class="price">$4.25</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="9">
                                <label for="product9_quantity">Quantity:</label>
                                <input type="number" id="product9_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 10 -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/2c/26/0e/2c260ec2de65ff933fa6123e50e11912.jpg" 
                             alt="Affogato" class="product-image">
                        <div class="product-info">
                            <h3>Affogato</h3>
                            <p>Vanilla ice cream "drowned" with hot espresso</p>
                            <p class="price">$5.50</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="10">
                                <label for="product10_quantity">Quantity:</label>
                                <input type="number" id="product10_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 11 -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/1200x/6b/f2/45/6bf245ecf02aed6aa7610b68c0092e30.jpg" 
                             alt="Cortado" class="product-image">
                        <div class="product-info">
                            <h3>Cortado</h3>
                            <p>Espresso "cut" with an equal amount of warm milk</p>
                            <p class="price">$4.00</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="11">
                                <label for="product11_quantity">Quantity:</label>
                                <input type="number" id="product11_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product 12 -->
                    <div class="product-card">
                        <img src="https://i.pinimg.com/736x/e6/66/6f/e6666fa1d1f9c2b95957bc7f346e3059.jpg" 
                             alt="Pour Over" class="product-image">
                        <div class="product-info">
                            <h3>Pour Over</h3>
                            <p>Handcrafted single-origin coffee brewed to order</p>
                            <p class="price">$4.75</p>
                            <form method="post" action="shop.php">
                                <input type="hidden" name="product_id" value="12">
                                <label for="product12_quantity">Quantity:</label>
                                <input type="number" id="product12_quantity" 
                                       name="product_quantity" value="1" min="1" max="10">
                                <button type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include 'includes/footer.php' ?>
    </body>
</html>