<?php
session_start();
include 'config.php';

if (!isset($_SESSION['ses_username'])) {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['room_id'])) {
    $user_id = $_SESSION['ses_user_id'];
    $room_id = $_GET['room_id'];
//memasukan data yang dipilih
    $sql = "INSERT INTO bookings (user_id, room_id, booking_date) VALUES ('$user_id', '$room_id', NOW())";
    if ($conn->query($sql) === TRUE) {
        $sql_update = "UPDATE rooms SET available = FALSE WHERE id = '$room_id'";
        $conn->query($sql_update);

        // Alert booking berhasil menggunakan JavaScript
        echo '<script>alert("Booking successful!");</script>';
        echo '<script>window.location.href = "my_bookings.php";</script>'; //pindah ke halaman my boking
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
