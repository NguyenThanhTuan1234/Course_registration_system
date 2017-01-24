<?php
include_once $_SESSION['BASE_PATH'].'/models/connect_to_database_server.php';

class Subject{
  public function get_info_subject ($input) {
            global $conn;
           $query = "select MaHP as id_subject, TenHP as name_subject, Sotinchi as credits_subject, Trongso as weight_subject, TenKhoa as course 
					 from HocPhan JOIN KhoaVien
					 where MaHP = '".$input."' or TenHP= '".$input."' or TenKhoa = '".$input."' ;";
           return mysqli_query($conn,$query);
         }
    public function get_info_subject_by_id ($id) {
         global $conn;
        $query = "select MaHP as id_subject, TenHP as name_subject, Sotinchi as credits_subject, Trongso as weight_subject, TenKhoa as course
					 from HocPhan JOIN KhoaVien
					 where MaHP = '".$id."';";
        return mysqli_query($conn,$query);
    }
}

?>