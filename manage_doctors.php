<?php
include("db.php");

$doctors=mysqli_query($conn,"SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html>

<head>

<title>Doctors</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">
<h4>Manage Doctors</h4>
</div>

<div class="card-body">

<table class="table table-striped">

<tr>

<th>ID</th>
<th>Name</th>
<th>Specialization</th>
<th>Fee</th>
<th>Phone</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($doctors)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['specialization']; ?></td>

<td>₹<?php echo $row['fee']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td>

<a href="delete_doctor.php?id=<?php echo $row['id']; ?>" 
    class="btn btn-danger btn-sm"
    onclick="return confirm('Are you sure you want to delete this doctor?')">
    Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>