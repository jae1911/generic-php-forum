<?php

    $_TITLE = 'Catalog';

    require('partials/header.php');

    if(!$logged_in) {
        header('Location: index.php');
    }

    if(!isset($_GET['page'])) {
        $page = 1;
    } elseif (empty($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    $limit = 5;

    $start_limit = ($page - 1) * $limit;

    // Count
    $csql = "SELECT COUNT(*) FROM posts";
    $stmt = $db->prepare($csql);
    $stmt->execute();
    $postcount = $stmt->fetchColumn();

    $prevpage = $page - 1;
    $newpage = $page + 1;

    $new_posts = ($page * 5) + 1;
    $show_next = false;
    if($postcount >= $new_posts) {
        $show_next = true;
    }

    $show_prev = false;
    if($page > 1) {
        $show_prev = true;
    }

    // Preselect
    $sql = "SELECT p.*,u.username FROM posts p INNER JOIN users u ON u.id = p.poster ORDER BY post_date DESC LIMIT $start_limit,$limit";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchColumn();
?>

<h1>Catalog</h1>

<p><a href="index.php">Return to index</a></p>

<?php

    if($rows < 1) {
        print("<h2>Catalog is empty, call your friends and come back later!</h2>");
    } else {

        $stmt->execute();

        foreach ($stmt as $row) {
            $title = $row['title'];
            $content = $row['content'];
            $uuid = $row['uuid'];
            $date = $row['post_date'];
            $username = $row['username'];
            print("<hr/>");
            print("<h2>$title</h2>");
            print("<p>$content</p>");
            print("On $date by <a href='u.php?u=$username'>$username</a>.");
        }

        print("<hr/><br/><br/>");

        if($show_prev) {
            print("<a href='catalog.php?page=$prevpage'>Previous page</a>");
            print('<br/>');
        }

        if($show_next) {
            print("<a href='catalog.php?page=$newpage'>Next page</a>");
            print("<br/>");
        }

    }

    require('partials/footer.php');

?>
