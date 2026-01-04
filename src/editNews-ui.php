<?php
session_start();
if(!isset($_SESSION["User"])) {
    header("Location: login_ui.php");
    exit();
}

include "connictionondatabase.php";

if(!isset($_GET['id'])) {
    header("Location: viewNews.php");
    exit();
}

$news_id = $_GET['id'];

$news_sql = "SELECT * FROM news WHERE id = ?";
$stmt = $connection->prepare($news_sql);
$stmt->bind_param("i", $news_id);
$stmt->execute();
$news_result = $stmt->get_result();
$news = $news_result->fetch_assoc();

if(!$news) {
    header("Location: viewNews.php");
    exit();
}

$categories_sql = "SELECT * FROM categories";
$categories_result = $connection->query($categories_sql);
$categories = array();
if ($categories_result->num_rows > 0) {
    while($row = $categories_result->fetch_assoc()) {
        $categories[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit News</title>

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
    max-width:600px;
    margin:50px auto;
}

h1{
    color:#4b0082;
    font-weight:700;
    margin-bottom:30px;
    text-align:center;
}

label{
    color:#4b0082;
    font-weight:600;
    font-size:16px;
}

.form-control, select, textarea{
    border-radius:14px;
    border:2px solid #8a2be2;
    height:45px;
    padding:10px 14px;
    margin-top:10px;
    margin-bottom:20px;
    font-size:16px;
}

textarea{
    height:120px;
    resize: vertical;
}

.form-control:focus, select:focus, textarea:focus{
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
    cursor:pointer;
}

.btn-purple:hover{
    opacity:0.9;
    color:#ffffff;
}

.current-image img{
    max-width:250px;
    max-height:150px;
    border:2px solid #7a037e;
    border-radius:10px;
    margin-bottom:10px;
}

.image-note{
    color:#5c025f;
    font-size:14px;
    margin-bottom:10px;
}

.back-link{
    color:#6a0dad;
    font-size:16px;
    text-decoration:none;
    font-weight:500;
    display:block;
    text-align:center;
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
    <h1>Edit News</h1>

    <form action="editNews-logic.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="news_id" value="<?php echo $news['id']; ?>">

        <label>Title</label>
        <input type="text" name="title" class="form-control" 
               value="<?php echo htmlspecialchars($news['title']); ?>" required>

        <label>Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">Select category:</option>
            <?php foreach($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>" 
                    <?php echo ($category['id'] == $news['category_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['category']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Details</label>
        <textarea name="details" class="form-control" required><?php echo htmlspecialchars($news['details']); ?></textarea>

        <label>Current Image</label>
        <div class="current-image text-center">
            <?php if(!empty($news['image'])): ?>
                <?php
                $image_path = $news['image'];
                if (strpos($image_path, 'uploads/') !== 0) {
                    $image_path = 'uploads/' . $image_path;
                }
                ?>
                <img src="<?php echo $image_path; ?>" alt="Current Image">
                <div class="image-note">Current image</div>
            <?php else: ?>
                <div class="image-note">No current image</div>
            <?php endif; ?>
        </div>

        <label>Change Image (Optional)</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <div class="image-note">Leave empty to keep current image</div>

        <button type="submit" name="edit_news" class="btn btn-purple">Update News</button>
    </form>

    <a href="viewNews.php" class="back-link">Back to News List</a>
</div>

</body>
</html>
