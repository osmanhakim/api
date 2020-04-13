<?php
class DBException extends Exception {}
class db {
  private $user = "root";
  private $pass = "54411";
  private $db = "store";
  private $host = "localhost";
  private static $conn;
  public function connect(){
    if ($this->conn==null){
    db::$conn=@mysql_connect($this->host,$this->user,$this->pass);
    $select=@mysql_select_db($this->db,db::$conn);
    if (!db::$conn || !$select)
    throw new DBException("Error connecting to database !");
    return db::$conn;
}
}
}
?>
