<?php
session_start();

include_once $_SESSION['BASE_PATH'].'/models/user/user_model.php';

$get_user_table_point = new User();
$result_table_point = $get_user_table_point->get_table_point( $_SESSION['username'] );

include $_SESSION['BASE_PATH'].'/views/user/bang_diem_ca_nhan.html';

mysqli_free_result($result_table_point);

?>