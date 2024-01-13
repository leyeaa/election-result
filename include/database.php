<?php 
require_once("config.php");
class MySQLDatabase{
 private $connection;
 public  $last_query;
 private $magic_quote_active;
 private $real_escape_string_exit;
 //--------------------- constructor----------------------------
  function __construct(){ // this is the constructor in php 
  $this->open_connection(); 
  $this->magic_quotes_active=get_magic_quotes_gpc();
  $this->real_escape_string_exit=function_exists("mysqli_real_escape_string"); 
 }
  //----------------------------------------------------------------
 public function open_connection(){ // the first metthod, this is to connect database----------------------1
 $this->connection=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
  if(!$this->connection){
	die("Database Connection Fails".mysqli_error());  
   }
}
 //------------------------------------------------------------------- 
 /*public function query($sql){
 $this->last_query=$sql;
 $result=mysqli_query($this->connection, $sql);
 $this->confirm_query($result);
  return $result;  
 }*/
 
 public function query($sql){
 $this->last_query=$sql;
 $result=mysqli_query($this->connection, $sql);
 $this->confirm_query($result);
  return $result;  
 }
 
 
 //end this method query
 //-------------------------------------------------------------------
/* private function confirm_query($result){
 if(!$result){ 
  die(mysqli_error("Can not"));
  //die($output);
 }
 }
 */
 
  private function confirm_query($result){
 if(!$result){
 $output="Database Query Failed:". mysqli_error()."<br/> <br/>";
 $output .="Last SQL Query:".$this->last_query;	 
  //die("Database Query Failed:" .mysqli_error());
  die($output);
 }
 }
 //--------------------------------------------------------------------
 public function close_connection(){ // another method in the class Mydatabase this method closed the connection
 if(isset($this->connection)){
 mysqli_close($this->connection);
 unset($this->connection); 
 }
 }
 //--------------------------------------------------------------------
 public function num_rows($result_set){
 return mysqli_num_rows($result_set); 
 }
 
 //--------------------------------------------------------------------
 public function inserted_id(){
 return mysqli_insert_id($this->connection);	 	 
 }
 //------------------------------------------------------------------------
 public function affected_rows(){
  return mysqli_affected_rows($this->connection);	 
 }
 
//------------------------------------------------------------------------
public function fetch_array($result_set){
return mysqli_fetch_array($result_set);
}

public function fetch_assoc($result_set){
return mysqli_fetch_assoc($result_set);
}
//------------------------------------------------------------------------
/*public function lga_name($id){
$result=$database->query("SELECT * FROM lga WHERE lga_id='$id'");
$rows=$database->fetch_array($result);
$lga_name=$rows['lga_name'];
return $lga_name;	
}*/

//------------------------------------------------------------------------
 public function escape_value($value){   
  if($this->real_escape_string_exit){
	 if($this->magic_quotes_active){$value=addslashes($value);}   
	 $value=mysqli_real_escape_string($value );   
     }else{
  if(!$this->magic_quotes_active){$value=addslashes($value );}   
     }
   return $value;
    }
//-----------------------------	
}//end class

$database=new MySQLDatabase();



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>