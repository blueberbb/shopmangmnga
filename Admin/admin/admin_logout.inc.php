<?php
session_start();
session_destroy();
echo '<script>';
echo 'window.location="../../index.php?do=logouta"';
echo '</script>';

?>