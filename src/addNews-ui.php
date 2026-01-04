<?php
session_start();
include "connictionondatabase.php";

$sql = "SELECT * FROM categories";
$result = $connection->query($sql);
$categories = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            min-height: 100vh;
            background: linear-gradient(135deg,#4b0082,#6a0dad,#8a2be2);
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .news-card{
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 20px 45px rgba(75,0,130,0.35);
            padding: 35px;
        }

        h1{
            color:#4b0082;
            font-weight: 700;
        }

        label{
            color:#4b0082;
            font-weight: 600;
        }

        .form-control,
        .form-select{
            border-radius: 14px;
            border: 2px solid #8a2be2;
        }

        .form-control:focus,
        .form-select:focus{
            box-shadow: 0 0 0 0.25rem rgba(138,43,226,.25);
            border-color:#6a0dad;
        }

        .btn-purple{
            background: linear-gradient(135deg,#6a0dad,#8a2be2);
            color:#fff;
            border:none;
            border-radius: 16px;
            font-size: 20px;
            padding: 10px;
            width:100%;
            font-weight: 600;
        }

        .btn-purple:hover{
            opacity: 0.9;
            color:#fff;
        }

        .back-link{
            color:#e6d9ff;
            font-size:18px;
            text-decoration:none;
            font-weight:500;
        }

        .back-link:hover{
            text-decoration: underline;
            color:#ffffff;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
    <div class="col-md-8 col-lg-6">
        <div class="news-card">

            <h1 class="text-center mb-4">Hello In Add News Page</h1>

            <form action="addNews-logic.php" method="post" enctype="multipart/form-data"> 

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter news title" required>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select category:</option>
                        <?php foreach($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['category']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>details</label>
                    <textarea name="details" class="form-control" rows="5" placeholder="Enter news content" required></textarea>
                </div>

                <div class="mb-4">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <button type="submit" name="add_news" class="btn btn-purple">
                    Add News
                </button>

            </form>

        </div>

        <div class="text-center mt-3">
            <a href="dashboardUi.php" class="back-link">Back to Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>
