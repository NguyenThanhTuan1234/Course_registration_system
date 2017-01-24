<?php
session_start();
include_once $_SESSION['BASE_PATH'].'/models/user/user_model.php';

if( isset($_SESSION['username']) ){
  header( "Location:".$_SESSION['BASE_PATH']."/controllers/user/user_loginsucess.php");
} else {
  
  if( isset( $_POST['submit'] ) ) {
    if( $_POST['username'] != '' && $_POST['password'] != ''){
      $model_user = new User;
      $r = mysqli_num_rows( $model_user->get_info_user_by_username(($_POST['username'])));
      if( $r != 0){
        $row = mysqli_fetch_assoc( $model_user->get_info_user_by_username($_POST['username']) );
        if( $row['password'] == $_POST['password']){
          $_SESSION['username'] = $row['username'];
          $_SESSION['password'] = $row['password'];
          $_SESSION['fullname'] = $row['fullname'];
          header("Location:".$_SESSION['BASE_URL']."/controllers/user/user_loginsucess.php");
        } else {
          $error_login = "Mật khẩu không đúng!";
          include_once $_SESSION['BASE_PATH']."/views/user/login.html";
        }
      } else {
        $error_login = "Tài khoản không hợp lệ!";
        include_once $_SESSION['BASE_PATH']."/views/user/login.html";
      }
    } else {
      $error_login = "Bạn hãy nhập tài khoản và mật khẩu!";
      include_once $_SESSION['BASE_PATH']."/views/user/login.html";
    }
  } else {
    include_once $_SESSION['BASE_PATH']."/views/user/login.html";
  }
}
?>