<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/user/user_model.php';
include_once $_SESSION['BASE_PATH'].'/models/etc/get_list_of_select_tag_model.php';
include $_SESSION['BASE_PATH'].'/models/admin/admin_model.php';

$list_obj = new GetList();
$list_of_khoa_sinhvien = $list_obj->get_list_of_khoa_sinhvien();
$list_of_course = $list_obj->get_list_of_course();
$list_of_class;
if( isset($_POST['find_username']) ){
  if( $_POST['username_find'] != ""){
    $user_obj = new User();
    $username=($_POST['username_find']);
    $get_student = $user_obj->get_common_info_by_username( $username );
    if ($get_student){
      $student = mysqli_fetch_assoc( $get_student );
      $variable_student = '1';
      $list_of_class=$list_obj->get_list_lop_by_course_khoa_sinhvien($student['training_system'],$student['course']);
    } else {
      $error_find_username = "Không tìm thấy sinh viên có id là: ".$_POST['username_find'].'<br />';
    }
  }
}

if( isset($_POST['commit']) ){
  if( $_POST['username'] != ""  ){
  if( ( $_POST['fullname'] == "") || ( $_POST['student_birth'] == "" ) || ( $_POST['new_native_land'] == ""  ) ){
    $error_commit = "Thông tin mà bạn chỉnh sửa cho sinh viên không hợp lệ! Bạn hãy kiểm tra lại thật cẩn thận!";
  } else {
    $admin_obj = new Admin();
    $admin_obj->update_student_with_info(($_POST['username']), ($_POST['fullname']), ($_POST['student_birth']), ($_POST['sex_select']), ($_POST['new_native_land']), ($_POST['new_school_course']), ($_POST['system_training']), ($_POST['class_of_student']), ($_POST['course_type']));
	$update_student_success = "Cập nhật thành công thông tin!";
  }
  }
}

include $_SESSION['BASE_PATH'].'/views/admin/admin_suasv.html';
?>