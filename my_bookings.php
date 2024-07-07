<?php
session_start();
include 'config.php';

if (!isset($_SESSION['ses_username'])) {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

$user_id = $_SESSION['ses_user_id'];
$sql = "SELECT bookings.id, rooms.name AS room_name, bookings.check_in_date, bookings.check_out_date, bookings.payment_type, bookings.payment_status 
        FROM bookings 
        JOIN rooms ON bookings.room_id = rooms.id 
        WHERE bookings.user_id = '$user_id'";
$result = $conn->query($sql);

if ($result === false) {
    die("Error: " . $conn->error);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>My Bookings - D'OMAH KOST PUTRI</title>
</head>
<body>
    <div class="container mt-5">
    <button onclick="history.back()" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left-circle"></i> Back</button><br>
     <center>
     <h2>My Bookings</h2> 
     </center><br>
        
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Room Name</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Payment Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['room_name']; ?></td>
                            <td><?php echo $row['check_in_date']; ?></td>
                            <td><?php echo $row['check_out_date']; ?></td>
                            <td><?php echo $row['payment_type']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
