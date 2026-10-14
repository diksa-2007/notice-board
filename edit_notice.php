<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: view_notice.php");
    exit();
}

try {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $row = $notices->findOne(["_id" => $id]);

    if (!$row) {
        die("Notice not found.");
    }
} catch (Throwable $e) {
    die("Invalid notice ID.");
}

if(isset($_POST['update']))
{
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = $_POST['category'];
    $notice_date = $_POST['notice_date'];

    try {
        $notices->updateOne(
            ["_id" => $id],
            ['$set' => [
                "title" => $title,
                "description" => $description,
                "category" => $category,
                "notice_date" => $notice_date
            ]]
        );

        echo "<script>
        alert('Notice Updated Successfully');
        window.location='view_notice.php';
        </script>";
        exit();
    } catch (Throwable $e) {
        echo "<script>alert('Error updating notice!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Notice</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:linear-gradient(135deg,#e3f2fd,#ffffff);">

<nav class="navbar navbar-dark bg-primary">
<div class="container">
<a class="navbar-brand">🎓 Smart College Digital Notice Board</a>
<a href="view_notice.php" class="btn btn-light">⬅ Back</a>
</div>
</nav>

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-8">

<div class="card shadow-lg border-0 rounded-4">
<div class="card-header bg-warning text-dark text-center">
<h3>✏ Edit Notice</h3>
</div>

<div class="card-body">
<form method="POST">

<div class="mb-3">
<label class="form-label">Notice Title</label>
<input type="text" name="title" class="form-control"
value="<?php echo htmlspecialchars($row['title'] ?? ''); ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Description</label>
<textarea name="description" class="form-control" rows="5" required><?php
echo htmlspecialchars($row['description'] ?? '');
?></textarea>
</div>

<div class="mb-3">
<label class="form-label">Category</label>
<select name="category" class="form-select" required>
<?php
$categories = [
    "Academic", "Placement", "Workshop", "Sports",
    "Club Activities", "Examination", "Holiday", "Circular"
];

foreach ($categories as $category) {
    $selected = (($row['category'] ?? '') === $category) ? "selected" : "";
    echo "<option $selected>" . htmlspecialchars($category) . "</option>";
}
?>
</select>
</div>

<div class="mb-3">
<label class="form-label">Notice Date</label>
<input type="date" name="notice_date" class="form-control"
value="<?php echo htmlspecialchars($row['notice_date'] ?? ''); ?>" required>
</div>

<div class="d-grid">
<button type="submit" name="update" class="btn btn-warning btn-lg">
💾 Update Notice
</button>
</div>

<div class="d-grid mt-3">
<a href="view_notice.php" class="btn btn-outline-secondary btn-lg">
Cancel
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