<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
        <?php 
            include("config/config.php");
            if(isset($_POST["submit"])){
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                $check_mail_unique = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

                // Check if user email is already registered
                if(mysqli_num_rows($check_mail_unique) != 0) {
                    echo "<div class='message'>
                    <p>This email is used. Please try another one.</p>
                    </div></br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
                } else {
                    mysqli_query($con, "INSERT INTO users(Username, Email, Password) VALUES('$username', '$email', '$password')")
                    or die("Username couldn't be saved");
                    echo "<div class='message'>
                    <p>Username successfully registered!</p>
                    </div></br>";
                    echo "<a href='index.php'><button class='btn'>Login now</button></a>";
                }
            }
            // if(isset($_SESSION['valid'])){
            //     header("Location: home.php");
            // }
            // else {
            //     header("Location:register.php");
            // }
            
        ?>
            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

              
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register">
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#login-form").validate({
                rules: {
                    username: {
                        required: true,
                     },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    username: {
                        required: "Please enter your username"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password"
                    }
                },
                submitHandler: function(form) {
                    // This function will be called when the form is valid
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
