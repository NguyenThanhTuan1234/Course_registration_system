<?php
include_once $_SESSION['BASE_PATH'].'/models/connect_to_database_server.php';

class Subject{

  public function get_info_subject ($input) {
           $query = "select \"MaHP\" as id_subject, \"TenHP\" as name_subject, \"Sotinchi\" as credits_subject, \"Trongso\" as weight_subject, \"TenKhoa\" as course 
					 from \"HocPhan\" natural join \"KhoaVien\"
					 where \"MaHP\" = '".$input."' or \"TenHP\"= '".$input."' or \"TenKhoa\" = '".$input."' ;";
           return pg_query($query);
         }
    public function get_info_subject_by_id ($id) {
        $query = "select \"MaHP\" as id_subject, \"TenHP\" as name_subject, \"Sotinchi\" as credits_subject, \"Trongso\" as weight_subject, \"TenKhoa\" as course
					 from \"HocPhan\" natural join \"KhoaVien\"
					 where \"MaHP\" = '".$id."';";
        return pg_query($query);
    }
    
}

?>