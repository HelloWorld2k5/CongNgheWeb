<?php

require 'Database.php';
require 'StudentManager.php';

$db = new Database();
$manager = new StudentManager($db);

if (!$manager->existsTable()) {
    $file = fopen('65HTTT_Danh_sach_diem_danh.csv', 'r');
    $header = fgets($file);

    $index = 0;

    while (!feof($file)) {
        $line = trim(fgets($file));

        if ($line === '') {
            continue;
        }
        
        $student = explode(',', $line);
        $manager->addStudent($student[0], $student[1], $student[2], $student[3], $student[4], $student[5], $student[6]);
    }

    fclose($file);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản sinh viên Trường Đại Học Thuỷ Lợi</title>
    <style>
        * {
            box-sizing: border-box;
        }

        table, th, td {
            border-collapse: collapse;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <?php 
    
    $students = $manager->getAllStudents();
    
    ?>

    <div class="wrapper">
        <header class="header-content">
            <h1>Danh sách tài khoản sinh viên Trường Đại Học Thuỷ Lợi</h1>
        </header>

        <main class="main-content">
            <table class="table">
                <thead>
                    <th>STT</th>
                    <th>User name</th>
                    <th>Password</th>
                    <th>Last name</th>
                    <th>First name</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Course 1</th>
                </thead>
                <tbody>
                    <?php foreach ($students as $key => $student) : ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $student['UserName']; ?></td>
                            <td><?php echo $student['Pass']; ?></td>
                            <td><?php echo $student['LastName']; ?></td>
                            <td><?php echo $student['FirstName']; ?></td>
                            <td><?php echo $student['City']; ?></td>
                            <td><?php echo $student['Email']; ?></td>
                            <td><?php echo $student['Course1']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>