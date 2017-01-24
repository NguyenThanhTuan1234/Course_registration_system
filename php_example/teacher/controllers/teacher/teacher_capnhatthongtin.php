<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/subject/class_model.php';
include $_SESSION['BASE_PATH'].'/models/teacher/teacher_model.php';

$teacher_Obj =new Teacher();
$class_obj = new Class_Obj();

$list_class = $teacher_Obj->get_class_by_teacher_id( $_SESSION['teacher_id']);

if ( isset ($_POST['commit_point'])){
    while( $row_list_class = mysqli_fetch_assoc($list_class )) {
        $temp_class =  $row_list_class['id'];
        $content=($_POST['content'.$temp_class]);
        $teacher_Obj->update_class_with_info($temp_class, $content);
    }
    $sucess_comit_point= "Đã cập nhật thông tin cho lớp ";
}

include $_SESSION['BASE_PATH'].'/views/teacher/teacher_capnhatthongtin.html';

?>