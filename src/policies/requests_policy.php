<?php
class RequestsPolicy{
  
  //returns true if user had administrator_id set
  static function authorize_to_send_requests($administrator_id){
    return $administrator_id==null ? false : true;
  }

  //returns true if user is admin and the related record id belongs to an employee that is assigned to them
  static function authorize_to_receive_request($user_type,$request_admin_id){
    return $user_type=="admin" && $request_admin_id ==$_SESSION['id'] ? true : false;
  }


}
?>