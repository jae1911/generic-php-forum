<?php

    $_TITLE = 'Admin panel';

    require('partials/header.php');

    if(!$logged_in) {
        header('Location: index.php');
    }

    $sql = 'SELECT u.* FROM users u WHERE u.id = ' . $_SESSION['sess_userid'];
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();

    // Admin verification
    if($row['admin'] != 'yes' or $_SESSION['admin'] != 'yes') {
        header('Location: index.php');
    }
?>

<style type="text/css">
table,
td {
    border: 1px solid #333;
}

thead,
tfoot {
    background-color: #333;
    color: #fff;
}
</style>

<h1>Admin dashboard</h1>

<p><a href="index.php">Return to index</a></p>

<hr/>

<h2>Users</h2>

<?php
    $sql = 'SELECT u.* FROM users u';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    print("<ul>");
    foreach($stmt as $row) {
        $username = $row['username'];
        $uuid = $row['uuid'];
        $signin = $row['signup_date'];
        print("<li>[$uuid] $username - $signin</li>");
    }
    print("</ul>");
?>

<hr/>
<h2>Posts</h2>

<?php
    $sql = 'SELECT p.title,p.uuid,p.post_date,u.username FROM posts p INNER JOIN users u ON u.id = p.poster ORDER BY p.post_date';
    $stmt = $db->prepare($sql);
    $stmt->execute();
?>    

<table>
    <thead>
        <th>UUID</th>
        <th>Title</th>
        <th>Date</th>
        <th>Username</th>
    </thead>
    <tbody>
<?php
    foreach($stmt as $row) {
        print('<tr>');
        $title = $row['title'];
        $uuid = $row['uuid'];
        $post_date = $row['post_date'];
        $username = $row['username'];

        print("<td>$uuid</td>");
        print("<td>$title</td>");
        print("<td>$post_date</td>");
        print("<td>$username</td>");

        print('</tr>');
    }
?>
    </tbody>
</table>

<?php

    require('partials/footer.php');

?>
