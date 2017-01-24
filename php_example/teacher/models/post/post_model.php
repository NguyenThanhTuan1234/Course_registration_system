<?php
include_once $_SESSION['BASE_PATH'].'/models/connect_to_database_server.php';

class Post{

  public function get_10_last_post(){
           $query = "select * from Post order by post_id  DESC;";
           return pg_query( $query);
         }
  public function get_post_of_admin( ){
           $query = "select * from Post where category_id = '0' order by post_id  DESC";
           return pg_query( $query);
         }
  public function get_post_register_class(){
           $query = "select * from Post where category_id = '1' order by post_id  DESC";
           return pg_query( $query);
         }
  public function get_post_graduate_project(){
           $query = "select * from Post where category_id = '2' order by post_id  DESC";
           return pg_query( $query);
         }
  public function get_post_graduate_consider(){
           $query = "select * from Post where category_id = '3' order by post_id  DESC";
           return pg_query( $query);
         }
  public function get_post_warning_study(){
           $query = "select * from Post where category_id = '4' order by post_id  DESC";
           return pg_query ( $query);
         }
  public function get_post_test(){
           $query = "select * from Post where category_id = '5' order by post_id  DESC";
           return pg_query ( $query);
         }
  public function get_post_by_category_id_post_id( $category_id, $post_id){
           $query = "select category_id, title, header, brief, content, DATE_FORMAT(date_post,  '%Y-%m-%d') as date_post, file_attack from Post where category_id = '".$category_id."' and post_id = '".$post_id."'";
           return pg_query($query);
         }
  public function get_post_by_post_id( $post_id){
           $query = "select category_id, title, header, brief, content, DATE_FORMAT(date_post,  '%Y-%m-%d') as date_post, post_id, file_attack from Post where post_id = '".$post_id."'";
           return pg_query($query);
         }
  public function get_name_category_by_category_id_post( $id){
           $query =" select * from category, Post where post_id = '".$id."' and Post.category_id = category.category_id ;";
           $get_result = pg_query ( $query);
           $caterory_name = pg_fetch_array($get_result);
           return $caterory_name['category_name'];
         }
}

?>