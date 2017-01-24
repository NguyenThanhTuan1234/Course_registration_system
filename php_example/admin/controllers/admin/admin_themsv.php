<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/user/user_model.php';
include $_SESSION['BASE_PATH'].'/models/admin/admin_model.php';
include_once $_SESSION['BASE_PATH'].'/models/etc/get_list_of_select_tag_model.php';

$list_obj = new GetList();
$list_of_khoa_sinhvien = $list_obj->get_list_of_khoa_sinhvien();
$list_of_course = $list_obj->get_list_of_course();

if( isset($_POST['add_student']) ){
  $selected_sinhvien_khoa = $_POST['school_course'];
  $selected_course = $_POST['course'];

  if( ($_POST['username_student'] != "") && ( $_POST['fullname_student'] != "") && ( $_POST['birth_day_of_student'] != "") && ( $_POST['native_land_of_student'] != "" ) ){
    $admin_obj = new Admin();
    $user_obj = new User();
    $username=($_POST['username_student']);
    if ( !mysqli_num_rows($user_obj->get_info_user_by_username( $username)) ){
    $admin_obj->add_student_with_info( $username, ($_POST['fullname_student']), ($_POST['birth_day_of_student']), ($_POST['sex_of_student']), ($_POST['native_land_of_student']), ($_POST['school_course']), ($_POST['course']), ($_POST['class']), ($_POST['course_type']));
    if ( mysqli_num_rows($user_obj->get_info_user_by_username( $username)) ){
      $add_student_success = "Đã thêm sinh viên mới!";
    } else {
      $error_add_student = "Có lỗi phát sinh trong quá trình kết nối cơ sở dữ liệu. Đề nghị bạn dừng công việc lại và kiểm tra hệ thống!";
    }
    } else {
      $error_add_student= "Lỗi: Trùng ID sinh viên. Xin bạn xem xét thật cẩn thận lại!";
    }
  } else {
    $error_add_student = "Bạn cần nhập đầy đủ các thông tin của sinh viên. Xin hãy nhập cẩn thận!";
  }
  include $_SESSION['BASE_PATH'].'/views/admin/admin_themsv.html';
} else {
  include $_SESSION['BASE_PATH'].'/views/admin/admin_themsv.html';
}
?>
