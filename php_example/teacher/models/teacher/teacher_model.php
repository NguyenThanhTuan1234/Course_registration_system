<?php
include $_SESSION['BASE_PATH']."/models/connect_to_database_server.php";

class Teacher{
    public function get_info_teacher_by_teacher_id( $teacher_id ){
        global $conn;
        $query = "select * from giaovien
			where MSGV ='".$teacher_id."' ;";
        return mysqli_query($conn,$query);
    }
    public function changepassword_teacher ( $teacher_id, $newpassword ){
         global $conn;
        $query = "update giaovien set MatKhau = '$newpassword'
					 where MSGV = '$teacher_id';";
        return mysqli_query($conn,$query);
    }
    public function update_class_with_info( $class_id, $class_info){
        global $conn;
        $query = "update lophp  set GhiChuGiaoVien = '$class_info'
					 where MaLopHP = '".$class_id."' ;";
        return mysqli_query($conn, $query);
    }
    public function get_class_by_teacher_id( $teacher_id ){
         global $conn;
        $query = "select MaLopHP as id
					 from LopHP
					 where MSGV = '".$teacher_id."' ; ";
         return mysqli_query($conn,$query);
    }

}
?>