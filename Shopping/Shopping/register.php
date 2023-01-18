<?php
// ob_start();
include 'config.php';
session_start();
if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $cemail = isset($_POST['cemail']) ? trim($_POST['cemail']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
    $user_type = isset($_POST['user_type']) ? trim($_POST['user_type']) : '';
    $message=[];
    if (empty($email)) {
        $message[] = 'Email field is required.';
    }elseif (empty($cemail)) {
        $message[] = 'Email Confirm field is required.';
    }elseif ($email != $cemail) {
        $message[] = 'Email not matched!';
    } else {
        $valid = preg_match('/[0-z]+[@][0-z]+[.][A-z]+/', $_POST['email']) === 1;
        if (!$valid) {
            $message[] = 'Email address must have a valid email format.';
        } else {
            $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $query->bind_param("s", $_POST['email']);
            $query->execute();
            if($query->error){
                echo $query->error;
            }
            $result = $query->get_result();
            if($result->num_rows > 0){
                $message[] = 'This email is already registered.';
            } else {
                $email = $_POST['email'];
            }
        }
    }

    if (empty($name)) {
        $message[] = 'First name field is required.';
    }
    
    if (empty($user_type)) {
        $message[] = 'User type field is required.';
    }

if (empty($password)) {
    $message[] = 'Password field is required.';
} else if (strlen($password) < 8) {
    $message[] = 'Password must be at least 8 characters long.';
} else if (!preg_match('/[A-Z]/', $password)) {
    $message[] = 'Password must contain at least one capital letter.';
} else if (!preg_match('/[^a-zA-Z\d]/', $password)) {
    $message[] = 'Password must contain at least one special character.';
} else if ($password !== $confirm_password) {
    $message[] = 'Password and confirm password must match.';
}


    if (count($message) == 0) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $query = $conn->prepare("INSERT INTO users(name, email, password, user_type) VALUES (?,?,?,?)");
            $query->bind_param("ssss", $name, $email, $password_hashed, $user_type);
            $query->execute();
            if($query->error){
            echo $query->error;
            }
            $last_id = $conn->insert_id;

            $_SESSION['admin_name'] = $name;
            $_SESSION['admin_email'] = $email;
            $_SESSION['admin_id'] = $last_id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_id'] = $last_id;
            $_SESSION['user_type'] = $user_type;
            if ($user_type == 'admin') {
                header('location: admin_page.php');
            } elseif ($user_type == 'user') {
                header('location: index.php');
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
        foreach ($message as $messages) {
            echo '<div class="message">
            <span>' . $messages . '</span>
            <i class ="time" onclick="this.parentElement.remove();"></i>
          </div>';
        }
    }
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h2>Sign Up :)</h2>
            <input class="txt" type="text" name="name" placeholder="Enter Your name..." required
                value="<?php echo isset($name) ? $name : ''; ?>">
            <input class="txt" type="email" name="email" placeholder="Enter Your Email..." required
                value="<?php echo isset($email) ? $email : ''; ?>">
            <input class="txt" type="email" name="cemail" placeholder="Confirm email..." required
                value="<?php echo isset($cemail) ? $cemail : ''; ?>">
            <input class="txt" type="password" name="password" placeholder="Enter Your Password..." required>
            <input class="txt" type="password" name="confirm_password" placeholder=" Confirm password..." required>
            <select class="txt" name="user_type" id="user_type">
                <option value="user" <?php if (isset($user_type)) { $user_type == 'user' ? 'selected' : ""; }?>>User
                </option>
                <option value="admin" <?php if (isset($user_type)) { $user_type == 'admin' ? 'selected' : ""; }?>>Admin
                </option>
            </select>
            <input class="btn" type="submit" value="Register" name="submit">
            <p> You already have an account? <a href="login.php">Login </a></p>
        </form>
    </div>
</body>

</html>