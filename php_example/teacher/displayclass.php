<?php


$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "php_project";
$string_connect_failed = "Cannot connect to database server! Please check your connection!";
$connect_database_server = mysqli_connect('localhost', 'root', '', 'php_project') 
                or die ($string_connect_failed);
        mysqli_set_charset($conn, 'UTF-8');

if( isset( $_GET['khoasv']) && isset ($_GET['course']) && isset( $_GET['as'] ) ){
  $course = $_GET['course'];
  $khoa_sinhvien = $_GET['khoasv'];
  if ( ($course != "*") && ($khoa_sinhvien != "*") ){
    $query ="select TenLopSV as lop, MaLopSV as id 
					  from LopSV natural join KhoaVien
					  where TenKhoa = '".$course."' and KhoaHoc = '".$khoa_sinhvien."' ;";
  } else {
    if ( $course != "*"){
      $query ="select TenLopSV as lop, MaLopSV as id	  
						from LopSV natural join KhoaVien 
						where TenKhoa = '".$course."' ;";
    } else {
      if( $khoa_sinhvien != "*"){
        $query ="select  TenLopSV as lop, MaLopSV as id
						  from LopSV natural join KhoaVien 
						  where KhoaHoc = '".$khoa_sinhvien."' ;";
      } else {
        $query ="select TenLopSV as lop, MaLopSV as id
						  from LopSV ;";
      }
    }
  }

  $list_lop_by_course_khoa_sinhvien = pg_query($query);

  if( pg_num_rows( $list_lop_by_course_khoa_sinhvien)){

    echo '<select name="'.$_GET['as'].'" class="form-control">';
    echo '<option value="default" >Chọn lớp</option>';
    while ( $row_list_of_lop = pg_fetch_array($list_lop_by_course_khoa_sinhvien) ){
      echo '<option value="'.$row_list_of_lop['id'].'" >'.$row_list_of_lop['lop'].'</option>';
    }
    echo '</select>';
  } else {
    echo '<select name="'.$_GET['as'].'" class="form-control">';
    echo '<option value="default" >Chọn lớp</option>';
    echo '</select>';
  }

  if( isset( $_GET['echo'])) {
  echo $_GET['echo'];
}
}
  ?>