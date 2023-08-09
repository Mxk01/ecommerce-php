<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Home</title>
</head>
<body>
    <?php session_start(); ?>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
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
                <button class="btn">Profile</button>
                <div class="dropdown-content">
                    <a href="profile.php">View Profile</a>
                    <a href="edit.php">Update Info</a>
                    <a href="config/logout.php">Log Out</a>
                </div>
            </div>
            <i class="fa-solid fa-cart-shopping" id="shopping-cart"></i>
        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $username ?></b>, Welcome 😊 </p>
            </div>
             
          </div>
       </div>
       <table class="product-table">
        <thead>
            <tr>
                <th>Product</th>
                <!-- <th>Description</th> -->
                <th>Price</th>
                <th>In stoc</th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $productsQuery = "SELECT * FROM products";
    $productsResult = mysqli_query($con, $productsQuery);

    // Check if there are any products in the result set
    if (mysqli_num_rows($productsResult) > 0) {
        while ($row = mysqli_fetch_assoc($productsResult)) {
            $title = $row['Title'];
            $description = $row['Description'];
            $price = $row['Price'];

            echo "<tr>
                <td>$title</td>
               <!-- <td>$description</td> -->
                <td>$price</td>

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
    </main>
</body>
</html>
