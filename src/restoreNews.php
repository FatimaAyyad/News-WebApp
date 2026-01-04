<?php
session_start();
if(!isset($_SESSION["User"])) {
    header("Location: login_ui.php");
    exit();
}

include "connictionondatabase.php";

if(isset($_GET['id'])) {
    $news_id = $_GET['id'];
    
    $sql = "UPDATE news SET is_deleted = 0 WHERE id = $news_id";
    
    $result = $connection->query($sql);
    
    if($result == true) {
        header("Location: viewNews.php?restored=true");
        exit();
    } else {
        echo "Error restoring news: " . $connection->error;
        echo "<br><br>";
        echo "<a href='viewDeletedNews.php'>Back to Deleted News</a>";
    }
} else {
    echo "No news ID specified";
    echo "<br><br>";
    echo "<a href='viewDeletedNews.php'>Back to Deleted News</a>";
}

$connection->close();
?>