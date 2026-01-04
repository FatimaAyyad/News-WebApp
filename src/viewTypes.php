<?php
session_start();
$id=$_SESSION["User"]["id"];

include "connictionondatabase.php";
$sql="SELECT * FROM categories";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Types</title>

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
    max-width:800px;
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
    color:#420244d7;
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
    <h1>All Categories</h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($result->num_rows != 0){
                    while($row=$result->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["category"]); ?></td>
                        </tr>
            <?php } } else { ?>
                <tr>
                    <td colspan="1" class="text-center text-muted">No categories found</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        <a href="dashboardUi.php" class="back-btn">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
