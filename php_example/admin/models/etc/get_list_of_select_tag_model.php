<?php
include_once $_SESSION['BASE_PATH'].'/models/connect_to_database_server.php';

class GetList{
  public function get_list_of_course(){
            global $conn;
           $query = "select TenKhoa as course 
					 from khoavien ;";
           return mysqli_query($conn,$query);
         }
  public function get_list_of_semester(){
            global $conn;
           $query = "select distinct HocKy as semester 
					 from lophp
					 order by HocKy desc;";
           return mysqli_query($conn,$query);
         }
  public function get_list_of_khoa_sinhvien(){
            global $conn;
           $query = "select distinct KhoaHoc as khoa_hoc 
					 from sinhvien
					 order by KhoaHoc desc ;";
           return mysqli_query($conn,$query);
         }
   public function get_list_lop_by_course_khoa_sinhvien( $course, $khoa_sinhvien){
            global $conn;
           if ( ($course != "*") && ($khoa_sinhvien != "*") ){
             $query ="select MaLopSV as id , TenLopSV as class
					  from lopsv JOIN khoavien
					  where TenKhoa = '".$course."' and KhoaHoc = '".$khoa_sinhvien."' ;";
           } else {
             if ( $course != "*"){
               $query ="select MaLopSV as id , TenLopSV as class
						from lopsv JOIN khoavien 
						where TenKhoa = '".$course."' ;";
             } else {
               if( $khoa_sinhvien != "*"){
                 $query ="select MaLopSV as id , TenLopSV as class
						  from lopsv JOIN khoavien 
						  where KhoaHoc = '".$khoa_sinhvien."' ;";
               } else {
                 $query ="select MaLopSV as id , TenLopSV as class
						  from lopsv ;";
               }
             }
           }
           return mysqli_query($conn,$query);
         }
  
}

?>