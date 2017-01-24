<?php
include_once $_SESSION['BASE_PATH'].'/models/connect_to_database_server.php';

class Subject{
  public function get_info_subject ($input) {
            global $conn;
           $query = "select MaHP as id_subject, TenHP as name_subject, Sotinchi as credits_subject, Trongso as weight_subject, TenKhoa as course 
					 from hocphan JOIN khoavien
					 where MaHP = '".$input."' or TenHP= '".$input."' or TenKhoa = '".$input."' ;";
           return mysqli_query($conn,$query);
         }
}

?>