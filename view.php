<?php

    $_TITLE = 'See post';

    require('partials/header.php');

    if(!$logged_in) {
        header('Location: index.php');
    }

    if(!isset($_GET['p'])) {
        header('Location: index.php');
    }

    $query_id = htmlspecialchars($_GET['p']);

    // Preselect
    $sql = "SELECT p.*,u.username FROM posts p INNER JOIN users u ON u.id = p.poster WHERE p.uuid = '$query_id'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchColumn();

    if($rows < 1) {
        header('Location: index.php');
    }
?>

<h1>See post</h1>

<p><a href="index.php">Return to index</a></p>

<?php

    $stmt->execute();

    foreach ($stmt as $row) {
        $title = $row['title'];
        $content = $row['content'];
        $uuid = $row['uuid'];
        $date = $row['post_date'];
        $username = $row['username'];
        print("<h2>$title</h2>");
        print("<p>$content</p>");
        print("On $date by <a href='u.php?u=$username'>$username</a>.");
    }

    require('partials/footer.php');

?>
