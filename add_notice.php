<?php
include 'db.php';

if(isset($_POST['submit']))
{
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = $_POST['category'];
    $notice_date = $_POST['notice_date'];
    $attachment = "";

    if(isset($_FILES['attachment']) && $_FILES['attachment']['name'] != "")
    {
        $attachment = basename($_FILES['attachment']['name']);

        move_uploaded_file(
            $_FILES['attachment']['tmp_name'],
            "uploads/".$attachment
        );
    }

    try {
        $notices->insertOne([
            "title" => $title,
            "description" => $description,
            "category" => $category,
            "notice_date" => $notice_date,
            "attachment" => $attachment,
            "created_at" => new MongoDB\BSON\UTCDateTime()
        ]);

        echo "<script>alert('Notice Added Successfully');</script>";
    } catch (Throwable $e) {
        echo "<script>alert('Error adding notice!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Notice</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body style="background:linear-gradient(135deg,#e3f2fd,#ffffff);">
<div class="container mt-5">

<div class="row justify-content-center">
<div class="col-md-8">

<div class="card shadow-lg border-0 rounded-4">

<div class="card-header bg-success text-white text-center">
<h3>📢 Publish New Notice</h3>
</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label class="form-label">Notice Title</label>
<input type="text" name="title" class="form-control"
placeholder="Enter Notice Title" required>
</div>

<div class="mb-3">
<label class="form-label">Description</label>
<textarea name="description" class="form-control" rows="5"
placeholder="Enter Notice Description" required></textarea>
</div>

<div class="mb-3">
<label class="form-label">Category</label>
<select name="category" class="form-select" required>
<option value="">Select Category</option>
<option>Academic</option>
<option>Placement</option>
<option>Workshop</option>
<option>Sports</option>
<option>Club Activities</option>
<option>Examination</option>
<option>Holiday</option>
<option>Circular</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Notice Date</label>
<input type="date" name="notice_date" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Upload Attachment (PDF / Image)</label>
<input type="file" name="attachment" class="form-control">
</div>

<div class="text-center">
<button type="submit" name="submit" class="btn btn-success btn-lg w-100">
Publish Notice
</button>

<a href="dashboard.php" class="btn btn-outline-dark btn-lg mt-3 w-100">
Back
</a>
</div>

</form>

</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>