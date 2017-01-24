<?php
session_start();
include_once $_SESSION['BASE_PATH'].'/models/post/post_model.php';

$post_obj = new Post();
$result_10_last_post = $post_obj->get_10_last_post();
$result_post_admin = $post_obj->get_post_of_admin();
$result_post_register_class = $post_obj->get_post_register_class();
$result_post_graduate_project = $post_obj->get_post_graduate_project();
$result_post_graduate_consider = $post_obj->get_post_graduate_consider();
$result_post_warning_study = $post_obj->get_post_warning_study();
$result_post_test = $post_obj->get_post_test();
include $_SESSION['BASE_PATH'].'/views/user/trang_chu.html';
?>