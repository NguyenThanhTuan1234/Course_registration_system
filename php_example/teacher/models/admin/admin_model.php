<?php
include $_SESSION['BASE_PATH']."/models/connect_to_database_server.php";

class Admin{
  public function get_info_admin_by_admin_id( $admin_id ){
      global $conn;
      $query = "select MaAD as admin_id, HoTen as fullname, MatKhau as password 
					 from admin 
					 where MaAD ='".$admin_id."' ;";
           return mysqli_query( $conn,$query);
         }
  public function changepassword_admin ( $admin_id, $newpassword ){
            global $conn;
           $query = "update ADMIN 
					 set MatKhau = '$newpassword' 
					 where MaAD = '$admin_id';";
           return mysqli_query($conn,$query);
         }
  public function set_password_username_password ( $username, $newpassword ){
            global $conn;
           $query = "update sinhvien 
					 set MatKhau = '$newpassword' 
					 where MSSV = '$username';";
           return mysqli_query($conn,$query);
         }
  public function add_student_with_info( $username_student, $fullname_student, $birth_day_of_student, $sex_of_student, $native_land_of_student, $school_course, $course, $class, $course_type){
            global $conn;
           $query = "insert into SinhVien 
					 values ('".$username_student."', '".$fullname_student."', '".$sex_of_student."', '".$birth_day_of_student."', '".$native_land_of_student."', '".$class."', ' ', '".$username_student."', '".$course_type."', '".$school_course."') ;";
           return mysqli_query( $conn,$query);
         }
    public function add_class_with_info( $class_id, $class_course, $class_semester, $class_min, $class_max, $class_teacher, $class_note){
        global $conn;
        $query = "insert into LopHP
					 values ('".$class_id."', '".$class_course."', '".$class_semester."', '".$class_min."', '".$class_max."', '".$class_teacher."', 'Đóng đăng ký', '".$class_note."', '') ;";
        return mysqli_query($conn,$query);
    }
    public function add_class_with_info2( $class_id, $class_date, $class_room, $class_week, $class_time){
        global $conn;
        $query = "insert into ThoiGianHoc
					 values ('".$class_id."', '".$class_date."', '".$class_room."', '".$class_week."', '".$class_time."') ;";
        return mysqli_query($conn,$query);
    }
    public function update_class_with_info( $class_id, $class_course, $class_semester, $class_min, $class_max, $class_teacher, $class_note){
        global $conn;
        $query = "update LopHP
					 set  MaHP = '".$class_course."', HocKy = '".$class_semester."', DangKymin = '".$class_min."', DangKymax = '".$class_max."', MSGV = '".$class_teacher."', GhiChu = '".$class_note."'
					 where MaLopHP = '".$class_id."' ;";
        return mysqli_query($conn,$query);
    }
    public function update_class_with_info2( $class_id, $class_date, $class_room, $class_week, $class_time){
        global $conn;
        $query = "update ThoiGianHoc
					 set  NgayHoc = '".$class_date."', PhongHoc = '".$class_room."', TuanHoc = '".$class_week."', GioHoc = '".$class_time."'
					 where MaLopHP = '".$class_id."' ;";
        return mysqli_query($conn,$query);
    }
  public function update_student_with_info( $username_student, $fullname_student, $birth_day_of_student, $sex_of_student, $native_land_of_student, $school_course, $course, $class, $course_type){
            global $conn;
           $query = "update SinhVien 
					 set  HoTen = '".$fullname_student."', GioiTinh = '".$sex_of_student."', NgaySinh = '".$birth_day_of_student."', QueQuan = '".$native_land_of_student."', KhoaHoc = '".$school_course."', MaLopSV = '".$class."', HeHoc = '".$course_type."'
					 where MSSV = '".$username_student."' ;";
           return mysqli_query($conn,$query);
         }
  public function post_idadmin_idcategory_title_brief_header_content_file( $admin_id, $category_id, $title, $brief, $header, $content, $file){
      global $conn;
      $query_get_date = "SELECT CURDATE();";
           $result_get_date = mysqli_query($conn,$query_get_date);
           $current_date = mysqli_fetch_array($result_get_date);
           $post = "insert into post( admin_id, category_id, title, brief, header, content, date_post, file_attack) values( '".$admin_id."', '".$category_id."', '".$title."', '".$brief."', '".$header."', '".$content."', '".$current_date."', '".$file."');";
           return mysqli_query( $conn,$post);
         }
  public function update_post_by_post_id_title( $post_id, $title ){
            global $conn;
           $query = "update Post set title = '".$title."' where post_id = '".$post_id."' ;";
           return mysqli_query($conn,$query);
         }
  public function update_post_by_post_id_brief( $post_id, $brief ){
            global $conn;
           $query = "update Post set brief = '".$brief."' where post_id = '".$post_id."' ;";
           return mysqli_query($conn,$query);
         }
  public function update_post_by_post_id_header( $post_id, $header ){
            global $conn;
           $query = "update Post set header = '".$header."' where post_id = '".$post_id."' ;";
           return mysqli_query($conn,$query);
         }
  public function update_post_by_post_id_content( $post_id, $content ){
            global $conn;
           $query = "update Post set content = '".$content."' where post_id = '".$post_id."' ;";
           return mysqli_query($conn,$query);
         }
  public function delete_post_by_post_id($id){
            global $conn;
           $query ="delete from Post where post_id = '".$id."';";
           return mysqli_query($conn,$query);
         }  
  public function update_point_of_student($username, $id_class, $midle_point, $end_point, $tb_point, $diemchu, $thang4){
            global $conn;
           $query = " update KetQua
				   set DiemQT = '".$midle_point."', DiemCK = '".$end_point."', DiemTB = '".$tb_point."', XepLoai = '".$diemchu."', ThangDiem4 = '".$thang4."'
				   where MSSV = '".$username."' and MaLopHP = '".$id_class."'; ";
           return mysqli_query($conn,$query);
         }
  public function write_point_of_student($username, $id_class, $midle_point, $end_point, $tb_point, $diemchu, $thang4){
           $query = " insert into KetQua
				   values ( '".$username."', '".$id_class."', '".$midle_point."', '".$end_point."', '".$tb_point."', '".$diemchu."', '".$thang4."') ;";
           return mysqli_query($conn,$query);
         }
  public function update_GPA_CPA_of_student($username, $semester, $gpa, $cpa, $tcdangky, $tctichluy, $trinhdo){
           $query = " update TichLuy
				   set GPA = '".$gpa."', CPA = '".$cpa."', TCdangky = '".$tcdangky."', TCtichluy = '".$tctichluy."', TrinhDo = '".$trinhdo."'
				   where MSSV = '".$username."' and HocKy = '".$semester."'; ";
           return mysqli_query($conn,$query);
         }
  public function write_GPA_CPA_of_student($username, $semester, $gpa, $cpa, $tcdangky, $tctichluy, $trinhdo){
           $query = " insert into TichLuy
				   values ('".$username."', '".$semester."', '".$gpa."', '".$cpa."', '".$tcdangky."', '".$tctichluy."', '".$trinhdo."' ) ;";
           return mysqli_query($conn,$query);
         }
 
 
}
?>