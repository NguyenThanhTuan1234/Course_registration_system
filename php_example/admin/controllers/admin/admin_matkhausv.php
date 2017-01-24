<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/user/user_model.php';
include $_SESSION['BASE_PATH'].'/models/admin/admin_model.php';

if ( isset( $_POST['find_student']) ){
  if( $_POST['username_student'] == ""){
    $error_find_student = "Bạn hãy nhập mã số của sinh viên cần tìm vào!";
  } else {
    $student_obj = new User();
    $username=($_POST['username_student']);
    $student_get = $student_obj->get_info_user_by_username( $username);
    if ( mysqli_num_rows ( $student_get) ){
      $student = mysqli_fetch_assoc( $student_get );
    } else {
      $error_find_student = 'Không tìm thấy sinh viên có mã số: '.$username.' trong cơ sở dữ liệu!';
    }
  }
}

if ( isset( $_POST['set_password']) ){
  if ( $_POST['username'] != "" ){
    $admin_obj = new Admin();
    if( $_POST['new_password'] != ""){
      $user=($_POST['username']);
      $password=($_POST['new_password']);
    $admin_obj->set_password_username_password( $user, $password);
    $student_obj = new User();
    $student_get = $student_obj->get_info_user_by_username( $user);
    $student = mysqli_fetch_assoc ( $student_get);
    if( $student['password'] == $password){
      $set_password_success = 'Đã đặt lại mật khẩu cho sinh viên '.$student['fullname'].' có mã số '.$student['username'];
    } else {
      $error_set_password = 'Có lỗi trong quá trình đặt mật khẩu cho sinh viên!<br />Đề nghị bạn kiểm tra lại tình trạng hệ thống!';
    }
    } else {
      $error_set_password = 'Bạn chưa nhập mật khẩu mới cho sinh viên!';
    }
  } else {
    $error_set_password = "Bạn hãy tìm sinh viên trước!";
  }
}

include $_SESSION['BASE_PATH'].'/views/admin/admin_matkhausv.html';
?>