<?php
    try {
        require_once 'utils/init.php';
    } catch (Throwable $exp) { }

    $success = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $validation = [];
        if (!isset($_POST['author']) || $_POST['author'] === '') {
            $validation[] = ['author' => 'Author field is required.'];
        } else {
            $author = $_POST['author'];
        }

        if (!isset($_POST['title']) || $_POST['title'] === '') {
            $validation[] = ['title' => 'Title field is required.'];
        } else {
            $title = $_POST['title'];
        }

        $desc = isset($_POST['desc']) ? $_POST['desc'] : '';
        
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            $validation[] = ['name' => 'Your name field is required.'];
        } else {
            $name = $_POST['name'];
        }

        if (!isset($_POST['email']) || $_POST['email'] === '') {
            $validation[] = ['email' => 'Your email address field is required.'];
        } else {
            $email = $_POST['email'];
            $valid = preg_match('/[0-z]+[@][0-z]+[.][A-z]+/', $email) === 1;
            if (!$valid) {
                $validation[] = ['email' => 'Your email address must have a valid email format.'];
            }
        }

        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        if ($phone !== '') {
            $valid = preg_match('/[+][0-9]{9}[0-9]*/', $phone) === 1;
            $validation[] = ['phone' => 'Your phone number must have a valid telephone number format.'];
        }

        if (count($validation) === 0) {
            // The form is valid
            $query = $pdo->prepare('INSERT INTO book_requests(author, title, description, name, email, phone) VALUES(?, ?, ?, ?, ?, ?)');
            $query->execute([$author, $title, $desc, $name, $email, $phone]);

            $errors = $pdo->errorInfo();
            if ($errors[0] === PDO::ERR_NONE) {
                $author = '';
                $title = '';
                $desc = '';
                $email = '';
                $name = '';
                $phone = '';
                $success = true;
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <?= include_once 'includes/head.php' ?>
    <body class="nav-small book-request">
        <?= include_once 'includes/nav.php' ?>

        <p class="nav-margin justify merriweather">You cannot find your preferred title in our selection of books? Worry not, we are here for you! We have a team specialized in the acquisition of book regardless of age, language, or rarity. Just fill in the request form below, and we will tell you when we found it.</p>

        <h1>REQUEST A BOOK</h1>
        <?php
            if ($success) {
        ?>
            <h4>Your request has been successfully recorded. We will get back to you soon.</h4> 
        <?php
            }
        ?>
        <form class="book-request-form" method="POST">
            <div>
                <label>Author</label>
                <input type="text" name="author" placeholder="Mark Twain" value="<?= isset($author) ? $author : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['author'])) {
                ?>
                    <span><?= $validation['author'] ?></span>
                <?php
                    }
                ?>
            </div>
            
            <div>
                <label>Title</label>
                <input type="text" name="title" placeholder="The Adventures of Tom Sawyer" value="<?= isset($title) ? $title : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['title'])) {
                ?>
                    <span><?= $validation['title'] ?></span>
                <?php
                    }
                ?>
            </div>

            <div>
                <label>Description (Optional)</label>
                <input type="text" name="desc" placeholder="Please tell us a few words about the book" value="<?= isset($desc) ? $desc : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['desc'])) {
                ?>
                    <span><?= $validation['desc'] ?></span>
                <?php
                    }
                ?>
            </div>

            <div>
                <label>Your name</label>
                <input type="text" name="name" value="<?= isset($name) ? $name : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['name'])) {
                ?>
                    <span><?= $validation['name'] ?></span>
                <?php
                    }
                ?>
            </div>

            <div>
                <label>Your email address</label>
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
                <label>Your phone number (Optional)</label>
                <input type="text" name="phone" placeholder="+44 20 123 4567" value="<?= isset($phone) ? $phone : '' ?>" />
                <?php
                    if (isset($validation) && isset($validation['phone'])) {
                ?>
                    <span><?= $validation['phone'] ?></span>
                <?php
                    }
                ?>
            </div>
            <input type="submit" value="Request" />
        </form>
    </body>
</html>