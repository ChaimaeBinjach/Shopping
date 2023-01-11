<?php
try {
    require_once 'utils/init.php';
} catch (Throwable $exp) {
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validation = [];
    // First name validation
    if (!isset($_POST['fname']) || $_POST['fname'] === '') {
        $validation['fname'] = 'First name field is required.';
    } else {
        $fname = $_POST['fname'];
    }

    // Last name validation
    if (!isset($_POST['lname']) || $_POST['lname'] === '') {
        $validation['lname'] = 'Last name field is required.';
    } else {
        $lname = $_POST['lname'];
    }

    // Password validation
    if (!isset($_POST['password']) || $_POST['password'] === '') {
        $validation['password'] = 'Password field is required.';
    } else if (!isset($_POST['confirm']) || $_POST['password'] !== $_POST['confirm']) {
        $validation['confirm'] = 'Password and password confirmation must match.';
        $validation['password'] = 'Password and password confirmation must match.';
    } else if (strlen($_POST['password']) < 10) {
        $validation['password'] = 'Password must have a length of 10 at least.';
    } else {
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
    }

    // Validate date of birth
    if (!isset($_POST['dob']) || $_POST['dob'] === '') {
        $validation['dob'] = 'Date of birth field is required.';
    } else {
        $epoch = strtotime($_POST['dob']);
        if (!$epoch) {
            $validation['dob'] = 'Date of birth must be a valid date.';
        } else if ($epoch > time() || $epoch < strtotime('-150 years', time())) {
            $validation['dob'] = 'Date of birth must be a valid date.';
        } else {
            $dob = $_POST['dob'];
        }
    }

    // Username validation
    if (!isset($_POST['username']) || $_POST['username'] === '') {
        $validation['username'] = 'Username field is required.';
    } else {
        $query = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $query->execute([$_POST['username']]);
        $usernames = $query->fetchAll();
        
        if (is_array($usernames) && count($usernames) > 0) {
            $validation['username'] = 'This username is already registered.';
        } else {
            $username = $_POST['username'];
        }
    }

    // Email validation
    if (!isset($_POST['email']) || $_POST['email'] === '') {
        $validation['email'] = 'Email address field is required.';
    } else {
        $valid = preg_match('/[0-z]+[@][0-z]+[.][A-z]+/', $_POST['email']) === 1;
        if (!$valid) {
            $validation['email'] = 'Email address must have a valid email format.';
        } else {
            $query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $query->execute([$_POST['username']]);
            $emails = $query->fetchAll();

            if (is_array($emails) && count($emails) > 0) {
                $validation['email'] = 'This email is already registered.';
            } else {
                $email = $_POST['email'];
            }
        }
    }

    // Sex validation
    if (!isset($_POST['sex']) || $_POST['sex'] === '') {
        $validation['sex'] = 'Sex field is required.';
    } else {
        switch ($_POST['sex']) {
            case 'F':
                $sexDbval = 0;
                break;
            case 'M':
                $sexDbval = 1;
                break;
            case 'U':
                $sexDbval = null;
                break;
            default:
                $validation['sex'] = 'Sex field must contain one of the options.';
                break;
        }
        if (isset($sexDbval)) {
            $sex = $_POST['sex'];
        }
    }

    // License validation
    if (!isset($_POST['license']) || $_POST['license'] !== '1') {
        $validation['license'] = 'License agreement must be accepted.';
    } else {
        $license = $_POST['license'];
    }

    if (count($validation) === 0) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = $pdo->prepare('INSERT INTO users(username, email, password, fname, lname, dob, sex, lang, license_accepted, verified) VALUES(?, ?, ?, ?, ?, ?, ?, ?, 1, 1)');
        $query->execute([$username, $email, $hash, $fname, $lname, $dob, $sexDbval, $_POST['lang']]);
    }
}
?>

<!DOCTYPE html>
<html>
<?= include_once 'includes/head.php' ?>

<body class="nav-small book-request">
    <?= include_once 'includes/nav.php' ?>

    <h1 class="nav-margin">REGISTER</h1>

    <form class="book-request-form" method="POST">
        <div>
            <label>Email address</label>
            <input type="text" name="email" value="<?= isset($email) ? $email : '' ?>" />
            <?php
            if (isset($validation) && isset($validation['email'])) {
            ?>
            <span><?= $validation['email'] ?></span>
            <?php
            }
            ?>
        </div>

        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?= isset($title) ? $title : '' ?>" />
            <?php
            if (isset($validation) && isset($validation['username'])) {
            ?>
            <span><?= $validation['username'] ?></span>
            <?php
            }
            ?>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" value="<?= isset($password) ? $password : '' ?>" />
            <?php
            if (isset($validation) && isset($validation['password'])) {
            ?>
            <span><?= $validation['password'] ?></span>
            <?php
            }
            ?>
        </div>

        <div>
            <label>Confirm password</label>
            <input type="password" name="confirm" value="<?= isset($confirm) ? $confirm : '' ?>" />
            <?php
            if (isset($validation) && isset($validation['confirm'])) {
            ?>
            <span><?= $validation['confirm'] ?></span>
            <?php
            }
            ?>
        </div>

        <div>
            <label>Date of birth</label>
            <input type="date" name="dob" value="<?= isset($dob) ? $dob : '' ?>" />
            <?php
            if (isset($validation) && isset($validation['dob'])) {
            ?>
            <span><?= $validation['dob'] ?></span>
            <?php
            }
            ?>
        </div>

        <div>
            <label>First name</label>
            <input type="text" name="fname" value="<?= isset($fname) ? $fname : '' ?>" />
            <?php
            if (isset($validation) && isset($validation['fname'])) {
            ?>
            <span><?= $validation['fname'] ?></span>
            <?php
            }
            ?>
        </div>

        <div>
            <label>Last name</label>
            <input type="text" name="lname" value="<?= isset($lname) ? $lname : '' ?>" />
            <?php
            if (isset($validation) && isset($validation['lname'])) {
            ?>
            <span><?= $validation['lname'] ?></span>
            <?php
            }
            ?>
        </div>

        <div>
            <label>Sex: </label>
            <label class="register-contianer">
                Female
                <input type="radio" name="sex" value="F" />
                <span class="checkmark"></span>
            </label>
            <label class="register-contianer">
                Male
                <input type="radio" name="sex" value="M" />
                <span class="checkmark"></span>
            </label>
            <label class="register-contianer">
                I would rather not tell
                <input type="radio" name="sex" value="U" checked />
                <span class="checkmark"></span>
            </label>

            <?php
            if (isset($validation) && isset($validation['sex'])) {
            ?>
            <span><?= $validation['sex'] ?></span>
            <?php
            }
            ?>
        </div>

        <div>
            <label>Language</label>
            <select name=" lang" class="custom-select">
                <option value="hu-HU" selected>Hungarian</option>
                <option value="en-US">American English</option>
            </select>

            <?php
            if (isset($validation) && isset($validation['lang'])) {
            ?>
            <span><?= $validation['lang'] ?></span>
            <?php
            }
            ?>
        </div>

        <div>
            <label class="register-contianer">I accept the license agreement.
                <input type="checkbox" name="license" value="1" />
                <span class="checkmark"></span>
            </label>

            <?php
            if (isset($validation) && isset($validation['license'])) {
            ?>
            <span><?= $validation['license'] ?></span>
            <?php
            }
            ?>
        </div>
        <input type="submit" value="Register" />
    </form>
</body>

</html>