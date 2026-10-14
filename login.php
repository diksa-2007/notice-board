<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Keep the original default admin login working.
    if ($username === "admin" && $password === "admin123") {
        $_SESSION['admin'] = "admin";
        header("Location: dashboard.php");
        exit();
    }

    // Registered users are stored in MongoDB.
    $user = $users->findOne([
        "email" => strtolower($username)
    ]);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin'] = $user['name'];
        $_SESSION['user_id'] = (string)$user['_id'];
        header("Location: dashboard.php");
        exit();
    }

    echo "<script>alert('Invalid Email or Password');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:linear-gradient(135deg,#0d6efd,#6f42c1);
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}
.card{
border:none;
border-radius:20px;
box-shadow:0px 10px 25px rgba(0,0,0,0.3);
}
.card-header{
background:#0d6efd;
color:white;
text-align:center;
font-size:25px;
font-weight:bold;
border-radius:20px 20px 0 0 !important;
}
.btn{
border-radius:30px;
}
</style>
</head>

<body>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-5">
<div class="card">

<div class="card-header">
🎓 Smart College
<br>
Admin Login
</div>

<div class="card-body p-4">

<form method="POST">

<div class="mb-3">
<label class="form-label">Email / Username</label>
<input type="text" name="username" class="form-control"
placeholder="Enter Email or Username" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control"
placeholder="Enter Password" required>
</div>

<div class="d-grid">
<button type="submit" name="login" class="btn btn-primary btn-lg">
🔐 Login
</button>
</div>

<div class="text-center mt-3">
<a href="signup.php">Don't have an account? Sign Up</a>
</div>

<br>

<div class="text-center">
<a href="index.php" class="btn btn-secondary">
⬅ Back to Home
</a>
</div>

</form>

</div>
</div>
</div>
</div>
</div>
</body>
</html>