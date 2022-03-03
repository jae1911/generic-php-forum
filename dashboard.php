<?php

    $_TITLE = 'User dashboard';

    require('partials/header.php');

    if(!$logged_in) {
        header('Location: index.php');
    }
?>

<h1>User dashboard</h1>

<p><a href="index.php">Return to index</a></p>

<?php
    $sql = 'SELECT u.* FROM users u WHERE u.id = ' . $_SESSION['sess_userid'];
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
?>

<ul>
    <li>User: <?php echo($row['username']); ?></li>
    <li>Registered since: <?php echo($row['signup_date']); ?></li>
    <li>Account UUID: <?php echo($row['uuid']); ?></li>
</ul>

<h2>Nuke zone</h2>

<p><a href="deletion.php">I want to delete my account.</a><b>WARNING; THIS ACTION IS IRREVERSIBLE</b></p>

<?php

    require('partials/footer.php');

?>
