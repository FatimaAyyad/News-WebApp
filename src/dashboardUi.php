<?php
session_start();
if(isset($_SESSION["User"])!=true){
    header("Loction:login_ui.php");
}
$name=$_SESSION["User"]["name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    min-height: 100vh;
    background: linear-gradient(135deg,#3b0066,#5a189a,#7b2cbf);
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

.dashboard-header{
    color:#ffffff;
    font-weight:700;
    margin-bottom:40px;
    text-align:center;
}

.dashboard-card{
    background:#ffffff;
    border-radius:26px;
    box-shadow:0 25px 60px rgba(0,0,0,0.25);
    padding:40px;
}

.menu-card{
    background:linear-gradient(135deg,#6a0dad,#8a2be2);
    color:#fff;
    border-radius:20px;
    padding:30px;
    text-align:center;
    text-decoration:none;
    font-weight:600;
    font-size:18px;
    transition:0.35s ease;
    box-shadow:0 15px 30px rgba(106,13,173,0.45);
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    height:150px;
}

.menu-card i{
    font-size:38px;
    margin-bottom:12px;
}

.menu-card:hover{
    transform:translateY(-6px) scale(1.03);
    box-shadow:0 25px 45px rgba(106,13,173,0.6);
    color:#fff;
}

.welcome-text{
    color:#4b0082;
    font-weight:700;
    margin-bottom:30px;
}
</style>
</head>
<body>

<div class="container mt-5 mb-5">
    <h2 class="dashboard-header">Welcome Back</h2>

    <div class="dashboard-card">
        <h3 class="welcome-text">Hello <?php echo $name ?> In Dashboard</h3>

        <div class="row g-4">

            <div class="col-md-6 col-lg-4">
                <a href="addTypes-ui.php" class="menu-card">
                    <i class="bi bi-plus-circle"></i>
                    Add Types
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="viewTypes.php" class="menu-card">
                    <i class="bi bi-list-ul"></i>
                    View Types
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="addNews-ui.php" class="menu-card">
                    <i class="bi bi-newspaper"></i>
                    Add News
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="viewNews.php" class="menu-card">
                    <i class="bi bi-eye"></i>
                    View News
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="viewNewsDeleted.php" class="menu-card">
                    <i class="bi bi-trash"></i>
                    View Deleted News
                </a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
