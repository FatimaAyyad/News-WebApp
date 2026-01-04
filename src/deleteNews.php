<?php
session_start();
if(!isset($_SESSION["User"])) {
    header("Location: login_ui.php");
    exit();
}

include "connictionondatabase.php";

if(isset($_GET['id'])) {
    $news_id = $_GET['id'];
    
    
    $sql = "UPDATE news SET is_deleted = 1 WHERE id = $news_id";
    
    $result = $connection->query($sql);
    
    if($result == true) {
        header("Location: viewNews.php");
        exit();
    } else {
        echo "Error deleting news: " . $connection->error;
    }
}

$connection->close();
?>