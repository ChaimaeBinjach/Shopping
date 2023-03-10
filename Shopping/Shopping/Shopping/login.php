<?php
include 'config.php';
session_start();





if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $message[] = "Email and password fields are required";
    } else {
        // retrieve the hashed password from the database for the provided email
        // retrieve the hashed password from the database for the provided email
        $query = "SELECT password FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $hashed_password = mysqli_fetch_assoc($result)['password'];
    }




    // verify the entered password against the hashed password
    if (password_verify($_POST['password'], $hashed_password)) {

        // select the user from the database
        $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email ='$email'") or die('query failed');

        if (mysqli_num_rows($select_users) > 0) {
            $row = mysqli_fetch_assoc($select_users);

            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];
            if ($row['user_type'] == 'admin') {
                header('location:admin_page.php');
            } elseif ($row['user_type'] == 'user') {

                header('location:index.php');
            }
        }
    } else {
        $message[] = 'incorrect email or password!';
    }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- checks if the $message variable is set and if it has any messages in it.  -->

    <?php
    if (isset($message) && count($message) > 0) {
        foreach ($message as $message) {
            echo '<div class="message">
            <span>' . $message . '</span>
            <i class ="time" onclick="this.parentElement.remove();"></i>
          </div>';
        }
    }
    ?>

    <div class="form-container">
        <form action="" method="post">
            <h2>Login :)</h2>
            <input class="txt" type="email" name="email" placeholder="Enter Your Email..." required value="<?php echo isset($email) ?  $email : '' ?>">
            <input class="txt" type="password" name="password" placeholder="Enter Your Password..." required>
            <input class="btn" type="submit" value="Login" name="submit">
            <p> Don't you have an account? <a href="register.php">Sign up </a></p>
        </form>
    </div>
</body>

</html>