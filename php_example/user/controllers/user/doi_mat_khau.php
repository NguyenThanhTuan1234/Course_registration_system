<?php
session_start();
include_once $_SESSION['BASE_PATH']."/models/user/user_model.php";

if ( isset ($_POST['changepassword']) )
{
  if ( $_SESSION['password'] == $_POST['oldpassword']){
    if (!preg_match("/^[0-9a-zA-Z]{4,16}$/",$_POST['newpassword'])) {
      $error_changepassword = "Mật khẩu mới phải gồm 4 đến 16 ký tự, chỉ được sử dụng chữ cái và số";
      include_once $_SESSION['BASE_PATH']."/views/user/doi_mat_khau.html";
    }
    else if( $_POST['newpassword'] == $_POST['confirmnewpassword'] ){
      $model_user = new User;
      $model_user->changepassword_user($_SESSION['username'], ($_POST['newpassword']));
      $row = mysqli_fetch_assoc( $model_user->get_info_user_by_username($_SESSION['username']) );
      if ( $row['password'] == $_POST['newpassword'] ){
        $_SESSION['password'] = $row['password'];
        $sucess_changepassword = "Bạn đã thay đổi mật khẩu thành công!";
        include_once $_SESSION['BASE_PATH']."/views/user/doi_mat_khau.html";
      } else {
        $error_changepassword = "Có lỗi khi đổi mật khẩu của bạn, hãy thử lại!";
        include_once $_SESSION['BASE_PATH']."/views/user/doi_mat_khau.html";
      }
    } else {
      $error_changepassword = "Hai mật khẩu mới không giống nhau!";
      include_once $_SESSION['BASE_PATH']."/views/user/doi_mat_khau.html";
    }
  } else {
    $error_changepassword = "Mật khẩu cũ không đúng!";
    include_once $_SESSION['BASE_PATH']."/views/user/doi_mat_khau.html";
  }
} else {
  include_once $_SESSION['BASE_PATH']."/views/user/doi_mat_khau.html";
}

?>