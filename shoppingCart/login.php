<!-- This script handles the login process for the website. It does the following:

Require the init.php file to establish a connection to the database.
If the request method is POST (meaning the user has submitted the login form), start the login process.
Initialize an empty array called $validation to store any error messages.
Check if the password field is set in the POST data. If not, set an error message in the $validation array. If it is set, store the password in a variable called $password.
Check if the username field is set in the POST data. If it is set, store the username in a variable called $username.
If the $password variable is set (meaning the password field was filled out in the form), perform a query to retrieve the user from the database. If the user is not found, or if there is an error retrieving the user, set error messages in the $validation array.
If the user is found, verify that the password provided by the user matches the hashed password stored in the database. If the password is correct, log the user in by:
Generating a random, unique token using the PHP function bin2hex and storing it in a variable called $token.
Storing the token in the user's record in the database, along with the expiration date (1 day from the current time).
Setting a cookie called "auth" with the value of the token and the expiration date.
Redirecting the user to the home page.
If the password is incorrect, set error messages in the $validation array. -->
<?php
require_once 'utils/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

$errors = [];
$password = $_POST['password'] ?? '';

if (!$password) {
    $errors['password'] = 'Password field is required.';
}

$username = $_POST['username'] ?? '';

if (!$username) {
    $errors['username'] = 'Username field is required.';
}

if (!$errors) {
    $query = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
    $query->execute([$username, $username]);
    $user = $query->fetch();

    if (!$user) {
        $errors['username'] = 'Username or password is incorrect.';
        $errors['password'] = 'Username or password is incorrect.';
    } else {
        if (password_verify($password, $user['password'])) {
            $token = bin2hex(random_bytes(64));
            $expiration = strtotime('+1 day', time());
            $expiration = date('Y-m-d H:i:s', $expiration);

            $query = $pdo->prepare("UPDATE users SET auth_token = ?, auth_expire = ? WHERE id = ?");
            $query->execute([$token, $expiration, $user['id']]);

            setcookie('auth', $token, $expiration);
            header("Location: index.php");
            exit;
        } else {
            $errors['username'] = 'Username or password is incorrect.';
            $errors['password'] = 'Username or password is incorrect.';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'includes/head.php'; ?>
</head>

<body class="nav-small book-request">
    <?php include 'includes/nav.php'; ?>

    <h1 class="nav-margin">LOGIN</h1>

    <form class="book-request-form" method="POST">
        <div>
            <label for="username-input">Username or email address</label>
            <input type="text" id="username-input" name="username" value="<?php echo isset($username) ? $username : ''; ?>" />
            <?php if (isset($validation) && isset($validation['username'])) { ?>
                <span><?php echo $validation['username']; ?></span>
            <?php } ?>
        </div>

        <div>
            <label for="password-input">Password</label>
            <input type="password" id="password-input" name="password" value="<?php echo isset($password) ? $password : ''; ?>" />
            <?php if (isset($validation) && isset($validation['password'])) { ?>
                <span><?php echo $validation['password']; ?></span>
            <?php } ?>
        </div>

        <input type="submit" value="Log in" />
    </form>
</body>

</html>