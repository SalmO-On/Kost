<?php
session_start();
include 'config.php';

if (!isset($_SESSION['ses_username']) || $_SESSION['ses_status'] != 'admin') {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

if (isset($_GET['id'])) {
    $room_id = $_GET['id'];
    $sql = "DELETE FROM rooms WHERE id='$room_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Room deleted successfully.');
        window.location.href='admin_rooms.php';
        </script>";
    } else {
        echo "<script>
        alert('Error: " . $sql . "<br>" . $conn->error . "');
        window.location.href='admin_rooms.php';
        </script>";
    }

    $conn->close();
} else {
    echo "<script>
    alert('Invalid room ID.');
    window.location.href='admin_rooms.php';
    </script>";
}
?>
