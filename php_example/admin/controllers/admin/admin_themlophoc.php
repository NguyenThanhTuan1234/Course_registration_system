<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/subject/class_model.php';
include $_SESSION['BASE_PATH'].'/models/subject/subject_model.php';
include $_SESSION['BASE_PATH'].'/models/admin/admin_model.php';
include $_SESSION['BASE_PATH'].'/models/teacher/teacher_model.php';


if( isset($_POST['add_class']) ){
    if( ($_POST['class_id'] != "") && ( $_POST['class_course'] != "") && ( $_POST['class_semester'] != "") && ( $_POST['class_min'] != "" ) && ( $_POST['class_max'] != "" ) && ( $_POST['class_teacher'] != "" ) && ( $_POST['class_note'] != "" ) ){
        $admin_obj = new Admin();
        $class_obj = new Class_Obj();
        $teacher_obj = new Teacher();
        $subject_obj = new Subject();
        $id=($_POST['class_id']);
        $course=($_POST['class_course']);
        $semester=$_POST['class_semester'];
        $min=$_POST['class_min'];
        $max=$_POST['class_max'];
        $teacher=($_POST['class_teacher']);
        $note=$_POST['class_note'];
        $date=$_POST['class_date'];
        $room=($_POST['class_room']);
        $week=$_POST['class_sweek'].' - '.$_POST['class_eweek'];
        $time=$_POST['class_shour'].' - '.$_POST['class_ehour'];
        if( $_POST['class_eweek']> $_POST['class_sweek'])
        {
            if( strcmp($_POST['class_ehour'],$_POST['class_shour'])>0){
                if( $max> $min)
                {
                    if(($semester%10>0) && ($semester%10<4) && ($semester/10>2000) && ($semester/10<2020)){
                        if(strlen($id)==3){
                            if ( !mysqli_num_rows($class_obj->get_class_info_by_id( $id)) ){
                                if( mysqli_num_rows($subject_obj->get_info_subject_by_id( $course))){
                                    if( mysqli_num_rows($teacher_obj->get_info_teacher_by_teacher_id( $teacher)) )
                                    {
                                        $admin_obj->add_class_with_info( $id, $course, $semester, $min, $max, $teacher, $note);
                                        $admin_obj->add_class_with_info2( $id, $date, $room, $week, $time);
                                        // Need check success!
                                        if ( mysqli_num_rows($class_obj->get_class_info_by_id( $id)) ){
                                            $add_class_success = "Đã thêm lớp học mới!";
                                        } else {
                                            $error_add_class = "Có lỗi phát sinh trong quá trình kết nối cơ sở dữ liệu. Đề nghị bạn dừng công việc lại và kiểm tra hệ thống!";
                                        }
                                    }else{
                                        $error_add_class= "Lỗi: ID của giảng viên không tồn tại. Xin bạn xem xét thật cẩn thận lại!";
                                    }
                                }else{
                                    $error_add_class= "Lỗi: ID môn học không tồn tại. Xin bạn xem xét thật cẩn thận lại!";
                                }
                            } else {
                                $error_add_class= "Lỗi: Trùng ID lớp học. Xin bạn xem xét thật cẩn thận lại!";
                            }
                        }else{
                            $error_add_class= "Lỗi: Sai ID lớp học. Xin bạn xem xét thật cẩn thận lại!";
                        }
                    }else{
                        $error_add_class= "Lỗi: Bạn đã nhập sai định dạng học kỳ! Ví dụ:20131";
                    }
                }else{
                    $error_add_class= "Lỗi: Số lượng sinh viên tối đa phải lớn hơn tối thiểu. Xin bạn xem xét thật cẩn thận lại!";
                }
            }else{
                $error_add_class= "Lỗi: Giờ học bắt đầu phải trước giờ học kết thúc. Xin bạn xem xét thật cẩn thận lại!";
            }
        }else{
            $error_add_class= "Lỗi: Tuần học bắt đầu phải trước tuần học kết thúc. Xin bạn xem xét thật cẩn thận lại!";
        }
    } else {
        $error_add_class = "Bạn cần nhập đầy đủ các thông tin của lớp học. Xin hãy nhập cẩn thận!";
    }
    include $_SESSION['BASE_PATH'].'/views/admin/admin_themlophoc.html';
} else {
    include $_SESSION['BASE_PATH'].'/views/admin/admin_themlophoc.html';
}
?>
