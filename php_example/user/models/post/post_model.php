<?php
include_once $_SESSION['BASE_PATH'].'/models/connect_to_database_server.php';

class Post{
  public function get_10_last_post(){
            global $conn;
           $query = "select * from post order by post_id  DESC;";
           return mysqli_query($conn,$query);
         }
  public function get_post_of_admin( ){
      global  $conn;
      $query = "select * from post where category_id = '0' order by post_id  DESC";
      return mysqli_query($conn,$query);
         }
  public function get_post_register_class(){
        global  $conn;
        $query = "select * from post where category_id = '1' order by post_id  DESC";
        return mysqli_query( $conn,$query);
         }
  public function get_post_graduate_project(){
           global  $conn;
           $query = "select * from post where category_id = '2' order by post_id  DESC";
           return mysqli_query( $conn,$query);
         }
  public function get_post_graduate_consider(){
           global  $conn;
           $query = "select * from post where category_id = '3' order by post_id  DESC";
           return mysqli_query( $conn,$query);
         }
  public function get_post_warning_study(){
            global  $conn;
           $query = "select * from post where category_id = '4' order by post_id  DESC";
           return mysqli_query( $conn,$query);
         }
  public function get_post_test(){
            global  $conn;
           $query = "select * from post where category_id = '5' order by post_id  DESC";
           return mysqli_query( $conn,$query);
         }
  public function get_post_by_category_id_post_id( $category_id, $post_id){
            global  $conn;
           $query = "select category_id, title, header, brief, content, DATE_FORMAT(date_post,  '%Y-%m-%d') as date_post, file_attack from post where category_id = '".$category_id."' and post_id= '".$post_id."'";
           return mysqli_query( $conn,$query);
         }
  public function get_post_by_post_id( $post_id){
            global  $conn;
           $query = "select category_id, title, header, brief, content, DATE_FORMAT(date_post,  '%Y-%m-%d') as date_post, post_id, file_attack from post where post_id = '".$post_id."'";
           return mysqli_query( $conn,$query);
         }
  public function get_name_category_by_category_id_post( $id){
           global  $conn;
           $query =" select * from category, post where post_id = '".$id."' and post.category_id = category.category_id ;";
           $get_result = mysqli_query( $conn,$query);;
           $caterory_name = mysqli_fetch_assoc($get_result);
           return $caterory_name['category_name'];
         }
}

?>