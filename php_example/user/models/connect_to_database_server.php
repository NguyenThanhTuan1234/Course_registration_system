<?php
   
    $string_connect_failed = "Cannot connect to database server! Please check your connection!";
    $conn = mysqli_connect('localhost', 'root','', 'qlsv_final') 
                or die ($string_connect_failed);
    mysqli_set_charset($conn, 'utf8');
   
   ?>



