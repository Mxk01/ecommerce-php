<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchTerm = $_POST['searchTerm'];
    // to get rid of the foreign key constraint
    $getItemQuery = "SELECT * FROM products WHERE Title='$searchTerm'";

    if (mysqli_query($con, $getItemQuery)) {
       echo "Item found";
      
    } else {
        echo 'Item not found ,error: ' . mysqli_error($con);
    }
}
?>