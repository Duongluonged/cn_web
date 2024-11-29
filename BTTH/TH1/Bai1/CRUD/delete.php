<?php
include 'db.php';

// Kiểm tra ID
if (!isset($_GET['id'])) {
    echo "ID không hợp lệ.";
    exit();
}

$id = $_GET['id'];

// Xóa hoa từ cơ sở dữ liệu
$sql = "DELETE FROM flowers WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: admin.php");
    exit();
} else {
    echo "Lỗi khi xóa: " . $conn->error;
}
