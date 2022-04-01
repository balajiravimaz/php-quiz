<?php

require "db/Database.php";

$db = new Database();

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $db->query("SELECT userid FROM lang where lid = $id");
    $uid=$db->resultSet();    
    $db->query("DELETE FROM lang where lid = $id ");   
    $result1 = $db->execute();
        
    if($result1){
        echo "<script>alert('Data Deleted');</script>";
        echo "<script>window.location.href='edit.php?id=". $uid[0]->userid ."';</script>";
        
    }else{
        header("Location:multiple.php");
    }
}else{
    header("Location:multiple.php");
}

?>

