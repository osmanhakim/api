<?php
class Response {
private $success;
private $httpStatusCode;
private $messages=array();
private $data;
private $responseData=array();

public function setSuccess($success){
  $this->success=$success;
}

public function setHttpStatusCode($status){
  $this->httpStatusCode = $status;
}

public function addMessage($message){
  $this->messages[]=$message;
}

public function setData($data){
  $this->data=$data;
}

public function send(){
header('Content-Type: application/json;charset=utf-8');
header('Cache-Control: max-age=no-cache, no-store');
if (($this->success !== true && $this->success !== false) || !is_numeric($this->httpStatusCode)){
  http_response_code(500);
  $this->responseData['success']=false;
  $this->responseData['StatusCode']=500;
  $this->addMessage("Error Creation Response");
  $this->responseData['messages']=$this->messages;
  $this->responseData['data']=$this->data;
  echo json_encode($this->responseData);
  exit;
}
http_response_code($this->httpStatusCode);
$this->responseData['success']=$this->success;
$this->responseData['StatusCode']=$this->httpStatusCode;
$this->responseData['messages']=$this->messages;
$this->responseData['data']=$this->data;
echo json_encode($this->responseData);
}
}
?>
