<?php
include "db.php";

if(isset($_GET['id'])){

$id = intval($_GET['id']);

$sql = "DELETE FROM doctors WHERE id=$id";

if(mysqli_query($conn,$sql)){
    header("Location: manage_doctors.php");
    exit();
}else{
    echo "Error deleting doctor";
}

}else{

echo "Invalid Request";

}
?>