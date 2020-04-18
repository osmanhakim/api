<?php
class USERException extends Exception {}
class User {
private $id;
private $fullname;
private $username;
private $password;

public function __construct($fullname,$username,$password){
  $this->setFullname($fullname);
  $this->setUsername($username);
  $this->setPassword($password);
}
public function setId($id){
  $this->id=$id;
}

public function setFullname($fullname){
  $pattern = "/\b([a-zA-Z]{3,}( )[a-zA-Z]{3,})\b/";
  $r=preg_match($pattern,$fullname);
  if(!$r){
    throw new USERException ("check fullname contans valid input [aaa bbb]");
  }
//  echo "value of r= ".$r;
  $this->fullname=$fullname;
}

public function setUsername($username){
  $pattern = "/\b([a-zA-Z0-9]{5,})\b/";
  $r=preg_match($pattern,$username);
  if(!$r){
    throw new USERException ("check username contans valid input [aaaaa]");
  }
  //echo "value of r= ".$r;
  $this->username=$username;
}

public function setPassword($password){
  $pattern = "/\b([a-zA-Z0-9]{8,})\b/";
  $r=preg_match($pattern,$password);
  if(!$r){
    throw new USERException ("check password contans valid input [aaaaa]");
  }
//  echo "value of r= ".$r;
  $this->password=$password;
}


public function getId(){
  return $this->id;
}

public function getFullname(){
  return $this->fullname;
}

public function getUsername(){
  return $this->username;
}

public function getPassword (){
  return $this->password;
}
}
?>
