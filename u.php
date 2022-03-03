<?php

    $_TITLE = 'View user';

    require('partials/header.php');

    if(!$logged_in) {
        header('Location: index.php');
    }

    if(!isset($_GET['u'])) {
        header('Location: index.php');
    }

    $query_id = htmlspecialchars($_GET['u']);

    // Preselect
    $sql = "SELECT p.*,u.username FROM posts p INNER JOIN users u ON u.id = p.poster WHERE u.username = '$query_id' ORDER BY post_date DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchColumn();
?>

<h1>View user</h1>

<p><a href="index.php">Return to index</a></p>

<?php
    if($rows < 1) {
        print('<p>This user has no posts</p>.');
    } else {
        $stmt->execute();

        print('<ul>');
        foreach($stmt as $row) {
            $title = $row['title'];
            $date = $row['post_date'];
            $uuid = $row['uuid'];
            print("<li><a href=\"view.php?p=$uuid\">$title</a> on $date</li>");
        }
        print('</ul>');
    }
?>

<?php

    require('partials/footer.php');

?>
