<?php
include('config.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentUserId = $_SESSION['id'];
    $id = $_POST['Id'];

    // Check if the user owns the product
    $checkIfExists = "SELECT * FROM product_ownership WHERE product_id='$id' AND user_id='$currentUserId'";
    $result = mysqli_query($con, $checkIfExists);

    if(mysqli_num_rows($result) >= 1) {
        // User owns the product, so proceed
        $quantityResult = mysqli_query($con, "SELECT quantity FROM products WHERE id='$id'");
        
        if ($quantityResult) {
            $row = mysqli_fetch_assoc($quantityResult);
            $quantity = $row['quantity'] + 1;
            
            // Update the quantity of the product
            $updateQuantityQuery = "UPDATE products SET quantity='$quantity' WHERE id='$id'";
            if (mysqli_query($con, $updateQuantityQuery)) {
                echo 'Thank you for showing your interest in this product.';
            } else {
                echo 'Error updating quantity: ' . mysqli_error($con);
            }
        } else {
            echo 'Error fetching quantity: ' . mysqli_error($con);
        }
    } else {
        // User doesn't own the product, so insert ownership
        $insertOwnershipQuery = "INSERT INTO product_ownership (product_id, user_id) VALUES ('$id', '$currentUserId')";
        if (mysqli_query($con, $insertOwnershipQuery)) {
            echo 'Product added successfully.';
        } else {
            echo 'Error adding ownership: ' . mysqli_error($con);
        }
    }
} else {
    echo 'Invalid request.';
}
?>
