<?php
//Remove header
header_remove();

//Update database entries based on the id number passed from add/view.php
if($_GET){
  $server = "db-mysql.zenit";
  $user = "int322_162b04";
  $password = "ebQZ8429";
  $db="int322_162b04";
  //MySQL-digestable variables:
  $dbHandle = new mysqli($server, $user, $password, $db);
  $id = $_GET['id'];
  $id = $dbHandle->real_escape_string($id);
  $update = " UPDATE inventory SET deleted =
  CASE
    WHEN deleted = 'y' AND id = '$id' THEN 'n'
    WHEN deleted = 'n' AND id = '$id' THEN 'y'
    ELSE deleted
  END;";
  mysqli_query($dbHandle, $update) or die("Failed");
  } else {
  mysqli_close($dbHandle);
  }

//Redirect to view.php and show updated entries
  header("Location: view.php");
  ?>
