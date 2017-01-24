<?php
session_start();
include $_SESSION['BASE_PATH']."/models/user/user_model.php";

$common_infomation = new User();
$common_info = mysqli_fetch_assoc($common_infomation->get_common_info_by_username($_SESSION['username']));

include $_SESSION['BASE_PATH'].'/views/user/thong_tin_ca_nhan.html';

?>