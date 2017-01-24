<?php
include_once $_SESSION['BASE_PATH'].'/models/connect_to_database_server.php';

class Class_Obj{


    public function get_class_info_by_id ( $id){
        global $conn;
        $query = "select LopHP.MaLopHP as id_class, LopHP.MaHP as id_subject, LopHP.HocKy as semester, "
                . "LopHP.GhiChu as note, LopHP.TrangThai as status, LopHP.DangKymin as min_sign, LopHP.DangKymax as max_sign, LopHP.GhiChuGiaoVien as content, count(LopHPDK.MSSV) as signed "
                . "from lophp LEFT JOIN lophpdk on LopHP.MaLopHP = LopHPDK.MaLopHP "
                . "where LopHP.MaLopHP = '".$id."' "
                . "group by LopHP.MaLopHP";
        return mysqli_query($conn,$query);
    }
    public function get_class_full_info_by_id ( $id){
               global $conn;
        $query = "select LopHP.MaLopHP as class_id, LopHP.MaHP as class_course, LopHP.HocKy as class_semester, LopHP.GhiChu as class_note, LopHP.DangKymin as class_min, LopHP.DangKymax as class_max, LopHP.MSGV as class_teacher,ThoiGianHoc.NgayHoc as class_date, ThoiGianHoc.PhongHoc as class_room, ThoiGianHoc.TuanHoc as class_week, ThoiGianHoc.GioHoc as class_time
					 from LopHP left join ThoiGianHoc on LopHP.MaLopHP = ThoiGianHoc.MaLopHP
					 where LopHP.MaLopHP = '".$id."';";
        return mysqli_query ($conn,$query);
    }
  public function get_list_class_by_id ( $id){
                   global $conn;
           $query = "select LopHP.MaLopHP as id_class, HocPhan.MaHP as id_subject, TenHP as name_subject, HocKy as semester, GhiChu as note, LopHP.TrangThai as status, DangKymin as min_sign, DangKymax as max_sign, count(LopHPDK.MSSV) as signed, TenKhoa as course, GhiChuGiaoVien as content
					 from LopHP natural join HocPhan natural join KhoaVien, LopHPDK 
					 where LopHPDK.MaLopHP = LopHP.MaLopHP and LopHPDK.TrangThai = 'Thành Công' and  LopHP.MaLopHP = '".$id."'
					 group by LopHPDK.MaLopHP, LopHP.MaLopHP, HocPhan.MaHP, TenHP, GhiChu, LopHP.TrangThai, TenKhoa ;";
           return mysqli_query ($conn,$query);
         }
  public function get_list_class_by_id_fake( $id){
                   global $conn;
           $query = "select LopHP.MaLopHP as id_class, HocPhan.MaHP as id_subject, TenHP as name_subject, HocKy as semester, GhiChu as note, LopHP.TrangThai as status, DangKymin as min_sign, DangKymax as max_sign, count(LopHPDK.MSSV) as signed, TenKhoa as course
					 from LopHP natural join HocPhan natural join KhoaVien, LopHPDK 
					 where LopHPDK.MaLopHP = LopHP.MaLopHP and LopHPDK.TrangThai = 'Thành Công' and  LopHP.MaLopHP = '".$id."'
					 group by LopHPDK.MaLopHP, LopHP.MaLopHP, HocPhan.MaHP, TenHP, GhiChu, LopHP.TrangThai, TenKhoa ;;";
           return mysqli_query($conn, $query);
         }
  public function get_list_class_by_id_subject_semester ( $id_subject, $semester){
                   global $conn;
           $query = "select LopHP.MaLopHP as id_class, HocPhan.MaHP as id_subject, TenHP as name_subject, GhiChu as note, LopHP.TrangThai as status, DangKymin as min_sign, DangKymax as max_sign, count(LopHPDK.MSSV) as signed, TenKhoa as course
					 from LopHP natural join HocPhan natural join KhoaVien, LopHPDK 
					 where LopHPDK.MaLopHP = LopHP.MaLopHP and LopHPDK.TrangThai = 'Thành Công' and LopHP.MaHP = '".$id_subject."' and HocKy = '".$semester."'
					 group by LopHPDK.MaLopHP, LopHP.MaLopHP, HocPhan.MaHP, TenHP, GhiChu, LopHP.TrangThai, TenKhoa  ;";
           return mysqli_query($conn, $query);
         }
  public function get_list_class_by_course_semester ( $course, $semester){
                   global $conn;
           $query = "select LopHP.MaLopHP as id_class, HocPhan.MaHP as id_subject, TenHP as name_subject, GhiChu as note, LopHP.TrangThai as status, DangKymin as min_sign, DangKymax as max_sign, count(LopHPDK.MSSV) as signed, TenKhoa as course
					 from LopHP natural join HocPhan natural join KhoaVien, LopHPDK 
					 where LopHPDK.MaLopHP = LopHP.MaLopHP and LopHPDK.TrangThai = 'Thành Công' and TenKhoa = '".$course."' and HocKy = '".$semester."' 
					 group by LopHPDK.MaLopHP, LopHP.MaLopHP, HocPhan.MaHP, TenHP, GhiChu, LopHP.TrangThai, TenKhoa ;";
           return mysqli_query( $conn,$query);           
         }
  public function get_time_class_by_id ( $id){
                   global $conn;
           $query = "select NgayHoc as day_of_week, GioHoc as clock, TuanHoc as week, PhongHoc as place
					 from ThoiGianHoc natural join LopHP
					 where LopHP.MaLopHP = '".$id."'
					 order by NgayHoc asc ;";
           return mysqli_query($conn,$query);
         }
  public function get_time_table_class_register_by_username_semester( $username, $semester){
                   global $conn;
           $query = "select NgayHoc as day_of_week, GioHoc as clock, TuanHoc as week, PhongHoc as place, MaHP as id_subject, LopHP.MaLopHP as id_class
					 from ThoiGianHoc natural join LopHP, LopHPDK
					 where LopHPDK.MaLopHP = LopHP.MaLopHP and LopHPDK.TrangThai = 'Thành Công' and MSSV ='".$username."' and HocKy = '".$semester."' 
					 order by NgayHoc asc ;";
           return mysqli_query($conn,$query);
         }
  public function get_list_student_by_id_class($id){
      global  $conn;
      $query = "select MSSV as username
					 from lophpdk
					 where MaLopHP = '".$id."' ; ";
           return mysqli_query($conn, $query);
         }
  public function get_point_by_username_id_class( $user, $id_class){
                   global $conn;
           $query = "select DiemQT as midle_point, DiemCK as end_point 
					 from KetQua 
					 where MSSV = '".$user."' and MaLopHP = '".$id_class."' ;";
           return mysqli_query( $conn,$query);
         }
  public function change_status_of_class_by_id_class_status( $id_class, $status ){
                           global $conn;
		   $query = "update LopHP
					 set TrangThai = '".$status."'
					 where MaLopHP = '".$id_class."' ;";
           return mysqli_query( $conn,$query);
  }
  public function print_if_username_study_on_class_by_username_idclass( $username, $idclass){
	       global $conn;
               $query = "select *
			  from LopHPDK natural join KetQua
			  where LopHPDK.MSSV = '".$username."' and KetQua.MaLopHP='".$idclass."' and TrangThai = 'Thành Công' ; ";
	return mysqli_query( $conn,$query);
  }
  public function get_semester_by_id_class( $idclass ){
	       global $conn;
      $query = "";
	return mysqli_query( $conn,$query);
  }
  
}

?>