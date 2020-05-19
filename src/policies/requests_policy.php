<?php
class RequestsPolicy{
  
  static function authorize_to_send_requests($administrator_id){
    return $administrator_id==null ? false : true;
  }

  static function authorize_to_receive_requests($user_type){
    return $user_type=="admin" ? true : false;
  }

}
?>