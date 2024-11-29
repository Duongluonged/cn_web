<?php
include 'db.php';

// Kiểm tra xem có ID được truyền vào không
if (!isset($_GET['id'])) {
    echo "ID không hợp lệ.";
    exit();
}

$id = $_GET['id'];

// Lấy thông tin hiện tại của hoa
$sql = "SELECT * FROM flowers WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows != 1) {
    echo "Hoa không tồn tại.";
    exit();
}

$flower = $result->fetch_assoc();

// Xử lý khi người dùng cập nhật thông tin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $flower['image']; // Giữ nguyên ảnh cũ nếu không thay đổi

    // Nếu có ảnh mới được tải lên
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "images/";
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
            echo "Không thể tải ảnh lên.";
            exit();
        }
    }

    // Cập nhật thông tin hoa
    $sql = "UPDATE flowers SET name = '$name', description = '$description', image = '$image' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa hoa</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Sửa Thông Tin Hoa</h1>
        <a href="admin.php" class="btn">Quay lại</a>
    </header>
    <main>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="name">Tên Hoa:</label>
            <input type="text" id="name" name="name" value="<?php echo $flower['name']; ?>" required>

            <label for="description">Mô Tả:</label>
            <textarea id="description" name="description" required><?php echo $flower['description']; ?></textarea>

            <label for="image">Thay Đổi Ảnh:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <p>Ảnh hiện tại:</p>
            <img src="<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>" width="100">

            <button type="submit" class="btn">Cập nhật</button>
        </form>
    </main>
</body>

</html>