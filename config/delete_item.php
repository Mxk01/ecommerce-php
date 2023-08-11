<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['Id'];
    // to get rid of the foreign key constraint
    $deleteOwnershipQuery = "DELETE FROM product_ownership WHERE product_id='$id'";

    if (mysqli_query($con, $deleteOwnershipQuery)) {
        // Now delete the product
        $deleteQuery = "DELETE FROM products WHERE Id='$id'";
        
        if (mysqli_query($con, $deleteQuery)) {
            echo 'Item deleted successfully.';
        } else {
            echo 'Error deleting item: ' . mysqli_error($con);
        }
    } else {
        echo 'Error deleting ownership records: ' . mysqli_error($con);
    }
}
?>
