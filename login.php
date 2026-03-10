<?php
session_start();
include "db.php";

if(isset($_POST['login'])){

$login = $_POST['login_id'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$login' OR email='$login'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){

$user = mysqli_fetch_assoc($result);

if(password_verify($password,$user['password'])){

$_SESSION['user_id']=$user['id'];
$_SESSION['username']=$user['username'];
$_SESSION['role']=$user['role'];

if($user['role']=="admin"){

header("Location: dashboard.php");

}else{

header("Location: book_appointment.php");

}

}else{

$error="Wrong Password";

}

}else{

$error="User not found";

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Clinic Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:linear-gradient(135deg,#667eea,#764ba2);
height:100vh;
display:flex;
align-items:center;
justify-content:center;
}

.login-box{
background:white;
padding:40px;
border-radius:10px;
width:400px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

</style>

</head>

<body>

<div class="login-box">

<h3 class="text-center mb-4">Smart Clinic Login</h3>

<?php if(isset($error)){ ?>

<div class="alert alert-danger">
<?php echo $error; ?>
</div>

<?php } ?>

<form method="POST">

<input 
type="text"
name="login_id"
placeholder="Username or Email"
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

<button class="btn btn-primary w-100" name="login">
Login
</button>

<div class="text-center mt-3">

Don't have account?

<a href="signup.php">Sign Up</a>

</div>

</form>

</div>

</body>
</html>