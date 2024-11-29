<!DOCTYPE html>
<html>
<head>
    <title>Danh sách tài khoản</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Danh sách tài khoản</h1>
    <?php
        // Đọc file CSV
        $file = 'c:\Users\luong\OneDrive\Tài liệu\Duongweb.csv'; // Thay đổi tên file nếu cần

        if (!file_exists($file)) {
            echo "File CSV không tồn tại!";
            exit;
        }

        $rows = [];
        if (($handle = fopen($file, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $rows[] = $data;
            }
            fclose($handle);
        } else {
            echo "Không thể mở file CSV!";
            exit;
        }

        // Hiển thị dữ liệu dưới dạng bảng HTML
        echo '<table>';
        echo '<tr><th>Username</th><th>Password</th><th>Lastname</th><th>Firstname</th><th>City</th><th>Email</th><th>Course</th></tr>';
        foreach ($rows as $row) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . $cell . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
?>
</body>
</html>