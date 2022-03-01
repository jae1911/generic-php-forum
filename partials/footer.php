<hr />

<?php
    $end_page_load = microtime(true);
    $page_load_time = ($end_page_load - $start_page_load);
?>

<footer>I am the footer; Rendered in <?php echo("$page_load_time");?> seconds</footer>

</body>
