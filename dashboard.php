    <?php
include("db.php");

$doc=mysqli_query($conn,"SELECT COUNT(*) as total FROM doctors");
$docCount=mysqli_fetch_assoc($doc)['total'];

$app=mysqli_query($conn,"SELECT COUNT(*) as total FROM appointments");
$appCount=mysqli_fetch_assoc($app)['total'];

$rev=mysqli_query($conn,"
SELECT SUM(doctors.fee) as revenue
FROM appointments
JOIN doctors ON appointments.doctor_id=doctors.id
");

$revenue=mysqli_fetch_assoc($rev)['revenue'];
?>

<!DOCTYPE html>
<html>

<head>

<title>Smart Clinic Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>
<?php include "navbar.php"; ?>
<body>

<div class="container mt-5">

<h2>Admin Dashboard</h2>

<div class="row mt-4">

<div class="col-md-4">

<div class="card bg-primary text-white">

<div class="card-body">

<h4>Total Doctors</h4>

<h2><?php echo $docCount; ?></h2>

</div>

</div>

</div>


<div class="col-md-4">

<div class="card bg-success text-white">

<div class="card-body">

<h4>Total Appointments</h4>

<h2><?php echo $appCount; ?></h2>

</div>

</div>

</div>


<div class="col-md-4">

<div class="card bg-warning">

<div class="card-body">

<h4>Expected Revenue</h4>

<h2>₹<?php echo $revenue; ?></h2>

</div>

</div>

</div>

</div>

<hr>

<a href="add_doctor.php" class="btn btn-success">Add Doctor</a>

<a href="manage_doctors.php" class="btn btn-dark">Manage Doctors</a>

<a href="book_appointment.php" class="btn btn-primary">Book Appointment</a>

<a href="appointments.php" class="btn btn-info">View Appointments</a>

</div>

</body>

</html> 