<?php
session_start();
include "db.php";

$id = $_SESSION['username'];

mysqli_query($conn, "
    UPDATE appointments
    SET status = 'Expired'
    WHERE status = 'Pending'
    AND patient_name = '$id'
    AND CONCAT(date, ' ', time) < NOW() - INTERVAL 30 MINUTE
");

$result = mysqli_query($conn, "
SELECT appointments.date AS appointment_date,
       appointments.time AS appointment_time,
       appointments.status,
       doctors.name AS doctor
FROM appointments
JOIN doctors ON doctors.id = appointments.doctor_id
WHERE patient_name='$id'
ORDER BY appointments.date DESC, appointments.time DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Appointments</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">My Appointments</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-blue-100 text-left">
                    <th class="px-4 py-2 border">Doctor</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Time</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border"><?= $row['doctor']; ?></td>
                            <td class="px-4 py-2 border"><?= $row['appointment_date']; ?></td>
                            <td class="px-4 py-2 border"><?= date("h:i A", strtotime($row['appointment_time'])); ?></td>
                            <td class="px-4 py-2 border">
                                <?php 
                                if($row['status'] == 'Pending') echo '<span class="text-blue-600 font-semibold">Pending</span>';
                                elseif($row['status'] == 'Visited') echo '<span class="text-green-600 font-semibold">Visited</span>';
                                elseif($row['status'] == 'Expired') echo '<span class="text-red-600 font-semibold">Expired</span>';
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-4 py-2 border text-center text-gray-500">No appointments found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>