<?php
session_start();
include 'config.php';

if (!isset($_SESSION['ses_username']) || $_SESSION['ses_status'] != 'admin') {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

$selected_month = isset($_GET['month']) ? $_GET['month'] : date('m');
$selected_year = isset($_GET['year']) ? $_GET['year'] : date('Y');

$sql = "SELECT 
            users.username AS user_name, 
            rooms.name AS room_name, 
            bookings.check_in_date, 
            bookings.check_out_date, 
            DATEDIFF(bookings.check_out_date, bookings.check_in_date) AS duration, 
            bookings.payment_type 
        FROM bookings 
        JOIN users ON bookings.user_id = users.id 
        JOIN rooms ON bookings.room_id = rooms.id 
        WHERE MONTH(bookings.check_in_date) = '$selected_month' 
        AND YEAR(bookings.check_in_date) = '$selected_year'";

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Monthly Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .no-print {
            display: none;
        }
    </style>
</head>
<body>
    <h2>Monthly Report for <?php echo date('F', mktime(0, 0, 0, $selected_month, 10)); ?> <?php echo $selected_year; ?></h2>
    <table>
        <thead>
            <tr>
                <th>User Name</th>
                <th>Room Name</th>
                <th>Check-In Date</th>
                <th>Check-Out Date</th>
                <th>Duration (days)</th>
                <th>Payment Type</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($booking = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $booking['user_name']; ?></td>
                    <td><?php echo $booking['room_name']; ?></td>
                    <td><?php echo $booking['check_in_date']; ?></td>
                    <td><?php echo $booking['check_out_date']; ?></td>
                    <td><?php echo $booking['duration']; ?></td>
                    <td><?php echo $booking['payment_type']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br> 
<div> 
  <b>Kudus, <?php echo date("d-m-Y"); ?></b> 
  <br><br><br><br> 
  <u>Admin Kost</u> 
<div> 
</body>
<script> 
//perintah untuk cetak di browser 
window.print(); 
</script>
</html>
