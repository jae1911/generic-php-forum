<?php

    $_TITLE = 'Register';

    require('partials/header.php');

    if($logged_in) {
        header('Location: index.php');
    }

    if(!empty($_POST['submit'])) {
        // Begin Register sequence

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

        if($handle->rowCount() > 0)
            $err[] = 'Please choose a different username or <a href="login.php">login</a><br/>';

        if(empty($err)) {
            // Proceed to Register
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT);

            $date = date('Y-m-d H:i:s');

            $data = [
                'username' => $username,
                'password' => $hashed_pass
            ];

            $sql = "INSERT INTO users (username, password, signup_date, last_login) VALUES (:username, :password, now(), now())";
            $stmt = $db->prepare($sql);

            try {
                $stmt->execute($data);

                print("User created, you can now login<br/>");
            } catch(PDOException $e) {
                print($e->getMessage());
            }

        } else {
            foreach($err as $e) {
                print($e);
            }
        }
    }

?>

<h1>Register</h1>

<p><a href="index.php">Return to index</a></p>

<form action="register.php" method="post">
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
