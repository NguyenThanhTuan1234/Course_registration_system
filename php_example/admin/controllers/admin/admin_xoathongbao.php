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

if( isset ( $_POST['delete_post'])){
  if ( $_POST['delete_post'] != "") {
  $admin_obj = new Admin();
  $admin_obj->delete_post_by_post_id( $_POST['delete_post']);  
  $post_obj = new Post();
  $post = $post_obj->get_post_by_post_id( $_POST['delete_post']);
  if( mysqli_num_rows($post)) {
    $error_delete = 'Có lỗi trong quá trình xoá bài viết. Đề nghị bạn dừng công việc lại và kiểm tra lại tình trạng hệ thống!';
  } else {
    $sucess_delete = 'Đã xoá bài đăng có mã '.$_POST['delete_post'];
  }
  } else {
    $error_delete = 'Bạn phải tìm bài viết trước!';
  }
}

include $_SESSION['BASE_PATH'].'/views/admin/admin_xoathongbao.html';
?>