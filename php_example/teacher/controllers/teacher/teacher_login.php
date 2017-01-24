<?php
session_start();
include_once $_SESSION['BASE_PATH'].'/models/teacher/teacher_model.php';

if( isset($_SESSION['teacher_id']) ){
    header( "Location:".$_SESSION['BASE_URL']."/controllers/teacher/teacher_trangchu.php");
} else {

    if( isset( $_POST['login'] ) ) {
        $id=($_POST['teacher_id']);
        $password=($_POST['password']);
        if( $id != '' && $password != ''){
            $teacher_obj = new Teacher();
            $teacher = $teacher_obj->get_info_teacher_by_teacher_id($id);
            if($teacher){
                $row = mysqli_fetch_assoc($teacher);
                if( $row['MatKhau'] == $password){
                    $_SESSION['teacher_id'] = $row['MSGV'];
                    $_SESSION['password'] = $row['MatKhau'];
                    $_SESSION['fullname'] = $row['HoTen'];
                    header("Location:".$_SESSION['BASE_URL']."/controllers/teacher/teacher_trangchu.php");
                } else {
                    $error_login = "Mật khẩu không đúng!";
                    include_once $_SESSION['BASE_PATH']."/views/teacher/teacher_login.html";
                }
            }else {
                $error_login = "Tài khoản không hợp lệ!";
                include_once $_SESSION['BASE_PATH']."/views/teacher/teacher_login.html";
            }
        } else {
            $error_login = "Bạn hãy nhập tài khoản và mật khẩu!";
            include_once $_SESSION['BASE_PATH']."/views/teacher/teacher_login.html";
        }
    } else {
        include_once $_SESSION['BASE_PATH']."/views/teacher/teacher_login.html";
    }
}
?>