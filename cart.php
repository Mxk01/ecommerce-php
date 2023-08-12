<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/products.css">
    <link rel="stylesheet" href="styles/modal.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Home</title>
</head>
<body>
    <?php session_start(); ?>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Shoppy</a></p>
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
            <i class="fa-solid fa-cart-shopping" id="shopping-cart"></i>
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
        <?php echo "<h1>Hi $username</h1>";
                     echo "<span>Check your 🛒</span>";   
                      ?>
       <table class="product-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Product</th>
                <!-- <th>Description</th> -->
                <th>Price</th>
                <th>Quantity</th>
                <th>Detalii</th>
            </tr>
        </thead>
        <tbody>
    <?php 
    # only select the products which belong to this user 
   $productsQuery = "
   SELECT p.Id, p.Title, p.Price, p.Stoc,p.quantity
   FROM products p
   JOIN product_ownership po ON p.Id = po.product_id
   WHERE po.user_id = '$id'";
   
    $productsResult = mysqli_query($con, $productsQuery);

    // Check if there are any products in the result set
    if (mysqli_num_rows($productsResult) > 0) {
        while ($row = mysqli_fetch_assoc($productsResult)) {
            $noCount = $row['Id'];
            $title = $row['Title'];
            $price = $row['Price'];
            $stoc = $row['Stoc'];
            $qty = $row['quantity'];

            echo "<tr>
            <td>$noCount</td>
            <td>$title</td>
            <td>$price</td>
            <td>$qty</td>
            <td>
              <!-- <i class='fa-regular fa-eye'></i> -->
              <i class='fa-solid fa-trash'></i>          
            </td>
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
    <script src="scripts/cart.js"></script>
    
</body>
</html>

