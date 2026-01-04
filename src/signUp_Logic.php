<?php
include "connictionondatabase.php";
function validateData($data){
   $data =trim($data);
   $data=htmlspecialchars($data);
   return $data;
}


if($connection->error==false){
  
  if(isset($_POST["creat_account"])){
   $name=validateData($_POST["name"]) ;
   $email=validateData( $_POST["email"]);
   $password=password_hash(validateData($_POST["password"]),PASSWORD_BCRYPT);
   $sql ="INSERT INTO users(name,email,password)
             values ('$name','$email','$password')";
   $result = $connection->query($sql);
   if($result==true){
       header("Location:login_ui.php");
      // echo "insetion done";
   }else{
       echo "fail";
   }
}
  
}
?>