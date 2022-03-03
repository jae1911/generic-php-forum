<hr />

<?php
    $end_page_load = microtime(true);
    $page_load_time = $end_page_load - $start_page_load;
?>

<footer>Jae's <a href="https://github.com/jae1911/generic-php-forum">Generic PHP Forum</a>; Rendered in <?php echo("$page_load_time");?> seconds</footer>

</body>
