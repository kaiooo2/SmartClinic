<?php
include("db.php");

if(isset($_POST['add'])){
    $name = trim($_POST['name']);
    $spec = trim($_POST['specialization']);
    $fee = intval($_POST['fee']);
    $phone = trim($_POST['phone']);

    if($name && $spec && $fee && $phone){
        mysqli_query($conn,"
            INSERT INTO doctors(name,specialization,fee,phone)
            VALUES('$name','$spec','$fee','$phone')
        ");
        header("Location: manage_doctors.php");
        exit();
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h4>Add Doctor</h4>
        </div>

        <div class="card-body">

            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="name" placeholder="Doctor Name" class="form-control mb-3" required>
                <input type="text" name="specialization" placeholder="Specialization" class="form-control mb-3" required>
                <input type="number" name="fee" placeholder="Consultation Fee" class="form-control mb-3" required>
                <input type="tel" name="phone" placeholder="Phone Number" class="form-control mb-3" required>

                <!-- FIXED: Added name="add" to the submit button -->
                <button type="submit" name="add" class="btn btn-success">Add Doctor</button>
            </form>

        </div>
    </div>
</div>

</body>

</html>