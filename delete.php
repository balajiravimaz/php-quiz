<?php

require "db/Database.php";

$db = new Database();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $db->query("DELETE FROM users where user_id = $id ");   
    $result1 = $db->execute();
    $db->query("DELETE from lang where userid = $id ");
    $result2 = $db->execute();

        
    if($result1 || $result2){
        echo "<script>alert('Data Deleted');</script>";
        echo "<script>window.location.href='multiple.php';</script>";
        
    }else{
        header("Location:multiple.php");
    }


}else{
    header("Location:multiple.php");
}

?>

