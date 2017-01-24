<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/subject/class_model.php';
include_once $_SESSION['BASE_PATH'].'/models/etc/get_list_of_select_tag_model.php';

$list_obj = new GetList();
$list_of_semester = $list_obj->get_list_of_semester();
$list_of_course = $list_obj->get_list_of_course();

if (isset ($_POST['find'])){

  $selected_semester = $_POST['semester_select'];
  $selected_course = $_POST['course_select'];
  
  if ( ( $_POST['id_class'] != "") || ( ($_POST['id_subject'] != "") || ( $_POST['course_select'] != "default") ) && ( $_POST['semester_select'] != "default") ){
    
    if ( $_POST['id_class'] != "" ){
      $class_obj = new Class_Obj();
      $list_class = $class_obj->get_list_class_by_id( ($_POST['id_class']) );
      include $_SESSION['BASE_PATH'].'/views/user/danh_sach_lop_hoc.html';
      mysqli_free_result($list_class);
    } else {
      if(( $_POST['course_select'] != "default") && ($_POST['id_subject'] != "")){
        $class_obj = new Class_Obj();
        $list_class = $class_obj->get_list_class_by_id_subject_semester( ($_POST['id_subject']), $_POST['semester_select']);
		echo "Tim lop bang ma hoc phan va ki hoc";
        include $_SESSION['BASE_PATH'].'/views/user/danh_sach_lop_hoc.html';
        mysqli_free_result($list_class);       
      } else {
        $class_obj = new Class_Obj();
        $list_class = $class_obj->get_list_class_by_course_semester( $_POST['course_select'], $_POST['semester_select']);
        include $_SESSION['BASE_PATH'].'/views/user/danh_sach_lop_hoc.html';
        mysqli_free_result($list_class);
      }
    }
    
  } else {
    include $_SESSION['BASE_PATH'].'/views/user/danh_sach_lop_hoc.html';
  }
} else {
  include $_SESSION['BASE_PATH'].'/views/user/danh_sach_lop_hoc.html';
}

mysqli_free_result($list_of_semester);
mysqli_free_result($list_of_course);

?>