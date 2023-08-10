<?php
include('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['Id'];
 
    $deleteQuery = "DELETE FROM products WHERE Id='$id'";
    
    if (mysqli_query($con, $deleteQuery)) {
        echo 'Item deleted successfully.';
    } else {
        echo 'Error deleting item: ' . mysqli_error($con);
    }
}
?>
