<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include 'db.php';

$total = $notices->countDocuments([]);
$academic = $notices->countDocuments(["category" => "Academic"]);
$placement = $notices->countDocuments(["category" => "Placement"]);
$workshop = $notices->countDocuments(["category" => "Workshop"]);
$sports = $notices->countDocuments(["category" => "Sports"]);

$recentNotices = $notices->find(
    [],
    [
        "sort" => ["notice_date" => -1],
        "limit" => 5
    ]
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
<div class="container">
<a class="navbar-brand">🎓 Smart College Digital Notice Board</a>
<a href="logout.php" class="btn btn-light">Logout</a>
</div>
</nav>

<div class="container mt-5">

<h2 class="mb-4">Welcome Admin 👋</h2>

<div class="row">

<div class="col-md-3">
<div class="card shadow text-center">
<div class="card-body">
<h2><?php echo $total; ?></h2>
<p>Total Notices</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card shadow text-center">
<div class="card-body">
<h5>Add Notice</h5>
<a href="add_notice.php" class="btn btn-success">Open</a>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card shadow text-center">
<div class="card-body">
<h5>View Notices</h5>
<a href="view_notice.php" class="btn btn-primary">Open</a>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card shadow text-center">
<div class="card-body">
<h5>Student Page</h5>
<a href="student.php" class="btn btn-warning">Visit</a>
</div>
</div>
</div>

</div>

<div class="row mt-4">

<div class="col-md-3">
<div class="card bg-primary text-white text-center">
<div class="card-body">
<h2><?php echo $academic; ?></h2>
<p>Academic</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white text-center">
<div class="card-body">
<h2><?php echo $placement; ?></h2>
<p>Placement</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-warning text-center">
<div class="card-body">
<h2><?php echo $workshop; ?></h2>
<p>Workshop</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white text-center">
<div class="card-body">
<h2><?php echo $sports; ?></h2>
<p>Sports</p>
</div>
</div>
</div>

</div>

<h3 class="mt-5">Recent Notices</h3>

<table class="table table-bordered table-striped">

<tr>
<th>Title</th>
<th>Category</th>
<th>Date</th>
</tr>

<?php foreach($recentNotices as $row) { ?>

<tr>
<td><?php echo htmlspecialchars($row['title']); ?></td>
<td><?php echo htmlspecialchars($row['category']); ?></td>
<td><?php echo htmlspecialchars($row['notice_date']); ?></td>
</tr>

<?php } ?>

</table>

</div>
</body>
</html>