<?php
include $_SESSION['BASE_PATH']."/models/connect_to_database_server.php";

class Point{

  public function get_trongso_by_id_subject($id_subject){
            global $conn;
           $query = "select Trongso
			  from HocPhan
			  where MaHP = '".$id_subject."'; ";
           return mysqli_query( $conn,$query);
         }
  public function view_cpa_point_by_username_semester( $username, $semester){
      global $conn;
      $query = " select sum(ThangDiem4 * Sotinchi)/sum(Sotinchi) as cpa
				   from  KetQua JOIN LopHP JOIN HocPhan
				   where KetQua.MSSV = '".$username."' and HocKy <= '".$semester."';";
           return mysqli_query(  $conn,$query);
         }
  public function view_gpa_point_by_username_semester( $username, $semester){
            global $conn;
           $query = " select sum(ThangDiem4 * Sotinchi)/sum(Sotinchi) as gpa
				   from KetQua JOIN LopHP JOIN HocPhan
				   where MSSV='".$username."' and HocKy='".$semester."';";
           return mysqli_query(  $conn,$query);
         }
  public function view_tc_dangky_by_username_semester( $username, $semester){
            global $conn;
           $query = " select sum(Sotinchi) as tcdangky
				   from ( select distinct HocPhan.MaHP, Sotinchi
						  from LopHPDK ,LopHP JOIN HocPhan
						  where LopHPDK.MaLopHP=LopHP.MaLopHP and LopHPDK.TrangThai='Thành Công' and MSSV = '".$username."' and HocKy <= '".$semester."') as TCdangky ; ";
           return mysqli_query( $conn, $query);
         }
  public function view_tc_tichluy_by_username_semester( $username, $semester){
            global $conn;
           $query = " select sum(Sotinchi) as tctichluy
				   from (select distinct HocPhan.MaHP, Sotinchi
						 from LopHPDK ,KetQua JOIN LopHP JOIN HocPhan
						 where LopHPDK.MaLopHP=LopHP.MaLopHP and LopHPDK.TrangThai='Thành Công' and KetQua.ThangDiem4 > '0' and KetQua.MSSV = '".$username."' and HocKy <= '".$semester."') as TCtichluy ;";
           return mysqli_query( $conn, $query);
         }
  public function display_if_have_info_about_point( $username, $id_class){
            global $conn;
           $query = " select *
				   from KetQua
				   where MSSV = '".$username."' and MaLopHP = '".$id_class."' ;";
           return mysqli_query(  $conn,$query);
         }
  public function display_if_have_info_about_CPA_GPA( $username, $semester){
            global $conn;
           $query = " select *
				   from TichLuy
				   where MSSV = '".$username."' and HocKy = '".$semester."' ;";
           return mysqli_query( $conn,$query);
         }


}


?>