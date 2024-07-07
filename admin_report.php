<?php
session_start();
include 'config.php';

if (!isset($_SESSION['ses_username']) || $_SESSION['ses_status'] != 'admin') {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

$selected_month = isset($_POST['month']) ? $_POST['month'] : date('m');
$selected_year = isset($_POST['year']) ? $_POST['year'] : date('Y');

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
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Monthly Report - D'OMAH KOST PUTRI</title>
</head>
<body>
    <div class="container mt-5">
        <a href="index.php" class="btn mb-5"><i class="bi bi-arrow-left-circle"></i> Back</a> <br>
        <center>
            <h2>Monthly Report</h2>
        </center>
        
        <form method="post" action="">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="month" class="form-label">Month</label>
                    <select class="form-control" id="month" name="month">
                        <?php 
                        for ($m=1; $m<=12; $m++) {
                            $month = date('m', mktime(0, 0, 0, $m, 1, date('Y')));
                            $month_name = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                            echo "<option value='$month'".($selected_month == $month ? " selected" : "").">$month_name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="year" class="form-label">Year</label>
                    <select class="form-control" id="year" name="year">
                        <?php 
                        $current_year = date('Y');
                        for ($y=$current_year-5; $y<=$current_year; $y++) {
                            echo "<option value='$y'".($selected_year == $y ? " selected" : "").">$y</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Room Name</th>
                    <th>Booking Date</th>
                    <th>Check-out Date</th>
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
        <a href="print_report.php?month=<?php echo $selected_month; ?>&year=<?php echo $selected_year; ?>" class="btn btn-primary" target="_blank">Print</a>
    </div>
</body> 
</body> 
</html>
