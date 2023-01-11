<?php
session_start();

include 'config.php';

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Invalid email format';
    }

    if (strlen($password) < 8) {
        $message[] = 'Password must be at least 8 characters';
    }


    if (empty($message)) {
        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);

        // Execute statement and get the result
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);

            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('Location: location:admin_page.php');
                exit;
            } else if ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('Location: location:home.php');
                exit;
            }
        } else {
            $message[] = 'Incorrect email or password';
        }
        $stmt->close();
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
            <input class="txt" type="email" name="email" placeholder="Enter Your Email..." required>
            <input class="txt" type="password" name="password" placeholder="Enter Your Password..." required>
            <input class="sub" type="submit" value="Login" name="submit">
            <p> Don't you have an account? --> <a href="register.php">Register </a></p>
        </form>
    </div>
</body>

</html>