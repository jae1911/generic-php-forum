<?php

    $_TITLE = 'Login';

    require('partials/header.php');

    if(!empty($_POST['submit'])) {
        // Begin Login sequence

        // Various checks
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $err = [];

        if(empty($username) || strlen($username) < 2 || strlen($username) > 50)
            $err[] = 'Please input a valid username<br/>';
        if(empty($password) || strlen($password) < 8 || strlen($password > 255))
            $err[] = 'Please input a valid password<br/>';

        // Check if user exists
        $sql = "SELECT * FROM users WHERE username = :username";
        $handle = $db->prepare($sql);
        $params = ["username" => $username];
        $handle->execute($params);

        if($handle->rowCount() == 0)
            $err[] = 'Please <a href="register.php">register</a>.<br/>';

        if(empty($err)) {
            // Proceed to Login
            $getRow = $handle->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $getRow['password'])) {
                // Password OK, login sequence
                $_SESSION['username'] = $username;
                $_SESSION['userid'] = $getRow['id'];

                print($_SESSION['username']);
                header('location:index.php');
            }

        } else {
            foreach($err as $e) {
                print($e);
            }
        }
    }

?>

<h1>Login</h1>

<form action="login.php" method="post">
    <label>Username</label>
    <input type="text" name="username" id="username"/>
    <label>Password</label>
    <input type="password" name="password" id="password"/>
    <br/>
    <input type="submit" name="submit" id="submit">
</form>

<?php

    require('partials/footer.php');

?>
