<?php
$directory = $_SERVER['PHP_SELF'];
$directory = explode('/',$directory);
echo $directory[1];

?>