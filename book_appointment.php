<?php
include("db.php");

$doctors = mysqli_query($conn, "SELECT * FROM doctors");

if(isset($_POST['book'])){
    $name = trim($_POST['patient_name']);
    $doctor = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    
    $check = mysqli_query($conn, "
        SELECT * FROM appointments
        WHERE doctor_id = $doctor
        AND date = '$date'
        AND TIME_TO_SEC(TIMEDIFF(time, '$time')) BETWEEN -1800 AND 1800
    ");

    if(mysqli_num_rows($check) > 0){
        echo "<script>alert('Sorry! That time is already taken. Pick another 30-minute slot.');</script>";
    } else {
        mysqli_query($conn, "
            INSERT INTO appointments(patient_name, doctor_id, date, time)
            VALUES('$name', '$doctor', '$date', '$time')
        ");
        echo "<script>alert('Appointment Booked Successfully!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "navbar.php"; ?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Book Appointment</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Patient Name</label>
                    <input type="text" name="patient_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Select Doctor</label>
                    <select name="doctor_id" class="form-control" required>
                        <?php while($row = mysqli_fetch_assoc($doctors)) { ?>
                            <option value="<?= $row['id']; ?>">
                                <?= $row['name']; ?> - <?= $row['specialization']; ?> - ₹<?= $row['fee']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Time</label>
                    <input type="time" name="time" class="form-control" required>
                </div>

                <button type="submit" name="book" class="btn btn-success">
                    Book Appointment
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>