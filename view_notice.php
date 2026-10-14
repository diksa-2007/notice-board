<?php
include 'db.php';

$result = $notices->find(
    [],
    ["sort" => ["notice_date" => -1]]
);
?>

<!DOCTYPE html>
<html>
<head>
<title>View Notices</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f5f7fa;">

<nav class="navbar navbar-dark bg-primary">
<div class="container">
<a class="navbar-brand">🎓 Smart College Digital Notice Board</a>
<a href="dashboard.php" class="btn btn-light">⬅ Dashboard</a>
</div>
</nav>

<div class="container mt-5">

<div class="card shadow-lg">

<div class="card-header bg-success text-white">
<h3 class="mb-0">📋 Manage Notices</h3>
</div>

<div class="card-body">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">
<tr>
<th>ID</th>
<th>Title</th>
<th>Description</th>
<th>Category</th>
<th>Date</th>
<th>Actions</th>
</tr>
</thead>

<tbody>

<?php foreach($result as $row) { ?>

<tr>

<td><?php echo htmlspecialchars((string)$row['_id']); ?></td>

<td><?php echo htmlspecialchars($row['title']); ?></td>

<td><?php echo htmlspecialchars($row['description']); ?></td>

<td>
<span class="badge bg-primary">
<?php echo htmlspecialchars($row['category']); ?>
</span>
</td>

<td><?php echo htmlspecialchars($row['notice_date']); ?></td>

<td>
<a href="edit_notice.php?id=<?php echo $row['_id']; ?>"
class="btn btn-warning btn-sm">
✏ Edit
</a>

<a href="delete_notice.php?id=<?php echo $row['_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this notice?');">
🗑 Delete
</a>
</td>

</tr>

<?php } ?>

</tbody>
</table>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>