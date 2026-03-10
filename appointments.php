<?php
include("db.php");

mysqli_query($conn, "
    UPDATE appointments
    SET status = 'Expired'
    WHERE status = 'Pending'
    AND CONCAT(date, ' ', time) < NOW() - INTERVAL 30 MINUTE
");

$data = mysqli_query($conn, "
SELECT appointments.*, doctors.name AS doctor
FROM appointments
JOIN doctors ON appointments.doctor_id = doctors.id
ORDER BY appointments.date DESC, appointments.time DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Appointments</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4>Appointments</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $row['patient_name']; ?></td>
                    <td><?= $row['doctor']; ?></td>
                    <td><?= $row['date']; ?></td>
                    <td><?= date("h:i A", strtotime($row['time'])); ?></td>
                    <td>
                        <?php
                        if($row['status'] == 'Pending') echo '<span class="text-primary">Pending</span>';
                        elseif($row['status'] == 'Visited') echo '<span class="text-success">Visited</span>';
                        elseif($row['status'] == 'Expired') echo '<span class="text-danger">Expired</span>';
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

</body>
</html>