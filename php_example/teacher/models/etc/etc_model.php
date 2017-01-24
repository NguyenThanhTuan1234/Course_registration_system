<?php
include_once $_SESSION['BASE_PATH'].'/models/connect_to_database_server.php';


class Etc{
  public function get_full_name_by_username( $username){
            global $conn;
           $query = "select HoTen as fullname 
					 from SinhVien 
					 where MSSV = '".$username."' ;";
           $result = mysqli_query($conn,$query);
           $r = mysqli_num_rows($result);
           if ( $r != 0) {
             $row= mysqli_fetch_assoc($result);
             mysqli_free_result($result);
             return $row['fullname'];
           } else {
             mysqli_free_result($result);
             return null;
           } 
         }
  public function max_hocki(){
           $query = "select distinct HocKy as semester 
					 from LopHP
					 order by HocKy desc;";
           $list_of_semester = mysqli_query($query);
           $semester = mysqli_fetch_assoc($list_of_semester);
           return $semester['semester'];
         }
}


?>