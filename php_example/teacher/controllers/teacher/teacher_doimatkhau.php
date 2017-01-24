<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/teacher/teacher_model.php';

if ( isset ($_POST['change_password']) )
{
    if ( ($_POST['new_password'] == "")  || ( $_POST['old_password'] == "") || ( $_POST['confirm_password'] == "") ){
        $error_changepassword = "Bạn hãy nhập đầy đủ các trường!";
    } else {
        
        if ( $_SESSION['password'] == $_POST['old_password']){
            
            if( $_POST['new_password'] == $_POST['confirm_password'] ){
                $teacher_obj = new Teacher();
                $password = ($_POST['new_password']);
                $teacher_obj->changepassword_teacher($_SESSION['teacher_id'], $password);
                $row = mysqli_fetch_assoc( $teacher_obj->get_info_teacher_by_teacher_id($_SESSION['teacher_id']) );
                if ( $row['MatKhau'] == $password ){
                    $_SESSION['password'] = $row['MatKhau'];
                    $sucess_changepassword = "Bạn đã thay đổi mật khẩu thành công!";
                    include_once $_SESSION['BASE_PATH']."/views/teacher/teacher_doimatkhau.html";
                } else {
                    $error_changepassword = "Có lỗi khi đổi mật khẩu của bạn, hãy thử lại!";
                    include_once $_SESSION['BASE_PATH']."/views/teacher/teacher_doimatkhau.html";
                }
            } else {
                $error_changepassword = "Hai mật khẩu mới không giống nhau!";
                include_once $_SESSION['BASE_PATH']."/views/teacher/teacher_doimatkhau.html";
            }
        } else {
            $error_changepassword = "Mật khẩu cũ không đúng!";
            include_once $_SESSION['BASE_PATH']."/views/teacher/teacher_doimatkhau.html";
        }
    }
} else {
    include_once $_SESSION['BASE_PATH']."/views/teacher/teacher_doimatkhau.html";
}

?>