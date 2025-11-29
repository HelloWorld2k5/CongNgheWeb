<?php

require 'Database.php';
require 'FlowerManager.php';

$db = new Database();
$manager = new FlowerManager($db);

if (!$manager->existsTable()) {
    $flowers = [
        [
            'name' => 'Hoa đỗ quyên',
            'desc' => 'Hoa đẹp, nhiều màu sắc',
            'src' => './Bai1/hoadep/doquyen.jpg'
        ],
        [
            'name' => 'Hoa hải đường',
            'desc' => 'Cánh mỏng manh, xếp lớp nhẹ nhàng như những gợn sóng, tạo nên sự mềm mại và quyến rũ',
            'src' => './Bai1/hoadep/haiduong.jpg'
        ],
        [
            'name' => 'Hoa mai',
            'desc' => 'Thân cây cứng cáp, khỏe mạnh được khoác lên một lớp áo màu nâu sẫm',
            'src' => './Bai1/hoadep/mai.jpg'
        ],
        [
            'name' => 'Hoa tường vy',
            'desc' => 'Màu hoa hồng cánh sen và có hương thơm mạnh',
            'src' => './Bai1/hoadep/tuongvy.jpg'
        ]
    ];

    foreach ($flowers as $flower) {
        $manager->addFlower($flower['name'], $flower['desc'], $flower['src']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hoa đẹp (Client)</title>
</head>
<body>

    <?php 
    
    $flowers = $manager->getAllFlowers();
    
    ?>

    <div class="wrapper">
        <header class="header-content">
            <h1>Top những loại hoa đẹp thích hợp trồng vào ngày Tết</h1>
        </header>

        <main class="main-content">
            <ul class="flower-list">
                <?php foreach ($flowers as $key => $flower) :  ?>
                    <li class="flower-item">
                        <h3 class="name"><?php echo $key + 1 . '. ' . $flower['Name'] ?></h3>
                        <p class="desc"><?php echo $flower['Description'] ?></p>
                        <img src="<?php echo $flower['Src'] ?>" alt="<?php echo $flower['Name'] ?>">
                    </li>
                <?php endforeach; ?>
            </ul>

            <form action="index.php" method="get">
                <input type="submit" value="Chỉnh sửa danh sách hoa" name="submit">
            </form>
        </main>

        <?php 
        
        if (isset($_GET['submit'])) {
            header('Location: admin.php');
            exit();
        }
        
        ?>
    </div>
</body>
</html>