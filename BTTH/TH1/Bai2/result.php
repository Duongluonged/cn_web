<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài làm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kết quả bài làm</h1>
        <?php
        // Đọc file câu hỏi để lấy đáp án
        $filename = "question.txt";
        $question = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $answers = [];
        foreach ($question as $line) {
            if (strpos($line, "Đáp án:") !== false) {
                $answers[] = trim(substr($line, strpos($line, ":") + 1));
            }
        }

        // Tính điểm
        $score = 0;
        foreach ($_POST as $key => $userAnswer) {
            $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
            if (isset($answers[$questionNumber - 1]) && $answers[$questionNumber - 1] === $userAnswer) {
                $score++;
            }
        }

        echo "<div class='alert alert-success text-center'>";
        echo "Bạn trả lời đúng <strong>$score</strong>/" . count($answers) . " câu.";
        echo "</div>";
        ?>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Làm lại</a>
        </div>
    </div>
</body>
</html>
