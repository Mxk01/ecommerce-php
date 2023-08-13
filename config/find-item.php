<?php
include('config.php');
 
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $searchTerm = $_GET['searchTerm'];
    
    // Query to fetch the row with matching title
    $getItemQuery = "SELECT * FROM products WHERE Title = '$searchTerm'";
    
    $result = mysqli_query($con, $getItemQuery);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            echo "Item found at position ".$row['Id'] ." : \n" . 'Title : ' . $row['Title'] ."\n" ."Price : ". $row['Price'] ."\n"."Stock : ". $row['Stoc'] ."\n Quantity :".$row['quantity']."\n";
        } else {
            echo 'Item not found';
        }
    } else {
        echo 'Error: ' . mysqli_error($con);
    }
}

?>