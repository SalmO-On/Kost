<?php
session_start();
include 'config.php';

if (!isset($_SESSION['ses_username'])) {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

$user_id = $_SESSION['ses_user_id'];
$sql_rooms = "SELECT * FROM rooms WHERE available_rooms > 0";
$result_rooms = $conn->query($sql_rooms);

$alertMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $payment_type = $_POST['payment_type'];

    $conn->begin_transaction();

    try {
        $sql = "INSERT INTO bookings (user_id, room_id, booking_date, check_out_date, payment_type, payment_status) 
                VALUES ('$user_id', '$room_id', '$check_in_date', '$check_out_date', '$payment_type', 'Pending')";

        if ($conn->query($sql) === TRUE) {
            $update_rooms_sql = "UPDATE rooms SET available_rooms = available_rooms - 1 WHERE id='$room_id' AND available_rooms > 0";
            if ($conn->query($update_rooms_sql) === TRUE) {
                $conn->commit();
                $alertMessage = "Booking successful.";
            } else {
                throw new Exception("Error updating room availability: " . $conn->error);
            }
        } else {
            throw new Exception("Error: " . $sql . "<br>" . $conn->error);
        }
    } catch (Exception $e) {
        $conn->rollback();
        $alertMessage = $e->getMessage();
    }

    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Book a Room - D'OMAH KOST PUTRI</title>
    <script>
        function showAlert(message, redirectUrl) {
            alert(message);
            window.location.href = redirectUrl;
        }
    </script>
</head>
<body>
    <?php if ($alertMessage): ?>
        <script>
            showAlert("<?php echo $alertMessage; ?>", 'my_bookings.php');
        </script>
    <?php endif; ?>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-5"><i class="bi bi-arrow-left-circle"></i> Back</a>
        <h2>Book a Room</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="room_id" class="form-label">Room</label>
                <select class="form-control" id="room_id" name="room_id" required>
                    <?php while ($room = $result_rooms->fetch_assoc()): ?>
                        <option value="<?php echo $room['id']; ?>"><?php echo $room['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="check_in_date" class="form-label">Check-in Date</label>
                <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
            </div>
            <div class="mb-3">
                <label for="check_out_date" class="form-label">Check-out Date</label>
                <input type="date" class="form-control" id="check_out_date" name="check_out_date" required>
            </div>
            <div class="mb-3">
                <label for="payment_type" class="form-label">Payment Type</label>
                <select class="form-control" id="payment_type" name="payment_type" required>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Book Room</button>
        </form>
    </div>
</body>
</html>
