<?php
session_start();
include 'config.php';

if (!isset($_SESSION['ses_username']) || $_SESSION['ses_status'] != 'admin') {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Manage Rooms - D'OMAH KOST PUTRI</title>
</head>
<body>
    <div class="container mt-5">
        <a href="index.php" class="btn mb-5"><i class="bi bi-arrow-left-circle"></i> Back</a> <br> <!-- tombol kembali -->
        <center><h2>Manage Rooms</h2></center>
        <a href="add_room.php" class="btn btn-primary mb-3 mt-3">Add New Room</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Available Rooms</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($room = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $room['name']; ?></td>
                        <td><?php echo $room['description']; ?></td>
                        <td><?php echo $room['price']; ?></td>
                        <td><?php echo $room['available_rooms']; ?></td>
                        <td>
                            <a href="edit_room.php?id=<?php echo $room['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_room.php?id=<?php echo $room['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this room?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
