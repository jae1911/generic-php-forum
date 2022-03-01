<?php

    $_TITLE = 'Main Page';

    require('partials/header.php');

?>

<h1>Welcome</h1>
<h2>This is a lightweight demonstration forum</h2>

<p>Links are there:</p>
<ul>
    <?php
    print($_SESSION['username']);
            if(session_status() == PHP_SESSION_ACTIVE) {
    ?>
                <li><a href="logout.php">Logout</a></li>
    <?php
            } else {
    ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
    <?php
            }
    ?>
</ul>

<?php

    require('partials/footer.php');

?>
