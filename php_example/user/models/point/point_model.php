<?php
include $_SESSION['BASE_PATH']."/models/connect_to_database_server.php";

class Point{

  public function get_trongso_by_id_subject($id_subject){
        global $conn;
        $query = "select Trongso
			  from hocphan
			  where  MaHP= '".$id_subject."'; ";
        return mysqli_query($conn,$query);
         }
  public function view_cpa_point_by_username_semester( $username, $semester){
            global $conn;
           $query = " select sum(ThangDiem4 * Sotinchi)/sum(Sotinchi) as cpa
				   from ViewMax, ketqua JOIN LopHP natural JOIN hocphan
				   where ViewMax.MaHP=LopHP.MaHP and ketqua.MSSV = '".$username."' and HocKy <= '".$semester."';";
           return mysqli_query($conn,$query);
         }
  public function view_gpa_point_by_username_semester( $username, $semester){
             global $conn;
           $query = " select sum(ThangDiem4* Sotinchi)/sum(Sotinchi) as gpa
				   from ketqua JOIN LopHP natural JOIN hocphan
				   where MSSV='".$username."' and HocKy='".$semester."';";
           return mysqli_query($conn,$query);
         }
  public function view_tc_dangky_by_username_semester( $username, $semester){
             global $conn;
           $query = " select sum(Sotinchi) as tcdangky
				   from ( select distinct hocphan.MaHP, Sotinchi
						  from lophpdk ,LopHP JOIN hocphan
						  where lophpdk.MaLopHP=LopHP.MaLopHP and lophpdk.TrangTha='Thành Công' and MSSV = '".$username."' and HocKy <= '".$semester."') as TCdangky ; ";
           return mysqli_query($conn,$query);
         }
  public function view_tc_tichluy_by_username_semester( $username, $semester){
            global $conn;
           $query = " select sum(Sotinchi) as tctichluy
				   from (select distinct hocphan.MaHP, Sotinchi
						 from lophpdk ,ketqua JOIN LopHP JOIN hocphan
						 where lophpdk.MaLopHP=LopHP.MaLopHP and lophpdk.TrangThai='Thành Công' and ketqua.ThangDiem4 > '0' and ketqua.MSSV = '".$username."' and HocKy <= '".$semester."') as TCtichluy ;";
           return mysqli_query($conn,$query);
         }
  public function display_if_have_info_about_point( $username, $id_class){
            global $conn;
           $query = " select *
				   from ketqua
				   where MSSV = '".$username."' and MaLopHP = '".$id_class."' ;";
           return mysqli_query($conn,$query);
         }
  public function display_if_have_info_about_CPA_GPA( $username, $semester){
            global $conn;
           $query = " select *
				   from tichluy
				   where MSSV = '".$username."' and HocKy = '".$semester."' ;";
           return mysqli_query($conn,$query);
         }


}


?>