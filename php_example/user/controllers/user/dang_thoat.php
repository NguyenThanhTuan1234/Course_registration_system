<?php
session_start();
$Dup_base_url = $_SESSION['BASE_URL'];
session_destroy();
header("Location:".$Dup_base_url);
?>