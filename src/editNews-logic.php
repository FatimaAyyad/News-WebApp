<?php
session_start();
if(!isset($_SESSION["User"])) {
    header("Location: login_ui.php");
    exit();
}

include "connictionondatabase.php";

if($connection->connect_error == false){
    if(isset($_POST["edit_news"])){
        $news_id = $_POST["news_id"];
        $title = $connection->real_escape_string($_POST["title"]);
        $category_id = $connection->real_escape_string($_POST["category_id"]);
        $details = $connection->real_escape_string($_POST["details"]);
        
        
        $current_sql = "SELECT image FROM news WHERE id = $news_id";
        $current_result = $connection->query($current_sql);
        $current_data = $current_result->fetch_assoc();
        
        $image_name = $current_data['image']; 
        
       
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $tdir = "uploads/";
            
            if (!is_dir($tdir)) {
                mkdir($tdir, 0777, true);
            }
            
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $new_image_name = uniqid() . '_' . time() . '.' . $file_extension;
            $target_file = $tdir . $new_image_name;
            
            $atypes = array('jpg', 'jpeg', 'png', 'gif');
            
            if (in_array(strtolower($file_extension), $atypes)) {
                if ($_FILES['image']['size'] <= 5 * 1024 * 1024) { 
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        
                        if(!empty($current_data['image']) && file_exists($current_data['image'])) {
                            unlink($current_data['image']);
                        }
                        $image_name = $new_image_name;
                    }
                } else {
                    echo "Error: File size too large. Maximum 5MB allowed.";
                    exit();
                }
            } else {
                echo "Error: Invalid file type. Only JPG, JPEG, PNG, GIF allowed.";
                exit();
            }
        }
        
        
        $update_sql = "UPDATE news SET 
                      title = '$title', 
                      category_id = '$category_id', 
                      details = '$details', 
                      image = '$image_name' 
                      WHERE id = $news_id";
        
        $result = $connection->query($update_sql);
        
        if($result == true){
            header("Location: viewNews.php");
            exit();
        } else {
            echo "Error updating news: " . $connection->error;
        }
    }  
} else {
    echo "Database connection failed";
}
?>