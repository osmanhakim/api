<?php
require_once('db.php');
require_once('../model/user.php');
require_once('../model/Response.php');
##############################################
# list all users by admin
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
//
try{
$con = new db();
$sql=$con->connect();
$query1 = "select id,fullname,username from buyer;";
$query2 = "select id,fullname,username from seller;";
$result=mysql_query($query1,$sql);
$data = array();
while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
  $data[]=$row;
}
$result=mysql_query($query2,$sql);
while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
  $data[]=$row;
}
$res = new Response();
$res->setSuccess(true); //  suceess
$res->setHttpStatusCode(200); // ok
$res->addMessage("get all users");
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

}else {
$res = new Response();
$res->setSuccess(false); // not suceess
$res->setHttpStatusCode(400); //bad request
$res->addMessage("GET reqest only accepted");
$res->send();
}
?>
