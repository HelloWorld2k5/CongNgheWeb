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

if (isset($_POST['submit'])) {

    //Them
    if ($_POST['submit'] === 'Thêm') {
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $src = $_POST['src'];

        if ($name === '' || $desc === '' || $src === '') {
            exit();
        }

        $manager->addFlower($name, $desc, $src);
    }

    //Sửa chưa làm được

    //Xoa
    if ($_POST['submit'] === 'Xoá') {
        $id = $_POST['id'];

        $manager->deleteFlower($id);
    }

    header('Location: admin.php');
    exit();
}

$flowers = $manager->getAllFlowers();

if (isset($_GET['submit'])) {
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hoa đẹp (Admin)</title>
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
    <div class="wrapper">
        <header class="header-content">
            <h1>Top những loại hoa đẹp thích hợp trồng vào ngày Tết</h1>
        </header>

        <main class="main-content">
            <form action="admin.php" class="add-form" method="post">
                <div class="input-group">
                    <label>Tên loại hoa</label>
                    <input type="text" name="name" >
                </div>
                <div class="input-group">
                    <label>Mô tả loại hoa</label>
                    <input type="text" name="desc" >
                </div>
                <div class="input-group">
                    <label>Link ảnh</label>
                    <input type="url" name="src" >
                </div>
                <div class="btn-group">
                    <input type="submit" value="Thêm" name="submit">
                    <input type="submit" value="Sửa" name="submit">
                </div>
            </form>

            <table class="table">
                <thead>
                    <th>STT</th>
                    <th>Tên loại hoa</th>
                    <th>Mô tả hoa</th>
                    <th>Link ảnh</th>
                    <th>Xoá</th>
                    <th>Sửa</th>
                </thead>
                <tbody>
                    <?php foreach ($flowers as $key => $flower) : ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $flower['Name'] ?></td>
                            <td><?php echo $flower['Description'] ?></td>
                            <td><?php echo $flower['Src'] ?></td>
                            <td>
                                <form action="admin.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $flower['ID'] ?>">
                                    <input type="submit" value="Xoá" name="submit">
                                </form>
                            </td>
                            <td>
                                <form action="admin.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $flower['ID'] ?>">
                                    <input type="submit" value="Sửa" name="submit">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <form action="admin.php" method="get">
                <input type="submit" value="về trang chủ" name="submit">
            </form>
        </main>
    </div>
</body>
</html>