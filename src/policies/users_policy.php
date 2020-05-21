<?php
class UsersPolicy{
  
  //returns true if user is admin
  static function authorize($user_type){
    return $user_type=="admin" ? true : false;
  }

  static function authorize_edit($user_type,$edited_user_admin_id){
    return $user_type=="admin" && $_SESSION['id']==$edited_user_admin_id ? true : false;
  }

}
?>