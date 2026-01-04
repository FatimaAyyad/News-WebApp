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
        WHERE n.is_deleted = 0  
        ORDER BY n.id DESC";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View News</title>

<!-- Bootstrap -->
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

.actions a{
    min-width: 80px;
    text-align:center;
    padding:8px 12px;
    border-radius:8px;
    font-weight:600;
    color:#fff;
    text-decoration:none;
    transition:0.3s;
    display:inline-block;
}


.actions .edit{
    background-color:#007bff;
    border:2px solid #0056b3;
}
.actions .edit:hover{
    background-color:#0056b3;
    transform: scale(1.05);
}

.actions .delete{
    background-color:#dc3545;
    border:2px solid #a71e2a;
}
.actions .delete:hover{
    background-color:#a71e2a;
    transform: scale(1.05);
}

.table tbody tr:hover{
    background-color:#f0d0f9;
}

.add-btn, .deleted-btn{
    display:inline-block;
    padding:12px 25px;
    border-radius:12px;
    font-size:18px;
    font-weight:600;
    color:#fff;
    text-decoration:none;
    margin-top:20px;
    transition:0.3s;
}

.add-btn{
    background: linear-gradient(135deg,#6a0dad,#8a2be2);
}
.add-btn:hover{
    opacity:0.9;
    transform: scale(1.05);
}

.deleted-btn{
    background: #6c757d;
}
.deleted-btn:hover{
    background: #545b62;
    transform: scale(1.05);
}

.back-link{
    display:block;
    text-align:center;
    margin-top:20px;
    color:#6a0dad;
    text-decoration:none;
    font-weight:500;
}
.back-link:hover{
    color:#4b0082;
    text-decoration: underline;
}

.success-message{
    background-color: #d4edda;
    color: #155724;
    padding:12px;
    border-radius:10px;
    text-align:center;
    font-size:16px;
    margin-bottom:20px;
}
</style>
</head>
<body>

<div class="card-container">
    <h1>All News</h1>

    <?php
    if(isset($_GET['restored']) && $_GET['restored'] == 'true') {
        echo '<div class="success-message">News restored successfully</div>';
    }
    ?>

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
                        <td style="max-width:300px; text-align:justify;"><?php echo htmlspecialchars($row["details"]); ?></td>
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
                        <td class="actions">
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="editNews-ui.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
                                <a href="deleteNews.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this news?')">Delete</a>
                            </div>
                        </td>

                    </tr>
            <?php } } else { ?>
                <tr>
                    <td colspan="5">No news found</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center flex-wrap gap-3 mt-3">
        <a href="addNews-ui.php" class="add-btn">Add New News</a>
        <a href="viewNewsDeleted.php" class="deleted-btn">View Deleted News</a>
    </div>

    <a href="dashboardUi.php" class="back-link">Back to Dashboard</a>
    
</div>

</body>
</html>
