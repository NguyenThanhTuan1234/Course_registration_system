<?php
include_once $_SESSION['BASE_PATH'].'/models/connect_to_database_server.php';

class GetList{
  public function get_list_of_course(){
           $query = "select \"TenKhoa\" as course 
					 from \"KhoaVien\" ;";
           return pg_query($query);
         }
  public function get_list_of_semester(){
           $query = "select distinct \"HocKy\" as semester 
					 from \"LopHP\"
					 order by \"HocKy\" desc;";
           return pg_query($query);
         }
  public function get_list_of_khoa_sinhvien(){
           $query = "select distinct \"KhoaHoc\" as khoa_hoc 
					 from \"SinhVien\"
					 order by \"KhoaHoc\" desc ;";
           return pg_query($query);
         }
  public function get_list_lop_by_course_khoa_sinhvien( $course, $khoa_sinhvien){
           if ( ($course != "*") && ($khoa_sinhvien != "*") ){
             $query ="select \"TenLopSV\" as lop 
					  from \"LopSV\" natural join \"KhoaVien\"
					  where \"TenKhoa\" = '".$course."' and \"KhoaHoc\" = '".$khoa_sinhvien."' ;";
           } else {
             if ( $course != "*"){
               $query ="select \"TenLopSV\" as lop  
						from \"LopSV\" natural join \"KhoaVien\" 
						where \"TenKhoa\" = '".$course."' ;";
             } else {
               if( $khoa_sinhvien != "*"){
                 $query ="select  \"TenLopSV\" as lop
						  from \"LopSV\" natural join \"KhoaVien\" 
						  where \"KhoaHoc\" = '".$khoa_sinhvien."' ;";
               } else {
                 $query ="select \"TenLopSV\" as lop
						  from \"LopSV\" ;";
               }
             }
           }
           return pg_query($query);
         }
  
}
?>