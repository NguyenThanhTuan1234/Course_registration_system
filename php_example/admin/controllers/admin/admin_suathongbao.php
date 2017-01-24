<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/admin/admin_model.php';
include $_SESSION['BASE_PATH'].'/models/post/post_model.php';

if( isset ( $_POST['find_post_id']) ){
  if( $_POST['post_id'] == ""){
    $error_find = 'Bạn hãy nhập vào mã số thông báo cần tìm!';
  } else {
    $post_obj = new Post();
    $post_get = $post_obj->get_post_by_post_id( $_POST['post_id']);
    if ( mysqli_num_rows($post_get)){
      $post = mysqli_fetch_assoc($post_get);
    } else {
      $error_find = 'Không tìm thấy bài viết có mã '.$_POST['post_id'].' trong cơ sở dữ liệu!';
    }
  }
}

if( isset( $_POST['update_post']) ){
  if( $_POST['update_post'] == ""){
    $error_update = 'Bạn phải tìm bài viết trước!';
  } else {
    $admin_obj = new Admin();
    if( isset ( $_POST['new_title'])){
      $admin_obj->update_post_by_post_id_title($_POST['update_post'], $_POST['new_title']);
    }
    if( isset($_POST['new_brief'])){
      $admin_obj->update_post_by_post_id_brief($_POST['update_post'], $_POST['new_brief']);
    }
    if( isset($_POST['new_header'])){
      $admin_obj->update_post_by_post_id_header($_POST['update_post'], $_POST['new_header']);
    }
    if( isset($_POST['new_content'])){
      $admin_obj->update_post_by_post_id_content($_POST['update_post'], $_POST['new_content']);
    }
    $sucess_update = 'Đã sửa lại thông báo';
  }
}

include $_SESSION['BASE_PATH'].'/views/admin/admin_suathongbao.html';
?>



