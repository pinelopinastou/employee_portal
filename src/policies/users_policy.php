<?php
class UsersPolicy{
  
  //returns true if user is admin
  static function authorize($user_type){
    return $user_type=="admin" ? true : false;
  }

}
?>