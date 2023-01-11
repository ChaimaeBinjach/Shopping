<!-- // include 'config.php';

// if (isset($_POST['submit'])) {

// $name = mysqli_real_escape_string($conn, $_POST['name']);
// $email = mysqli_real_escape_string($conn, $_POST['email']);
// $cemail = mysqli_real_escape_string($conn, $_POST['cemail']);
// $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
// $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
// $user_type = $_POST['UserType'];
// $select_users = mysqli_query($conn, "SELECT * FROM 'users' WHERE email ='$email' AND password='$pass'") or die('query failed');

// if (mysqly_num_rows($select_users) > 0) {
// $message[] = 'user already exists!';
// } else {
// if ($pass != $cpass) {
// $message[] = 'try again the password not matched!';
// } else {
// mysqli_query($conn, "INSERT INTO 'users'(name, email,password,user_type) VALUES ('$name','$cemail','$cpass','$user_type')") or die('query failed');
// $message[] = 'Registered Successfully!Well done!';
// }
// }
// } -->

<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cemail = $_POST['cemail'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $user_type = $_POST['User_type'];


    if ($email != $cemail) {
        $message[] = 'Email not matched!';
    }
    if ($pass != $cpass) {
        $message[] = 'Password not matched!';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Invalid email format';
    }
    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pass)) {
        $message[] = 'password should be minimum 8 character at least 1 Alphabet and 1 Number:';
    }
    if (empty($message)) {
        $query = "SELECT * FROM `users` WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $message[] = 'User already exists!';
        } else {
            $query = "INSERT INTO `users`(name, email,password,user_type) VALUES (?,?,?,?)";
            $stmt = mysqli_prepare($conn, $query);
            $password_hashed = password_hash($pass, PASSWORD_BCRYPT);
            mysqli_stmt_bind_param($stmt, "ssss", $name, $cemail, $password_hashed, $user_type);
            $success = mysqli_stmt_execute($stmt);
            if ($success) {
                $message[] = 'Registered Successfully!well done!';
                header('location:login.php');
            } else {
                $message[] = 'Error: ' . mysqli_error($conn);
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
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
            <h2>Sign in :)</h2>
            <input class="txt" type="text" name="name" placeholder="Enter Your name..." required>
            <input class="txt" type="email" name="email" placeholder="Enter Your Email..." required>
            <input class="txt" type="email" name="cemail" placeholder="Confirm email..." required>
            <input class="txt" type="password" name="password" placeholder="Enter Your Password..." required>
            <input class="txt" type="password" name="cpassword" placeholder=" Confirm password..." required>
            <select class="txt" name="User_type" id="User_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input class="sub" type="submit" value="Register" name="submit">
            <p> You already have an account? --> <a href="login.php">Login </a></p>
        </form>
    </div>
</body>

</html>