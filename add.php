<?php

    $_TITLE = 'Register';

    if(isset($_SESSION['sess_userid']))
        header('Location: index.php');

    require('partials/header.php');

    if(!empty($_POST['submit'])) {
        // Begin Register sequence

        // Various checks
        $title = htmlspecialchars($_POST['title']);
        $text = htmlspecialchars($_POST['text']);

        $err = [];

        if(empty($title) || strlen($title) < 3 || strlen($title) > 255)
            $err[] = 'Please input a valid title<br/>';
        if(empty($text) || strlen($text) < 8 || strlen($text > 5000))
            $err[] = 'Please input a valid text<br/>';

        if(empty($err)) {
            // Proceed to add text
            $uuid = uniqid();
            $uid = intval($_SESSION['sess_userid']);

            $data = [
                'title' => $title,
                'content' => $text,
                'poster' => $uid,
                'uuid' => $uuid
            ];

            $sql = "INSERT INTO posts (title, content, poster, post_date, uuid) VALUES (:title, :content, :poster, now(), :uuid)";
            $stmt = $db->prepare($sql);

            try {
                $stmt->execute($data);

                header('Location: viewpost.php?p=' . $uuid);
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

<form action="add.php" method="post">
    <label>Title (255 chars)</label>
    <input type="text" name="title" id="title"/>
    <br/>
    <label>Text</label>
    <textarea name="text" id="text"></textarea>
    <br/>
    <input type="submit" name="submit" id="submit">
</form>

<?php

    require('partials/footer.php');

?>
