<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Login</title>
</head>
<?php
// to persist data
session_start();

?>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
            include("config/config.php");
            if(isset($_POST["submit"])){
                $email = mysqli_real_escape_string($con,$_POST["email"]);
                $password = mysqli_real_escape_string($con,$_POST["password"]);
                // get the user with the email and password
                $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password='$password'") or die("Select error");
                // if the row isn't empty and the row is an array 
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    // useful to get the data in a different page
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['id'] = $row['Id'];
                }else{
                    echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                   echo "<a href='index.php'><button class='btn'>Go Back</button>";
         
                }
                if(isset($_SESSION['valid'])){
                    header("Location:home.php");
                }
                else {
                    header("Location:index.php");
                }
                
            }
            
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="./register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
      </div>
</body>
</html>