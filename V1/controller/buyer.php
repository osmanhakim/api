<?php
require_once('db.php');
require_once('../model/user.php');
require_once('../model/Response.php');
##############################################
# list all buyer users by admin
#
##############################################
if ($_SERVER['REQUEST_METHOD']=='GET'){
// check admin authorization
if(isset($_SERVER['HTTP_AUTHORIZATION']) && $_SERVER['HTTP_AUTHORIZATION']!=''){
$auth=$_SERVER['HTTP_AUTHORIZATION'];
$con = new db();
$sql=$con->connect();
$query="select userid,accesstokenexpirey from adminsessions where accesstoken='".$auth."'";
$result=mysql_query($query,$sql);
$rows=mysql_num_rows($result);
if (!$rows){
  $res = new Response();
  $res->setSuccess(false); //  suceess
  $res->setHttpStatusCode(400); // ok
  $res->addMessage("access token not valid");
  $res->setData($data);
  $res->send();
  exit;
}
$data=mysql_fetch_array($result,MYSQL_ASSOC);
if(@strtotime($data['accesstokenexpirey'])<time()){
  $res = new Response();
  $res->setSuccess(false); //  suceess
  $res->setHttpStatusCode(400); // ok
  $res->addMessage("access token expired please login");
  $res->setData($data);
  $res->send();
  exit;
}
//
} else {
  $res = new Response();
  $res->setSuccess(false); //  suceess
  $res->setHttpStatusCode(400); // ok
  $res->addMessage("you must add Authorization header");
  $res->setData($data);
  $res->send();
  exit;
}
try{
$con = new db();
$sql=$con->connect();
$query = "select id,fullname,username from buyer;";
$result=mysql_query($query,$sql);
$data = array();
while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
  $data[]=$row;
}
$res = new Response();
$res->setSuccess(true); //  suceess
$res->setHttpStatusCode(200); // ok
$res->addMessage("get all buyers");
$res->setData($data);
$res->send();
}
catch (DBException $ex){
  $res = new Response();
  $res->setSuccess(false); // not suceess
  $res->setHttpStatusCode(500); //internal server error
  $res->addMessage($ex->getMessage());
  $res->send();
}

}

else if ($_SERVER['REQUEST_METHOD']=='POST'){
    $input = file_get_contents("php://input");
   if ($_SERVER['CONTENT_TYPE']!=='application/json' || !json_decode($input)){
     $res = new Response();
     $res->setSuccess(false); // not suceess
     $res->setHttpStatusCode(400); //bad request
     $res->addMessage("must send json input");
     $res->send();
     exit;
   }
   $input=json_decode($input);
   if ($input->fullname == '' || $input->username == '' || $input->password==''){
     $res = new Response();
     $res->setSuccess(false); // not suceess
     $res->setHttpStatusCode(400); //bad request
     $res->addMessage("please check you provide required input [fullname,username,password]");
     $res->send();
     exit;
   }

   try {
     $con = new db();
     $sql=$con->connect();
     $user = new user($input->fullname,$input->username,$input->password);
     $query="insert into buyer (fullname,username,password) values ('".$user->getFullname()."','".$user->getUsername()."','".md5($user->getPassword())."');";
    // echo "SQL Query to execute: $query"; # Debug Message
     mysql_query($query,$sql);
     $rows=mysql_affected_rows();
     if ($rows==1){
       $data = array();
       $lastid= mysql_insert_id($sql);
       $data['id']=$lastid;
       $data['fullname']=$user->getFullname();
       $data['username']=$user->getUsername();
       $data['password']=$user->getPassword();
       $response = new Response ();
       $response->setSuccess(true);
       $response->setHttpStatusCode(201); // created
       $response->setData($data);
       $response->addMessage("User buyer created successfully");
       $response->send();
       exit;
     }else {
       $response = new Response ();
       $response->setSuccess(false);
       $response->setHttpStatusCode(500); // created
       $response->setData($data);
       $response->addMessage("Error while trying create buyer user");
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
   catch (USERException $ex){
     $res = new Response();
     $res->setSuccess(false); // not suceess
     $res->setHttpStatusCode(400); //bad request
     $res->addMessage($ex->getMessage());
     $res->send();
   }
}
else {
$res = new Response();
$res->setSuccess(false); // not suceess
$res->setHttpStatusCode(400); //bad request
$res->addMessage("request not accepted");
$res->send();
}
?>
