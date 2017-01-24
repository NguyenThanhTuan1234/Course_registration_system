<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/subject/class_model.php';
include_once $_SESSION['BASE_PATH'].'/models/etc/get_list_of_select_tag_model.php';
include_once $_SESSION['BASE_PATH'].'/models/user/user_model.php';
include_once $_SESSION['BASE_PATH'].'/models/etc/etc_model.php';

$list_obj = new GetList();
$list_of_semester = $list_obj->get_list_of_semester();
$list_of_course = $list_obj->get_list_of_course();

$register_class_obj = new User();
$class_obj = new Class_Obj();

$etc_obj = new Etc();

$selected_semester= $etc_obj->max_hocki();


if( isset($_POST['find_register_class']) || isset($_POST['submit'])){

  if ( isset($_POST['find_register_class']) ){
      $_SESSION['selected_semester'] = $_POST['semester_select'];
      $_SESSION['selected_course'] = $_POST['course_select'];
      $_SESSION['id_class'] = ($_POST['id_class']);
      $_SESSION['id_subject'] = ($_POST['id_subject']);
            
  }

  $selected_semester = $_SESSION['selected_semester'];
  $selected_course = $_SESSION['selected_course'];
  $id_class = $_SESSION['id_class'];
  $id_subject = $_SESSION['id_subject'];

  if ( ( $id_class != "") || ( ($id_subject != "") || ( $selected_course != "default") ) && ( $selected_semester != "default") ){
    
    if ( $id_class != "" ){
      $last_id_class = $id_class;
      $list_class = $class_obj->get_list_class_by_id( $id_class );
      if(isset($_POST['submit'])){
          while ( $class =mysqli_fetch_assoc($list_class)) {
            $tmp_id = $class['id_class'];
            if( isset( $_POST[$tmp_id]) ){
              $class_obj = new Class_Obj();
              if( $_POST[$tmp_id] == "open" ){
                $stt = 'Mở đăng kí';
                $class_obj->change_status_of_class_by_id_class_status($tmp_id, $stt);
              } else {
                $stt = 'Đóng đăng kí';
                $class_obj->change_status_of_class_by_id_class_status($tmp_id, $stt);
              }
            }
          }
          $sucess = "Đã đặt trạng thái cho lớp";
        $list_class = $class_obj->get_list_class_by_id( $id_class );
      }
      include $_SESSION['BASE_PATH'].'/views/admin/admin_modongdangkylop.html';
      mysqli_free_result($list_class);
    } else {
      if(( $selected_semester != "default") && ($id_subject != "")){
        $last_id_subject = $id_subject;
        $list_class = $class_obj->get_list_class_by_id_subject_semester( $id_subject, $selected_semester);
        if( isset($_POST['submit'])){
          while ( $class =mysqli_fetch_assoc($list_class)) {
            $tmp_id = $class['id_class'];
            if( isset( $_POST[$tmp_id]) ){
              $class_obj = new Class_Obj();
              if( $_POST[$tmp_id] == "open" ){
                $stt = 'Mở đăng kí';
                $class_obj->change_status_of_class_by_id_class_status($tmp_id, $stt);
              } else {
                $stt = 'Đóng đăng kí';
                $class_obj->change_status_of_class_by_id_class_status($tmp_id, $stt);
              }
            }
          }
          $sucess = "Đã đặt trạng thái cho lớp";        
          $list_class = $class_obj->get_list_class_by_id_subject_semester( $id_subject, $selected_semester);
        }
        include $_SESSION['BASE_PATH'].'/views/admin/admin_modongdangkylop.html';
        mysqli_free_result($list_class);       
      } else {
        $list_class = $class_obj->get_list_class_by_course_semester( $selected_course, $selected_semester);
        if( isset($_POST['submit'])){
          while ( $class =mysqli_fetch_assoc($list_class)) {
            $tmp_id = $class['id_class'];
            if( isset( $_POST[$tmp_id]) ){
              $class_obj = new Class_Obj();
              if( $_POST[$tmp_id] == "open" ){
                $stt = 'Mở đăng kí';
                $class_obj->change_status_of_class_by_id_class_status($tmp_id, $stt);
              } else {
                $stt = 'Đóng đăng kí';
                $class_obj->change_status_of_class_by_id_class_status($tmp_id, $stt);
              }
            }
          }
          $sucess = "Đã đặt trạng thái cho lớp";
          $list_class = $class_obj->get_list_class_by_course_semester( $selected_course, $selected_semester);
        }
        include $_SESSION['BASE_PATH'].'/views/admin/admin_modongdangkylop.html';
        mysqli_free_result($list_class);
      }
    }
    
  } else {
    $error_find = 'Bạn hãy nhập các thông tin cần thiết để tìm lớp';
    include $_SESSION['BASE_PATH'].'/views/admin/admin_modongdangkylop.html';
  }
} else {
  if( isset($_SESSION['selected_semester']) && isset($_SESSION['selected_course']) && isset($_SESSION['id_class']) && isset($_SESSION['id_subject']) ){

  $selected_semester = $_SESSION['selected_semester'];
  $selected_course = $_SESSION['selected_course'];
  $id_class = $_SESSION['id_class'];
  $id_subject = $_SESSION['id_subject'];

  if ( ( $id_class != "") || ( ($id_subject != "") || ( $selected_course != "default") ) && ( $selected_semester != "default") ){
    
    if ( $id_class != "" ){
      $last_id_class = $id_class;
      $list_class = $class_obj->get_list_class_by_id( $id_class );
      include $_SESSION['BASE_PATH'].'/views/admin/admin_modongdangkylop.html';
      mysqli_free_result($list_class);
    } else {
      if(( $selected_semester != "default") && ($id_subject != "")){
        $last_id_subject = $id_subject;
        $list_class = $class_obj->get_list_class_by_id_subject_semester( $id_subject, $selected_semester);
        include $_SESSION['BASE_PATH'].'/views/admin/admin_modongdangkylop.html';
        mysqli_free_result($list_class);       
      } else {
        $list_class = $class_obj->get_list_class_by_course_semester( $selected_course, $selected_semester);
        include $_SESSION['BASE_PATH'].'/views/admin/admin_modongdangkylop.html';
        mysqli_free_result($list_class);
      }
    }
    
  } else {
    $error_find = 'Bạn hãy nhập các thông tin cần thiết để tìm lớp';
    include $_SESSION['BASE_PATH'].'/views/admin/admin_modongdangkylop.html';
  }    
    
  } else {
    include $_SESSION['BASE_PATH'].'/views/admin/admin_modongdangkylop.html';
  }
}

mysqli_free_result($list_of_semester);
mysqli_free_result($list_of_course);

?>