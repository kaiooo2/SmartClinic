<?php
include "db.php";

if(isset($_POST['signup'])){

$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];

$check=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check)>0){

$error="Email already exists";

}else{

$hash=password_hash($password,PASSWORD_DEFAULT);

mysqli_query($conn,
"INSERT INTO users(username,email,password,role)
VALUES('$username','$email','$hash','user')");

$success="Account created successfully";

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Create Account</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:linear-gradient(135deg,#43cea2,#185a9d);
height:100vh;
display:flex;
align-items:center;
justify-content:center;
}

.signup-box{
background:white;
padding:40px;
border-radius:10px;
width:400px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

</style>

</head>

<body>

<div class="signup-box">

<h3 class="text-center mb-4">Create Account</h3>

<?php if(isset($error)){ ?>

<div class="alert alert-danger">
<?php echo $error; ?>
</div>

<?php } ?>

<?php if(isset($success)){ ?>

<div class="alert alert-success">
<?php echo $success; ?>
</div>

<?php } ?>

<form method="POST">

<input 
type="text"
name="username"
placeholder="Username"
class="form-control mb-3"
required
>

<input 
type="email"
name="email"
placeholder="Email"
class="form-control mb-3"
required
>

<input 
type="password"
name="password"
placeholder="Password"
class="form-control mb-3"
required
>

<button class="btn btn-success w-100" name="signup">
Create Account
</button>

<div class="text-center mt-3">

Already have account?

<a href="login.php">Login</a>

</div>

</form>

</div>

</body>
</html>