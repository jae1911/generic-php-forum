<?php

    $_TITLE = 'Account deletion';

    require('partials/header.php');

    if(!$logged_in) {
        header('Location: index.php');
    }

    if(!empty($_POST['submit'])) {
        if($_POST['submit'] == 'Yes') {
            $sql = 'UPDATE users u SET u.username = "Ghost User", u.password = "0" WHERE u.id = ' . $_SESSION['sess_userid'];
            $stmt = $db->prepare($sql);
            $stmt->execute();

            header('Location: logout.php');
        } else {
            header('Location: dashboard.php');
        }
    }
?>

<h1>Account deletion</h1>

<p><a href="index.php">Return to index</a></p>

<h2>ARE YOU SURE YOU WANT TO DELETE YOUR ACCOUNT?</h2>

<form action="deletion.php" method="post">
    <label>Confirm</label>
    <br/>
    <input type="submit" name="submit" value="Yes">

    <br/>
    <br/>
    <label>Cancel</label>
    <br/>
    <input type="submit" name="submit" value="Cancel">
</form>

<?php

    require('partials/footer.php');

?>
