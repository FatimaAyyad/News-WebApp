<?php
$connection = new mysqli(
    "db",
    "news_user",
    "news_pass",
    "news_db"
);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
