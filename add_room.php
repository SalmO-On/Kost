<?php
session_start();
include 'config.php';

$alertMessage = "";

if (!isset($_SESSION['ses_username']) || $_SESSION['ses_status'] != 'admin') {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $available_rooms = $_POST['available_rooms'];

    $sql = "INSERT INTO rooms (name, description, price, available_rooms) VALUES ('$name', '$description', '$price', '$available_rooms')";

    if ($conn->query($sql) === TRUE) {
        $alertMessage = "Room added successfully.";
    } else {
        $alertMessage = "Error: " . $sql . "<br>" . $conn->error;
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Add Room - D'OMAH KOST PUTRI</title>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <?php if ($alertMessage): ?>
        <script>
            showAlert("<?php echo $alertMessage; ?>");
        </script>
    <?php endif; ?>
    <div class="container mt-5">
        <a href="admin_rooms.php" class="btn mb-5"><i class="bi bi-arrow-left-circle"></i> Back</a> <!-- tombol kembali -->
        <center>
            <h2>Add New Room</h2>
        </center>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="available_rooms" class="form-label">Available Rooms</label>
                <input type="number" class="form-control" id="available_rooms" name="available_rooms" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
