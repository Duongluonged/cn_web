<?php
include 'db.php';

// Lấy dữ liệu hoa từ bảng flowers
$sql = "SELECT * FROM flowers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị hoa</title>
    <link rel="stylesheet" href="Style.css">
</head>

<body>
    <header>
        <h1>Quản trị danh sách hoa</h1>
        <a href="add.php" class="btn">Thêm loài hoa</a>
    </header>
    <main>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Hoa</th>
                    <th>Mô Tả</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td>
                                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="50">
                            </td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn">Sửa</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Chưa có loài hoa nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>

</html>