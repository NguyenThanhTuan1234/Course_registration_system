<?php
session_start();
include "./etc/config/config_webserver.php";
$_SESSION['BASE_PATH'] = $BASE_PATH;
$_SESSION['BASE_URL'] = $BASE_URL;

if ( isset ( $_SESSION['admin_id'] ) ){
  header("Location:".$_SESSION['BASE_URL']."/controllers/admin/admin_trangchu.php");
} else {
  header("Location:".$_SESSION['BASE_URL']."/controllers/admin/admin_login.php");
}

?>
