<?php
session_start();
include "db.php";

$message = "";

if(isset($_POST['update'])){
    $pass = $_POST['password'];
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $id = $_SESSION['user_id'];

    if(mysqli_query($conn, "UPDATE users SET password='$hash' WHERE id='$id'")){
        $message = "Password Updated Successfully!";
    } else {
        $message = "Error updating password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Change Password</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-md mx-auto mt-20 p-6 bg-white rounded-2xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Change Password</h2>

    <?php if($message != ""): ?>
        <p class="mb-4 text-center text-green-600 font-semibold"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-medium mb-1" for="password">New Password</label>
            <input type="password" id="password" name="password" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit" name="update"
            class="w-full py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition">Update Password</button>
    </form>
</div>

</body>
</html>