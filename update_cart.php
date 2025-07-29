<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = (int)$_POST['product_id'];
    $action = $_POST['action'];

    if ($action === 'reduce' && isset($_SESSION['cart'][$product_id])) {
        // Reduce quantity
        $_SESSION['cart'][$product_id]--;

        // If quantity is 0, remove the product from the cart
        if ($_SESSION['cart'][$product_id] <= 0) {
            unset($_SESSION['cart'][$product_id]);
        }
    }

    // Redirect back to the cart page
    header("Location: cart.php");
    exit();
}
?>