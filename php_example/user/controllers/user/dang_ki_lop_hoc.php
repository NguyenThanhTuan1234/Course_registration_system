<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/subject/class_model.php';
include_once $_SESSION['BASE_PATH'].'/models/etc/get_list_of_select_tag_model.php';
include_once $_SESSION['BASE_PATH'].'/models/user/user_model.php';
include_once $_SESSION['BASE_PATH'].'/models/etc/etc_model.php';

$error_class = "";

$list_obj = new GetList();
$list_of_semester = $list_obj->get_list_of_semester();
$list_of_course = $list_obj->get_list_of_course();

$register_class_obj = new User();
$class_obj = new Class_Obj();

$etc_obj = new Etc();

$selected_semester= $etc_obj->max_hocki();

$sum_credits_subject_by_semester = $register_class_obj->get_sum_credits_subject_by_semester_username( $selected_semester, $_SESSION['username']);
$result_register_class_obj = $register_class_obj->get_list_register_class_by_username_semester( $_SESSION['username'], $selected_semester);

function check_register($register) {
  $error_class = "";
  $class_check = new Class_Obj();
  $number_of_overlap_class = 0;
  $comparing_class = $class_check->get_time_class_by_id($register);
  while ( $row_of_comparing_class = mysqli_fetch_assoc ( $comparing_class)){
    $comparing_sweek = substr($row_of_comparing_class['week'],0,1);
    $comparing_eweek = substr($row_of_comparing_class['week'],4,2);
    $comparing_day = $row_of_comparing_class['day_of_week'];
    $comparing_sclock = substr($row_of_comparing_class['clock'],0,5);
    $comparing_eclock = substr($row_of_comparing_class['clock'],8,5);
    $compare_with_class = $class_check->get_time_table_class_register_by_username_semester($_SESSION['username'], $_SESSION['selected_semester']);
    while ( $row_of_compare_with_class = mysqli_fetch_assoc ( $compare_with_class)){
      $compare_with_sweek = substr($row_of_compare_with_class['week'],0,1);
      $compare_with_eweek = substr($row_of_compare_with_class['week'],4,2);
      $compare_with_day = $row_of_compare_with_class['day_of_week'];
      $compare_with_sclock = substr($row_of_compare_with_class['clock'],0,5);
      $compare_with_eclock = substr($row_of_compare_with_class['clock'],8,5);
      if(strcmp($comparing_eweek, $compare_with_sweek) >= 0 and strcmp($comparing_sweek, $compare_with_eweek) <= 0) {
        if(strcmp($comparing_day, $compare_with_day) == 0) {
          if (strcmp($comparing_sclock, $compare_with_eclock) <= 0 and strcmp($comparing_eclock, $compare_with_sclock) >= 0) {
            $number_of_overlap_class += 1;
            if($number_of_overlap_class > 1) {
              $error_class = $error_class . ", " . $row_of_compare_with_class['id_class'];
            }
            else {
              $error_class = $row_of_compare_with_class['id_class'];
            }
          }
        }
      }
    }
  }
  mysqli_free_result($comparing_class);
  mysqli_free_result($compare_with_class);
  if($number_of_overlap_class == 0) {
    $registering_class = $class_check->get_list_class_by_id($register);
    $row_of_registering_class = mysqli_fetch_assoc($registering_class);
    if($row_of_registering_class['signed'] < $row_of_registering_class['max_sign']) {
      $register_class_check = new User();
      $register_class_check->register_class_by_username_id_class($_SESSION['username'], $register);
    }
    else {
    $error_class = "Lớp đã hết chỗ.";
    }
  }
  else {
    $error_class = "Trùng thời gian với lớp: " . $error_class;
  }
  return $error_class;
}

if( isset($_POST['find_register_class']) || isset($_POST['submit_register']) || isset($_POST['register_class']) || isset( $_POST['unregister_class'])){

  if ( isset($_POST['find_register_class']) ){
      $_SESSION['selected_semester'] = $_POST['semester_select'];
      $_SESSION['selected_course'] = $_POST['course_select'];
      $_SESSION['id_class'] = ($_POST['id_class']);
      $_SESSION['id_subject'] = ($_POST['id_subject']);

  }

  if(isset($_POST['register_class'])){
    $register = $_POST['register_class'];
    $error_class = check_register($register);
  }

  if ( isset($_POST['unregister_class']) && isset($_POST['un_register_class'])){
    foreach($_POST['un_register_class'] as $un_register_id_class){
      $register_class_obj->unregister_class_by_username_id_class($_SESSION['username'], $un_register_id_class);
    }
  }

  if (isset($_POST['submit_register']) ){
    $register_class_obj->submit_register_class_by_username($_SESSION['username']);
  }

  $selected_semester = $_SESSION['selected_semester'];
  $selected_course = $_SESSION['selected_course'];
  $id_class = $_SESSION['id_class'];
  $id_subject = $_SESSION['id_subject'];
  $result_register_class_obj = $register_class_obj->get_list_register_class_by_username_semester( $_SESSION['username'], $selected_semester);
  $sum_credits_subject_by_semester = $register_class_obj->get_sum_credits_subject_by_semester_username( $selected_semester, $_SESSION['username']);

  if ( ( $id_class != "") || ( ($id_subject != "") || ( $selected_course != "default") ) && ( $selected_semester != "default") ){

    if ( $id_class != "" ){
      $last_id_class = $id_class;
      $list_class = $class_obj->get_list_class_by_id( $id_class );
      $result_time_table_class_register = $class_obj->get_time_table_class_register_by_username_semester($_SESSION['username'], $selected_semester);
      include $_SESSION['BASE_PATH'].'/views/user/dang_ki_lop_hoc.html';
      mysqli_free_result($result_time_table_class_register);
      mysqli_free_result($list_class);
    } else {
      if(( $selected_semester != "default") && ($id_subject != "")){
        $last_id_subject = $id_subject;
        $list_class = $class_obj->get_list_class_by_id_subject_semester( $id_subject, $selected_semester);
        $result_time_table_class_register = $class_obj->get_time_table_class_register_by_username_semester($_SESSION['username'], $selected_semester);
        include $_SESSION['BASE_PATH'].'/views/user/dang_ki_lop_hoc.html';
        mysqli_free_result($result_time_table_class_register);
        mysqli_free_result($list_class);
      } else {
        $list_class = $class_obj->get_list_class_by_course_semester( $selected_course, $selected_semester);
        $result_time_table_class_register = $class_obj->get_time_table_class_register_by_username_semester($_SESSION['username'], $selected_semester);
        include $_SESSION['BASE_PATH'].'/views/user/dang_ki_lop_hoc.html';
        mysqli_free_result($result_time_table_class_register);
        mysqli_free_result($list_class);
      }
    }

  } else {
    $result_time_table_class_register = $class_obj->get_time_table_class_register_by_username_semester($_SESSION['username'], $selected_semester);
    include $_SESSION['BASE_PATH'].'/views/user/dang_ki_lop_hoc.html';
    mysqli_free_result($result_time_table_class_register);
  }
  mysqli_free_result($result_register_class_obj);

} else {
  $result_time_table_class_register = $class_obj->get_time_table_class_register_by_username_semester($_SESSION['username'], $selected_semester);
  include $_SESSION['BASE_PATH'].'/views/user/dang_ki_lop_hoc.html';
  mysqli_free_result($result_time_table_class_register);
  }

mysqli_free_result($list_of_semester);
mysqli_free_result($list_of_course);


?>
