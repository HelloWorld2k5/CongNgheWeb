<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài thi trắc nghiệm lập trình</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php

    $file = fopen('Quiz.txt', 'r');

    $questions = [];

    $temp = [];


    while (!feof($file)) {
        $line = trim(fgets($file));

        if ($line === false) {
            fclose($file);
            exit();
        }

        if ($line === '') {
            $questions[] = $temp;
            $temp = [];
            continue;
        }

        if (strpos($line, 'ANSWER') !== false) {
            $subStr = substr($line, 8);
            $temp['answers'] = explode(', ', $subStr);
        } else if (strpos($line, 'A. ') !== false || strpos($line, 'B. ') !== false || strpos($line, 'C. ') !== false || strpos($line, 'D. ') !== false || strpos($line, 'E. ') !== false) {
            $temp['options'][] = $line;
        } else {
            $temp['question'] = $line;
        }
    }

    fclose($file);
    
    ?>

    <div class="wrapper">
        <header class="header-content">
            <h1>Phiếu bài thi trắc nghiệm lập trình</h1>
        </header>

        <main class="main-content">
            <ul class="question-list" >
                <?php foreach ($questions as $key => $question) : ?>
                    <li class="question-item">
                        <p class="question">Câu <?php echo $key + 1 . ': ' .  $question['question']; ?></p>
                        <ul class="option-list">
                            <?php foreach ($question['options'] as $option) : ?>
                                <li class="option-item"><input type="checkbox" 
                                    <?php foreach ($question['answers'] as $answer) {
                                        if ($answer == $option[0]) {
                                            echo 'checked';
                                            break;
                                        }
                                    } ?> >
                                    <?php echo $option ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <p class="answers">Đáp án là:
                            <?php 
                            foreach ($question['answers'] as $answer) {
                                echo " $answer";
                            }
                            ?>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </main>
    </div>

    
</body>
</html>