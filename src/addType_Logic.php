<?php
session_start();
$userId=$_SESSION["User"]["id"];
include "connictionondatabase.php";
if($connection->error==false){
        if(isset($_POST["add-category"])){
        $type=$_POST["category"];
        


        $sql= "INSERT INTO categories(category) VALUES ('$type')";
        $result = $connection->query($sql);
        if($result==true){
            header("Location:viewTypes.php");
          
        }else{
            echo "fail";
        }
}       }
?>      
