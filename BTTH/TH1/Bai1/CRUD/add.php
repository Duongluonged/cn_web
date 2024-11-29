<?php
include 'db.php'; // Kết nối cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = '';

    // Kiểm tra và xử lý ảnh tải lên
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Đường dẫn lưu ảnh
        $targetDir = "images/"; // Thư mục lưu ảnh
        $image = $targetDir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

        // Kiểm tra loại file ảnh
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            echo "Chỉ chấp nhận các định dạng JPG, JPEG, PNG, GIF.";
            exit();
        }

        // Di chuyển ảnh tải lên vào thư mục
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
            echo "Không thể tải ảnh lên. Vui lòng kiểm tra quyền thư mục.";
            exit();
        }
    } else {
        echo "Vui lòng chọn ảnh hợp lệ.";
        exit();
    }

    // Chèn dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO flowers (name, description, image) VALUES ('$name', '$description', '$image')";
    if ($conn->query($sql) === TRUE) {
        // Nếu thành công, chuyển hướng về trang admin
        header("Location: admin.php");
        exit();
    } else {
        // Nếu có lỗi khi thêm dữ liệu vào cơ sở dữ liệu
        echo "Lỗi khi thêm hoa: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hoa</title>
    <link rel="stylesheet" href="Style.css">
</head>

<body>
    <header>
        <h1>Thêm loài hoa</h1>
        <a href="admin.php" class="btn">Quay lại</a>
    </header>
    <main>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="name">Tên Hoa:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Mô Tả:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="image">Tải lên Ảnh:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit" class="btn">Thêm</button>
        </form>
    </main>
</body>

</html>