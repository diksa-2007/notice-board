<?php
include 'db.php';

$search = "";

if(isset($_GET['search']))
{
    $search = trim($_GET['search']);

    $safeSearch = preg_quote($search, '/');

    $result = $notices->find(
        [
            '$or' => [
                ["title" => ['$regex' => $safeSearch, '$options' => 'i']],
                ["category" => ['$regex' => $safeSearch, '$options' => 'i']]
            ]
        ],
        ["sort" => ["notice_date" => -1]]
    );
}
else
{
    $result = $notices->find(
        [],
        ["sort" => ["notice_date" => -1]]
    );
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Student Notice Board</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">

<a class="navbar-brand" href="index.php">
🎓 Smart College
</a>

<div>
<a href="index.php" class="btn btn-light">
Home
</a>
</div>

</div>
</nav>

<div class="container mt-5">

<h2 class="text-center mb-4">
📢 Latest College Notices
</h2>

<form method="GET" class="mb-4">

<div class="row">

<div class="col-md-10">
<input type="text" name="search" class="form-control"
placeholder="🔍 Search Notice by Title or Category"
value="<?php echo htmlspecialchars($search); ?>">
</div>

<div class="col-md-2">
<button class="btn btn-primary w-100">
Search
</button>
</div>

</div>
</form>

<div class="row">

<?php foreach($result as $row) { ?>

<div class="col-md-4 mb-4">

<div class="card shadow h-100">

<div class="card-body">

<h4>
<?php echo htmlspecialchars($row['title']); ?>
</h4>

<p>
<?php echo htmlspecialchars($row['description']); ?>
</p>

<p>

<?php
$color="secondary";

if($row['category']=="Academic")
{
    $color="primary";
}
elseif($row['category']=="Placement")
{
    $color="success";
}
elseif($row['category']=="Workshop")
{
    $color="warning";
}
elseif($row['category']=="Sports")
{
    $color="danger";
}
?>

<span class="badge bg-<?php echo $color; ?>">
<?php echo htmlspecialchars($row['category']); ?>
</span>

</p>

<p>
<b>Date :</b>
<?php echo htmlspecialchars($row['notice_date']); ?>
</p>

<?php if(!empty($row['attachment'])) { ?>

<p>
<a href="uploads/<?php echo rawurlencode($row['attachment']); ?>"
class="btn btn-success btn-sm"
target="_blank">
📥 Download Attachment
</a>
</p>

<?php } ?>

</div>
</div>
</div>

<?php } ?>

</div>
</div>

<footer class="bg-primary text-white text-center p-3 mt-5">
© 2026 Smart College Digital Notice Board
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>