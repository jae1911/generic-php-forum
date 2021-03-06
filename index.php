<?php

    $_TITLE = 'Main Page';

    require('partials/header.php');

?>

<h1>Welcome</h1>
<h2>This is a lightweight demonstration forum</h2>
<?php if(isset($_SESSION['sess_userid'])) echo("Welcome " . $_SESSION['sess_username']); ?>

<p>Links are there:</p>
<ul>
    <?php
            if(isset($_SESSION['sess_userid']) && $_SESSION['sess_userid'] != "") {
    ?>
                <li><a href="add.php">Add post</a></li>
                <li><a href="catalog.php">Post catalog</a></li>
                <li><a href="dashboard.php">User dashboard</a></li>
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
        $sql = "SELECT p.title,p.content,p.uuid,p.post_date,u.username FROM posts p INNER JOIN users u ON u.id = p.poster ORDER BY p.post_date DESC LIMIT 5";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        print("<ul>");
        foreach ($stmt as $row) {
            $title = $row['title'];
            $content = $row['content'];
            $uuid = $row['uuid'];
            $date = $row['post_date'];
            $username = $row['username'];

            if($logged_in) {
                $username = "by <a href='u.php?u=$username'>$username</a>";
            } else {
                $username = '[please login to view usernames]';
            }

            print("<li><a href=\"view.php?p=$uuid\">$title</a> on $date</li> $username");
        }
        print("</ul>");
        if($logged_in) {
            print('<hr/><a href="catalog.php">View more.</a>');
        }
    } else {
        print('<h3>Nothing to see here...</h3>');
    }

?>

<?php

    require('partials/footer.php');

?>
