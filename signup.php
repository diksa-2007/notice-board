<?php
require_once 'db.php';

$message = "";

if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $existingUser = $users->findOne(["email" => $email]);

        if ($existingUser) {
            $message = "An account with this email already exists.";
        } else {
            try {
                $users->insertOne([
                    "name" => $name,
                    "email" => $email,
                    "password" => password_hash($password, PASSWORD_DEFAULT),
                    "created_at" => new MongoDB\BSON\UTCDateTime()
                ]);

                echo "<script>
                    alert('Account created successfully. Please login.');
                    window.location='login.php';
                </script>";
                exit();
            } catch (Throwable $e) {
                $message = "Unable to create account. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign Up</title>
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
Admin Sign Up
</div>

<div class="card-body p-4">

<?php if ($message != "") { ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" name="name" class="form-control"
placeholder="Enter Name" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control"
placeholder="Enter Email" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control"
placeholder="Enter Password" required>
</div>

<div class="mb-3">
<label class="form-label">Confirm Password</label>
<input type="password" name="confirm_password" class="form-control"
placeholder="Confirm Password" required>
</div>

<div class="d-grid">
<button type="submit" name="signup" class="btn btn-primary btn-lg">
📝 Sign Up
</button>
</div>

<div class="text-center mt-3">
Already have an account?
<a href="login.php">Login</a>
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