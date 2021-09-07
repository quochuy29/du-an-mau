<?php
session_start();
require_once "../lib/db.php";
require_once "../lib/common.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách loại hàng</title>
    <?php include_once "../_share/style.php" ?>
</head>

<body>
    <?php include_once "../_share/header.php" ?>
    <main class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <h3>Tạo loại hàng</h3>
                    <form action="<?= BASE_URL ?>sectors/luu-tao-moi.php" method="post">
                        <div class="form-group">
                            <label for="">Tên loại</label>
                            <input type="text" class="form-control" name="ten_loai">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                            <a href="<?= BASE_URL ?>" class="btn btn-sm btn-danger">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>