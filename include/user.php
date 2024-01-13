<?php 
include("database.php");
class User{
  public static function find_all(){
  global $database;
  $result_set=$database->query("SELECT * FROM user");
  return $result_set;	
}
 
 public static function find_by_id($id=0){
 $result_set=$database->query("SELECT * FROM user WHERE id={$id} LIMIT 1");
 $found=$database->fetch_array($result_set);
 return $found;
 }
  public static function find_all(){
  global $database;
  $result_set=$database->query("SELECT * FROM user");
  return $result_set;	
}

  
}

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