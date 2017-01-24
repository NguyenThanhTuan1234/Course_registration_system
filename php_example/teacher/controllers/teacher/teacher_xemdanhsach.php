<?php
session_start();
include $_SESSION['BASE_PATH'].'/models/subject/class_model.php';
include $_SESSION['BASE_PATH'].'/models/user/user_model.php';
include $_SESSION['BASE_PATH'].'/models/teacher/teacher_model.php';

$class_obj = new Class_Obj();
$user_obj = new User();
$teacher_Obj =new Teacher();

$list_class = $teacher_Obj->get_class_by_teacher_id( $_SESSION['teacher_id']);

include $_SESSION['BASE_PATH'].'/views/teacher/teacher_xemdanhsach.html';

?>