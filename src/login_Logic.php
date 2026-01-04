<?php
session_start();
include "connictionondatabase.php";
 if($connection->error==false){
   if(isset($_POST["login"])){
    $email= $_POST["email"];
    $password= $_POST["password"];

    $sql="SELECT * FROM users WHERE email ='$email'  ";
    $result = $connection->query($sql);
    if($result->num_rows >0){
        $data = $result->fetch_assoc();
        if(password_verify($password,$data["password"])){
          $_SESSION["User"]=$data;
            header("Location:dashboardUi.php");
            echo "done";
        }else{
            echo "faile";
        }
    }else{
        echo "faile";
    }
}}