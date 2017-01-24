<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/subject/class_model.php';
include $_SESSION['BASE_PATH'].'/models/user/user_model.php';
include $_SESSION['BASE_PATH'].'/models/etc/etc_model.php';
include $_SESSION['BASE_PATH'].'/models/point/point_model.php';
include $_SESSION['BASE_PATH'].'/models/admin/admin_model.php';

$class_obj = new Class_Obj();
$user_obj = new User();
$etc_obj = new Etc();

if ( isset ($_POST['find_class'])){
  if( $_POST['id_class'] != ""){
    $id_class=($_POST['id_class']);
    $find_class_by_id = $class_obj->get_list_class_by_id( $id_class);
    if ( mysqli_num_rows($find_class_by_id) ){
      $class = mysqli_fetch_assoc( $find_class_by_id );
      $list_student = $class_obj->get_list_student_by_id_class( $class['id_class']);
      $_SESSION['idclass_tmp'] = $_POST['id_class'];
    } else {
      $error_find_class = "Không tìm thấy lớp có id là ".$_POST['id_class'];
    }
  } else {
    $error_find_class = "Bạn hãy nhập vào mã lớp cần tìm";
  }
}

if ( isset ($_POST['commit_point'])){

  if( $_POST['commit_point'] == ""){
    $error_comit_point = 'Bạn phải tìm lớp trước!';
  } else {
    $find_class_by_id = $class_obj->get_list_class_by_id( $_POST['commit_point'] );
    $class = mysqli_fetch_assoc( $find_class_by_id );
    $list_student = $class_obj->get_list_student_by_id_class( $class['id_class']);

    while( $row_list_student = mysqli_fetch_assoc($list_student)){
      $temp_username = $row_list_student['username'];
      if( isset( $_POST['midle'.$temp_username])){
        if( $_POST['midle'.$temp_username] == "" || $_POST['midle'.$temp_username] == "0"){
          $midle_point = 1;
        } else {
        $midle_point = $_POST['midle'.$temp_username];
        }
      } else {
        $midle_point = 1;
      }
      
      if( isset( $_POST['end'.$temp_username])){
        if( $_POST['end'.$temp_username] == "" || $_POST['end'.$temp_username] == "0"){
          $end_point = 1;
        } else {
        $end_point = $_POST['end'.$temp_username];
        }
      } else {
        $end_point = 1;
      }

		$point_obj = new Point();
		$class_obj = new Class_Obj();
		$get_id_subject = $class_obj->get_list_class_by_id($_SESSION['idclass_tmp']);
		$id_subject = mysqli_fetch_assoc( $get_id_subject);
		$get_trongso = $point_obj->get_trongso_by_id_subject( $id_subject['id_subject'] );
		$trongso = mysqli_fetch_assoc($get_trongso)['Trongso'];
		$tb_point = $midle_point * ( 1 - $trongso) + $end_point * $trongso;
		if( $tb_point < 4){
			$thang4 = 0;
			$diemchu = 'F';
		}
		if( $tb_point >= 4 && $tb_point <5 ){
			$thang4 = 1;
			$diemchu = 'D';		
		}
		if( $tb_point >= 5 && $tb_point < 5.5 ){
			$thang4 = 1.5;
			$diemchu = 'D+';		
		}
		if( $tb_point >= 5.5 && $tb_point < 6.5 ){
			$thang4 = 2;
			$diemchu = 'C';		
		}
		if( $tb_point >= 6.5 && $tb_point < 7 ){
			$thang4 = 2.5;
			$diemchu = 'C+';		
		}
		if( $tb_point >= 7 && $tb_point < 8 ){
			$thang4 = 3;
			$diemchu = 'B';		
		}
		if( $tb_point >= 8 && $tb_point < 8.5 ){
			$thang4 = 3.5;
			$diemchu = 'B+';		
		}
		if( $tb_point >= 8.5 && $tb_point < 9.5 ){
			$thang4 = 4;
			$diemchu = 'A';		
		}
		if( $tb_point >= 9.5 && $tb_point <= 10 ){
			$thang4 = 4;
			$diemchu = 'A+';		
		}
		$admin_obj = new Admin();

        $point_by_username_id_class = $class_obj->get_point_by_username_id_class( $temp_username, $_SESSION['idclass_tmp']);
      if( mysqli_num_rows($point_by_username_id_class)){
        $admin_obj->update_point_of_student( $temp_username, $_SESSION['idclass_tmp'], $midle_point, $end_point, $tb_point, $diemchu, $thang4 );
      } else {
        $admin_obj->write_point_of_student( $temp_username, $_SESSION['idclass_tmp'], $midle_point, $end_point, $tb_point, $diemchu, $thang4 );
      }
    }
    $sucess_comit_point= "Đã cập nhật điểm cho lớp ".$_SESSION['idclass_tmp'];
    unset( $_SESSION['idclass_tmp'] );
    unset( $class );
  }
}

include $_SESSION['BASE_PATH'].'/views/admin/admin_diemlophoc.html';

?>