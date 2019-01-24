<?php

ob_start();

session_destroy();

$home = ob_get_clean();

header('index.php');

?>
