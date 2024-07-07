<?php
session_start();
include 'config.php';

if (!isset($_SESSION['ses_username']) || $_SESSION['ses_status'] != 'admin') {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

// Mengambil data sesuai id
if (isset($_GET['id'])) {
    $room_id = $_GET['id'];
    $sql = "SELECT * FROM rooms WHERE id='$room_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
    } else {
        echo "Room not found. <a href='admin_rooms.php'>Back to Manage Rooms</a>";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $available_rooms = $_POST['available_rooms'];

    // Perintah update data
    $sql = "UPDATE rooms SET name='$name', description='$description', price='$price', available_rooms='$available_rooms' WHERE id='$room_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Room updated successfully.');
        window.location.href='admin_rooms.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Edit Room - D'OMAH KOST PUTRI</title>
</head>
<body>
    <div class="container mt-5">
        <a href="admin_rooms.php" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left-circle"></i> Back to Manage Rooms</a> <!-- tombol kembali -->
        <h2>Edit Room</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($room['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($room['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($room['price']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="available_rooms" class="form-label">Available Rooms</label>
                <input type="number" class="form-control" id="available_rooms" name="available_rooms" value="<?php echo htmlspecialchars($room['available_rooms']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Room</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
