<?php
session_start();
include_once $_SESSION['BASE_PATH'].'/models/admin/admin_model.php';

if( isset($_SESSION['admin_id']) ){
  header( "Location:".$_SESSION['BASE_URL']."/controllers/admin/admin_trangchu.php");
} else {

  if( isset( $_POST['login'] ) ) {
    if( $_POST['admin_id'] != '' && $_POST['password'] != ''){
      $admin_obj = new Admin();
      $id=($_POST['admin_id']);
      $password=($_POST['password']);
      $admin = $admin_obj->get_info_admin_by_admin_id($id);
      $r = mysqli_num_rows( $admin);
      if( $r != 0){
        $row = mysqli_fetch_assoc( $admin );
        if( $row['password'] == $password){
          $_SESSION['admin_id'] = $row['admin_id'];
          $_SESSION['password'] = $row['password'];
          $_SESSION['fullname'] = $row['fullname'];
          header("Location:".$_SESSION['BASE_URL']."/controllers/admin/admin_trangchu.php");
        } else {
          $error_login = "Mật khẩu không đúng!";
          include_once $_SESSION['BASE_PATH']."/views/admin/admin_login.html";
        }
      } else {
        $error_login = "Tài khoản không hợp lệ!";
        include_once $_SESSION['BASE_PATH']."/views/admin/admin_login.html";
      }
    } else {
      $error_login = "Bạn hãy nhập tài khoản và mật khẩu!";
      include_once $_SESSION['BASE_PATH']."/views/admin/admin_login.html";
    }
  } else {
    include_once $_SESSION['BASE_PATH']."/views/admin/admin_login.html";
  }
}
?>