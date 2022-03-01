<?php

    $_TITLE = 'Main Page';

    require('partials/header.php');

?>

<h1>Welcome</h1>
<h2>This is a lightweight demonstration forum</h2>

<p>Links are there:</p>
<ul>
    <?php
            if(isset($_SESSION['sess_userid']) && $_SESSION['sess_userid'] != "") {
    ?>
                <li><a href="add.php">Add post</a></li>
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

<hr />

Latest posts:
<?php

    $sql = "SELECT * FROM posts ORDER BY post_date DESC LIMIT 5";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $rows = $stmt->fetchColumn();

    if($rows > 0) {
        // TODO: display posts
    } else {
        print('<h3>Nothing to see here...</h3>');
    }

?>

<?php

    require('partials/footer.php');

?>
