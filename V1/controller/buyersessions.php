<?php
require_once('db.php');
require_once('../model/user.php');
require_once('../model/Response.php');

if ($_SERVER['REQUEST_METHOD']=='POST'){
  $input = file_get_contents("php://input");
 if ($_SERVER['CONTENT_TYPE']!=='application/json' || !json_decode($input)){
   $res = new Response();
   $res->setSuccess(false); // not suceess
   $res->setHttpStatusCode(400); //bad request
   $res->addMessage("must send json input");
   $res->send();
   exit;
 }
 $input = json_decode($input);
 if ($input->username == '' || $input->password==''){
   $res = new Response();
   $res->setSuccess(false); // not suceess
   $res->setHttpStatusCode(400); //bad request
   $res->addMessage("please check you provide required input [username,password]");
   $res->send();
   exit;
 }
 try {
   $con = new db();
   $sql=$con->connect();
   $hashpassword = md5($input->password);
   $query= "select id,username,password from buyer where username='".$input->username."' and password='".$hashpassword."';";
  // echo "SQL Query to execute: $query"; # Debug Message
   $result=mysql_query($query,$sql);
   $rows=mysql_num_rows($result);
   if (!$rows){
     $res = new Response();
     $res->setSuccess(false); // not suceess
     $res->setHttpStatusCode(400); //bad request
     $res->addMessage("Wrong username or password");
     $res->send();
     exit;
   }
   $data=mysql_fetch_array($result,MYSQL_ASSOC);
   $accesstoken=base64_encode(bin2hex(openssl_random_pseudo_bytes(24).time()));
   $accesstokenexpirey=604800; // 7 days
   $query="insert into buyersessions (userid,accesstoken,accesstokenexpirey) values (".$data['id'].",'".$accesstoken."',date_add(NOW(),INTERVAL ".$accesstokenexpirey." SECOND));";
   mysql_query($query,$sql);
   //echo "SQL Query to execute: $query"; # Debug Message
   $rows=mysql_affected_rows();
   if ($rows==1){
     $response = new Response();
     $response->setSuccess(true);
     $response->setHttpStatusCode(201); // created
     $response->addMessage("login Success");
     $data = array();
     $lastid= mysql_insert_id($sql);
     $data['sessionid']=$lastid;
     $data['accesstoken']=$accesstoken;
     $data['accesstokenexpirey']=$accesstokenexpirey;
     $response->setData($data);
     $response->send();
   }else {
     $response = new Response ();
     $response->setSuccess(false);
     $response->setHttpStatusCode(500); // server error
    // $response->setData($data);
     $response->addMessage("Error while trying login admin user");
     $response->send();
     exit;
   }
 }

 catch (DBException $ex){
   $res = new Response();
   $res->setSuccess(false); // not suceess
   $res->setHttpStatusCode(500); //internal server error
   $res->addMessage($ex->getMessage());
   $res->send();
 }

} else {
  $res = new Response();
  $res->setSuccess(false); // not suceess
  $res->setHttpStatusCode(400); //bad request
  $res->addMessage("request not accepted");
  $res->send();
}
?>
