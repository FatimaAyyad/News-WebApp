<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Types</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    min-height: 100vh;
    background: linear-gradient(135deg,#3b0066,#5a189a,#7b2cbf);
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

.card-container{
    background:#ffffff;
    border-radius:26px;
    box-shadow:0 25px 60px rgba(0,0,0,0.25);
    padding:40px;
    max-width:500px;
    margin:50px auto;
    text-align:center;
}

h1{
    color:#4b0082;
    font-weight:700;
    margin-bottom:30px;
}

label{
    color:#4b0082;
    font-weight:600;
    font-size:18px;
}

.form-control{
    border-radius:14px;
    border:2px solid #8a2be2;
    height:45px;
    padding:10px 14px;
    margin-top:10px;
    margin-bottom:20px;
}

.form-control:focus{
    border-color:#6a0dad;
    box-shadow:0 0 0 0.25rem rgba(138,43,226,.25);
}

.btn-purple{
    background: linear-gradient(135deg,#6a0dad,#8a2be2);
    color:#ffffff;
    border:none;
    border-radius:16px;
    font-size:20px;
    padding:10px;
    width:100%;
    font-weight:600;
}

.btn-purple:hover{
    opacity:0.9;
    color:#ffffff;
}

.back-link{
    color:#6a0dad;
    font-size:18px;
    text-decoration:none;
    font-weight:500;
    display:block;
    margin-top:20px;
}

.back-link:hover{
    text-decoration: underline;
    color:#4b0082;
}
</style>
</head>
<body>

<div class="card-container">

    <h1>Add Types</h1>

    <form action="addType_Logic.php" method="post">
        <label>Add category:</label>
        <input type="text" name="category" class="form-control" placeholder="sport" required>

        <button type="submit" name="add-category" class="btn btn-purple">category</button>
    </form>

    <a href="dashboardUi.php" class="back-link">Back to Dashboard</a>

</div>

</body>
</html>
