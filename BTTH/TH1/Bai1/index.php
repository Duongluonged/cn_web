<?php
include 'db.php';

// Truy vấn dữ liệu từ bảng flowers
$sql = "SELECT * FROM flowers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các loài hoa</title>
    <link rel="stylesheet" href="Style.css">
</head>

<body>
    <header>
        <h1>Danh sách các loài hoa</h1>
    </header>
    <main>
        <div class="flower-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="flower-card">
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="flower-img">
                        <h3><?php echo $row['name']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Không có loài hoa nào!</p>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>