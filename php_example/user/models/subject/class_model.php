<?php
include_once $_SESSION['BASE_PATH'].'/models/connect_to_database_server.php';

class Class_Obj{
  public function get_list_class_by_id ( $id){
    global $conn;
  $query = "select LopHP.MaLopHP as id_class, HocPhan.MaHP as id_subject, TenHP as name_subject, HocKy as semester, GhiChu as note, LopHP.TrangThai as status, DangKymin as min_sign, DangKymax as max_sign, count(LopHPDK.MSSV) as signed, TenKhoa as course, GhiChuGiaoVien as content
  from LopHP natural join HocPhan natural join KhoaVien left join LopHPDK on LopHPDK.MaLopHP = LopHP.MaLopHP
  where LopHP.MaLopHP = '".$id."' and LopHP.TrangThai = 'Mở đăng kí'
  group by LopHPDK.MaLopHP, LopHP.MaLopHP, HocPhan.MaHP, TenHP, GhiChu, LopHP.TrangThai, TenKhoa ;";
  return mysqli_query ($conn,$query);
         }
  public function get_list_class_by_id_fake( $id){
            global $conn;
           $query = "select lophp.Malophp as id_class, hocphan.MaHP as id_subject, TenHP as name_subject, HocKy as semester, GhiChu as note, lophp.TrangThai as status, DangKymin as min_sign, DangKymax as max_sign, count(lophpdk.MSSV) as signed, TenKhoa as course
					 from lophp natural join hocphan natural join khoavien, lophpdk
					 where lophpdk.Malophp = lophp.Malophp and lophpdk.TrangThai = 'Thành Công' and  lophp.Malophp = '".$id."'
					 group by lophpdk.Malophp, lophp.Malophp, hocphan.MaHP, TenHP, GhiChu, lophp.TrangThai, TenKhoa ;;";
           return mysqli_query( $conn,$query);
         }
  public function get_list_class_by_id_subject_semester ( $id_subject, $semester){
    global $conn;
  $query = "select LopHP.MaLopHP as id_class, HocPhan.MaHP as id_subject, TenHP as name_subject, GhiChu as note, LopHP.TrangThai as status, DangKymin as min_sign, DangKymax as max_sign, count(LopHPDK.MSSV) as signed, TenKhoa as course
  from LopHP natural join HocPhan natural join KhoaVien left join LopHPDK on LopHPDK.MaLopHP = LopHP.MaLopHP
  where LopHP.MaHP = '".$id_subject."' and HocKy = '".$semester."' and LopHP.TrangThai = 'Mở đăng kí'
  group by LopHPDK.MaLopHP, LopHP.MaLopHP, HocPhan.MaHP, TenHP, GhiChu, LopHP.TrangThai, TenKhoa  ;";
  return mysqli_query( $conn,$query);
         }
  public function get_list_class_by_course_semester ( $course, $semester){
    global $conn;
  $query = "select LopHP.MaLopHP as id_class, HocPhan.MaHP as id_subject, TenHP as name_subject, GhiChu as note, LopHP.TrangThai as status, DangKymin as min_sign, DangKymax as max_sign, count(LopHPDK.MSSV) as signed, TenKhoa as course
  from LopHP natural join HocPhan natural join KhoaVien left join LopHPDK on LopHPDK.MaLopHP = LopHP.MaLopHP
  where TenKhoa = '".$course."' and HocKy = '".$semester."' and LopHP.TrangThai = 'Mở đăng kí'
  group by LopHPDK.MaLopHP, LopHP.MaLopHP, HocPhan.MaHP, TenHP, GhiChu, LopHP.TrangThai, TenKhoa ;";
  return mysqli_query( $conn,$query);
         }
  public function get_time_class_by_id ( $id){
            global $conn;
           $query = "select NgayHoc as day_of_week, GioHoc as clock, TuanHoc as week, PhongHoc as place
					 from thoigianhoc natural join lophp
					 where lophp.Malophp = '".$id."'
					 order by NgayHoc asc ;";
           return mysqli_query($conn,$query);
         }
  public function get_time_table_class_register_by_username_semester( $username, $semester){
            global $conn;
           $query = "select NgayHoc as day_of_week, GioHoc as clock, TuanHoc as week, PhongHoc as place, MaHP as id_subject, lophp.Malophp as id_class
					 from thoigianhoc natural join lophp left join LopHPDK on LopHPDK.MaLopHP = LopHP.MaLopHP
					 where MSSV ='".$username."' and HocKy = '".$semester."'
					 order by NgayHoc asc ;";
           return mysqli_query($conn,$query);
         }
  public function get_list_student_by_id_class($id){
            global $conn;
           $query = "select MSSV as username
					 from lophpdk
					 where Malophp = '".$id."' ; ";
           return mysqli_query( $conn,$query);
         }
  public function get_point_by_username_id_class( $user, $id_class){
            global $conn;
           $query = "select DiemQT as midle_point, DiemCK as end_point
					 from ketqua
					 where MSSV = '".$user."' and Malophp = '".$id_class."' ;";
           return mysqli_query( $conn,$query);
         }
  public function change_status_of_class_by_id_class_status( $id_class, $status ){
                    global $conn;
		   $query = "update lophp
					 set TrangThai = '".$status."'
					 where Malophp = '".$id_class."' ;";
           return mysqli_query($conn, $query);
  }
  public function print_if_username_study_on_class_by_username_idclass( $username, $idclass){
        global $conn;
	$query = "select *
			  from lophpdk JOIN ketqua
			  where lophpdk.MSSV = '".$username."' and ketqua.Malophp='".$idclass."' and TrangThai = 'Thành Công' ; ";
	return mysqli_query( $conn,$query);
  }
  public function get_semester_by_id_class( $idclass ){
        global $conn;
	$query = "";
	return mysqli_query($conn, $query);
  }
 
}

?>
