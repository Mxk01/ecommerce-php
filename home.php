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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Home</title>
</head>
<body>
    <?php session_start(); ?>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
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

       <table class="product-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Product</th>
                <!-- <th>Description</th> -->
                <th>Price</th>
                <th>Detalii</th>
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

            echo "<tr>
            <td>$noCount</td>
            <td>$title</td>
            <td>$price</td>
            <td>
              <i class='fa-regular fa-eye'></i>
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
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
const deleteButtons = document.querySelectorAll('.delete-button');
const modal = document.getElementById('modal');
const closeModal = document.querySelector('.close-button');
const confirmDeleteButton = document.getElementById('confirm-delete');
$('#loading-screen').hide();
//  modal.style.display = 'block';
$(document).ready(function() {
            setTimeout(function() {
                $('#loading-screen').show('slow');
                $('#loading-screen').hide('slow');
            }, 500)
        }); // 2 seconds delay

deleteButtons.forEach(button => {
  button.addEventListener('click', () => {
    modal.style.display = 'block';
  });
});

closeModal.addEventListener('click', () => {
  modal.style.display = 'none';
});

confirmDeleteButton.addEventListener('click', () => {
  // Perform delete operation here
  modal.style.display = 'none';
});
 
$(document).ready(function() {
            $('.fa-trash').click(function() {
                
                var id = $(this).closest('tr').find('td:first-child').text();
                var title = $(this).closest('tr').find('td:nth-of-type(2)').text();

                
                if (confirm('Are you sure you want to delete ' + title + '?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'config/delete_item.php',
                        data: {
                            Id:id
                        },
                        success: function(response) {
                            console.log(response);
                            alert(response); 
                            window.location.reload();

                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
        });

    </script>
</body>
</html>
