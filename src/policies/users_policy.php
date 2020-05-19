<?php
class UsersPolicy{
  
  static function authorize($user_type){
    return $user_type=="admin" ? true : false;
  }

}
?>