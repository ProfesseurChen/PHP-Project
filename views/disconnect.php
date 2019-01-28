<?php

ob_start();
session_start();
session_destroy();


$home = ob_get_clean();

header('Location:../index.php');

?>
