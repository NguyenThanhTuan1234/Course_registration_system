<?php
session_start();

if( isset($_SESSION['admin_id']) ){
    header( "Location:".$_SESSION['BASE_URL']."/controllers/admin/admin_trangchu.php");
}
else if( isset($_SESSION['username']) ){
    header( "Location:".$_SESSION['BASE_URL']."/controllers/user/user_loginsucess.php");
}
else if( isset($_SESSION['teacher_id']) ){
    header( "Location:".$_SESSION['BASE_URL']."/controllers/teacher/teacher_trangchu.php");
}
else {
    unset($_SESSION['BASE_URL']);
    if(isset($_POST['admin']))
        header("Location:"."http://localhost/php_example/admin");
    if(isset($_POST['student']))
        header("Location:"."http://localhost/php_example/user");
    if(isset($_POST['teacher']))
        header("Location:"."http://localhost/php_example/teacher");
}

?>

<html id="login">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đăng nhập</title>
    <?php
       echo  '<link rel="icon" href="'.'etc/img/HUST_logo.jpg">';
       ?>   
    <link rel="stylesheet" href="etc/css/bootstrap.min.css">
    <link rel="stylesheet" href="etc/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="etc/css/admin_custom.css">
    <script type="text/javascript" src="etc/js/bootstrap.min.js"></script>
  </head>
  
  <body id="login">
    <div class="container">
        <?php
         echo '<img class="loginmainimg" style="" src="'.'etc/img/HUST_logo.jpg" alt="HUST">';
         ?>
        
        <h2 class="form-signin-heading" style="text-align:center;">Đăng nhập với tư cách</h2>
      <form class="form-signin" role="form" method="post" action="">
        <button name="admin" class="btn btn-lg btn-primary btn-block" type="submit">Quản trị viên</button>
        <button name="teacher" class="btn btn-lg btn-primary btn-block" type="submit">Giáo viên</button>
        <button name="student" class="btn btn-lg btn-primary btn-block" type="submit">Học sinh</button>
      </form>
    </div>
  </body>
  
</html>
