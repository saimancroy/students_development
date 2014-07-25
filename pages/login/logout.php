<?php
session_start();
session_destroy();
header("Location: /students_development2/index.php");
exit;
?>
