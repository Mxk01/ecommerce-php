<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/products.css">
    <link rel="stylesheet" href="styles/modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Home</title>
</head>
<body>
    <?php session_start(); ?>
    <div class="nav">
        <div class="logo">
            <!-- <p><a href="home.php"><img src="./assets/images/mes-logo.png"/></a></p> -->
            <a href="home.php"><p> Shoppy </p></a>

        </div>
        <div id="loading-screen">
    <p id="loading-text">Loading...</p>
  </div>
      
        <div class="right-links">
            <?php 
            include('config/config.php');
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT * FROM users WHERE Id='$id'");

            while($result = mysqli_fetch_assoc($query))
            {
                $username = $result['Username'];
                $email = $result['Email'];
                $result_id = $result['Id'];
            }
            if(!isset($_SESSION['valid']))
            {
                header("Location:index.php");
            }
            ?>
            <div class="dropdown">
            <i class="fa-solid fa-bars"></i>
                <div class="dropdown-content">
                    <a href="edit.php">Update Info</a>
                    <a href="config/logout.php">Log Out</a>
                </div>
            </div>
            <a href="cart.php"><i class="fa-solid fa-cart-shopping" id="shopping-cart"></i></a>
        </div>
    </div>
    <div id="modal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <p>Are you sure you want to delete this item?</p>
    <button id="confirm-delete">Delete</button>
  </div>
</div>
    <main>
        <?php echo "<h1>Welcome $username</h1>";?>
        <div class="search-container">
        <i class="fas fa-search search-icon"  ></i>
        <input type="text" class="search-input"  placeholder="Search..." style="border:0;background:transparent;
        outline:none;padding:30px;"/>
    </div>
        <table class="product-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Product</th>
                 <th>Price</th>
                <th>Image</th>
                <th>Options</th>

            </tr>
        </thead>
        <tbody>
    <?php 
    $productsQuery = "SELECT * FROM products";
    $productsResult = mysqli_query($con, $productsQuery);

    // Check if there are any products in the result set
    if (mysqli_num_rows($productsResult) > 0) {
        while ($row = mysqli_fetch_assoc($productsResult)) {
            $noCount = $row['Id'];
            $title = $row['Title'];
            $price = $row['Price'];
            $stoc = $row['Stoc'];
            $image = $row['Product_Image'];

            echo "<tr>
            <td>$noCount</td>
            <td>$title</td>
            <td>$price</td>
            <td style='width:30%;'><img class='product-image' style='object-fit:cover; border-radius:5px; width:45%; height:30%;' src='$image'/></td>
            <td> <i class='fa fa-shopping-cart' aria-hidden='true'></i> </td>
        </tr>";
    
        }
    } else {
        echo "<tr>
                <td colspan='4'>No products found.</td>
            </tr>";
    }
    ?>
</tbody>

    </table>
    <div class="footer">
        <p>&copy; 2023 Your Website. All rights reserved.</p>
        <button id="scrollToTop">Scroll to Top</button>
    </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="scripts/main.js" defer>

    </script>
</body>
</html>
