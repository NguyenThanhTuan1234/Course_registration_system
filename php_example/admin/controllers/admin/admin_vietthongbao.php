<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/admin/admin_model.php';

if( isset($_POST['post'])){
  if( ( $_POST['content'] != "") && ( $_POST['brief'] != "") && ( $_POST['title'] != "") ){
    $admin_obj = new Admin();
    

    if( $_FILES['file_attack']['name'] != NULL){
      $path = $_SESSION['BASE_PATH'].'/etc/file/';
      $tmp_name = $_FILES['file_attack']['tmp_name'];
      $name = $_FILES['file_attack']['name'];

      move_uploaded_file( $tmp_name, $path.$name);
      $admin_obj->post_idadmin_idcategory_title_brief_header_content_file( $_SESSION['admin_id'], $_POST['select_category'], $_POST['title'], $_POST['brief'], $_POST['header'], $_POST['content'], $name);
    } else {
      $name = "";
      $admin_obj->post_idadmin_idcategory_title_brief_header_content_file( $_SESSION['admin_id'], $_POST['select_category'], $_POST['title'], $_POST['brief'], $_POST['header'], $_POST['content'], $name);
    }    
    $sucess_post= 'Đăng bài thành công!';
  } else {
    $error_post = 'Bài đăng không hợp lệ!';
  }
}

include $_SESSION['BASE_PATH'].'/views/admin/admin_vietthongbao.html';

?>