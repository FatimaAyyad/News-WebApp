<?php
session_start();
if(!isset($_SESSION["User"])) {
    header("Location: login_ui.php");
    exit();
}

include "connictionondatabase.php";

$sql = "SELECT n.*, c.category as category_name 
        FROM news n
        LEFT JOIN categories c ON n.category_id = c.id 
        WHERE n.is_deleted = 1  
        ORDER BY n.id DESC";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Deleted News</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    min-height: 100vh;
    background: linear-gradient(135deg,#3b0066,#5a189a,#7b2cbf);
    font-family: 'Segoe UI', Tahoma, sans-serif;
    padding: 20px 0;
}

.card-container{
    background:#ffffff;
    border-radius:26px;
    box-shadow:0 25px 60px rgba(0,0,0,0.25);
    padding:40px;
    max-width:1200px;
    margin: 0 auto 50px auto;
}

h1{
    color:#4b0082;
    font-weight:700;
    text-align:center;
    margin-bottom:30px;
}

.table thead th{
    background: linear-gradient(135deg,#6a0dad,#8a2be2);
    color:#fff;
    border:none;
    text-align:center;
    font-size:18px;
}

.table tbody td{
    text-align:center;
    vertical-align: middle;
    font-size:16px;
    border-top:1px solid #d6d6d6;
}

.news-image{
    max-width:120px;
    max-height:120px;
    border-radius:8px;
    border:2px solid #7a037e;
}

.details-cell{
    max-width:300px;
    text-align:justify;
    line-height:1.4;
}

.restore{
    background-color:#28a745;
    color:white;
    text-decoration:none;
    padding:8px 15px;
    border-radius:8px;
    font-weight:bold;
    display:inline-block;
    transition:0.3s;
}
.restore:hover{
    background-color:#218838;
    transform: scale(1.05);
}

.empty-message{
    padding:20px;
    font-size:18px;
    color:#666;
    text-align:center;
    width:100%;
}

.back-btn{
    display:inline-block;
    text-decoration:none;
    padding:12px 25px;
    background: linear-gradient(135deg,#6a0dad,#8a2be2);
    color:white;
    border-radius:12px;
    font-size:18px;
    margin-top:20px;
    transition:0.3s;
}
.back-btn:hover{
    opacity:0.9;
    transform:scale(1.05);
}
</style>
</head>
<body>

<div class="card-container">
    <h1>Deleted News</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Details</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["title"]); ?></td>
                        <td><?php echo htmlspecialchars($row["category_name"]); ?></td>
                        <td class="details-cell"><?php echo htmlspecialchars($row["details"]); ?></td>
                        <td>
                            <?php 
                            if(!empty($row["image"])) {
                                $image_path = $row["image"];
                                if (file_exists($image_path)) {
                                    echo '<img src="' . $image_path . '" class="news-image">';
                                } else if (file_exists('uploads/' . $image_path)) {
                                    echo '<img src="uploads/' . $image_path . '" class="news-image">';
                                } else {
                                    echo 'No Image';
                                }
                            } else { echo 'No Image'; }
                            ?>
                        </td>
                        <td>
                            <a href="restoreNews.php?id=<?php echo $row['id']; ?>" class="restore" onclick="return confirm('Are you sure you want to restore this news?')">
                                Restore
                            </a>
                        </td>
                    </tr>
            <?php } } else { ?>
                <tr>
                    <td colspan="5" class="empty-message">No deleted news found</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center gap-3 mt-3">
        <a href="viewNews.php" class="back-btn">Back to Active News</a>
        <a href="dashboardUi.php" class="back-btn">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
