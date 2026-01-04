<?php
session_start();
if(!isset($_SESSION["User"])) {
    header("Location: login_ui.php");
    exit();
}

$userId = $_SESSION["User"]["id"];
include "connictionondatabase.php";

if($connection->connect_error == false){
    if(isset($_POST["add_news"])){
        $title = $connection->real_escape_string($_POST["title"]);
        $category_id = $connection->real_escape_string($_POST["category_id"]);
        $content = $connection->real_escape_string($_POST["details"]);
        
        
        $image_name = "";
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $tdir = "uploads/";
            
            if (!is_dir($tdir)) {
                mkdir($tdir, 0777, true);
            }
            
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $image_name = uniqid() . '_' . time() . '.' . $file_extension;
            $target_file = $tdir . $image_name;
            
            $atypes = array('jpg', 'jpeg', 'png', 'gif');
            
            if (in_array(strtolower($file_extension), $atypes)) {
                if ($_FILES['image']['size'] <= 5 * 1024 * 1024) { 
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                } else {
                    echo "Error: File size too large. Maximum 5MB allowed.";
                    exit();
                }
            } else {
                echo "Error: Invalid file type. Only JPG, JPEG, PNG, GIF allowed.";
                exit();
            }
        }
        
        
        
        $sql = "INSERT INTO news (title, category_id, details, image, user_id) 
                VALUES ('$title', '$category_id', '$content', '$image_name', '$userId')";
        
        $result = $connection->query($sql);
        if($result == true){
            header("Location: viewNews.php");
            exit();
        } else {
            echo "fail: " . $connection->error;
        }
    }  
} else {
    echo "Database connection failed";
}
?>