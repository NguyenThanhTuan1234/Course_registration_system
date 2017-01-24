<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/admin/admin_model.php';

if ( isset ($_POST['change_password']) )
{
  if ( ($_POST['new_password'] == "")  || ( $_POST['old_password'] == "") || ( $_POST['confirm_password'] == "") ){
    $error_changepassword = "Bạn hãy nhập đầy đủ các trường!";
  } else {
  if ( $_SESSION['password'] == $_POST['old_password']){
    if( $_POST['new_password'] == $_POST['confirm_password'] ){
      $admin_obj = new Admin();
      $password=($_POST['new_password']);
      $admin_obj->changepassword_admin($_SESSION['admin_id'], $password);
      $row = mysqli_fetch_assoc( $admin_obj->get_info_admin_by_admin_id($_SESSION['admin_id']) );
      if ( $row['password'] == $password ){
        $_SESSION['password'] = $row['password'];
        $sucess_changepassword = "Bạn đã thay đổi mật khẩu thành công!";
        include_once $_SESSION['BASE_PATH']."/views/admin/admin_doimatkhau.html";
      } else {
        $error_changepassword = "Có lỗi khi đổi mật khẩu của bạn, hãy thử lại!";
        include_once $_SESSION['BASE_PATH']."/views/admin/admin_doimatkhau.html";
      }
    } else {
      $error_changepassword = "Hai mật khẩu mới không giống nhau!";
      include_once $_SESSION['BASE_PATH']."/views/admin/admin_doimatkhau.html";
    }
  } else {
    $error_changepassword = "Mật khẩu cũ không đúng!";
    include_once $_SESSION['BASE_PATH']."/views/admin/admin_doimatkhau.html";
  }
  }
} else {
  include_once $_SESSION['BASE_PATH']."/views/admin/admin_doimatkhau.html";
}

?>