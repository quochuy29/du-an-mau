<?php
session_start();
require_once "../lib/db.php";
require_once "../lib/common.php";
$getSectorDataQuery = "select * from sectors";
$connect = getDbConnect();
$stmt = $connect->prepare($getSectorDataQuery);
$stmt->execute();
$sectors = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT15317-web Assignment</title>
    <?php include_once "../_share/style.php" ?>
</head>

<body>
    <?php include_once "../_share/header.php" ?>
    <main class="container-fluid">
        <!-- Form tạo mới tk -->
        <h3>Tạo mới sản phẩm</h3>
        <form action="<?= BASE_URL ?>products/luu-tao-sp.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên hàng hóa</label>
                        <input type="text" name="name" class="form-control">
                        <?php if(isset($_GET['nameerr'])):?>
                        <span class="text-danger"><?= $_GET['nameerr'] ?></span>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="">Đơn giá</label>
                        <input type="number" name="don_gia" class="form-control">
                        <?php if(isset($_GET['don_giaerr'])):?>
                        <span class="text-danger"><?= $_GET['don_giaerr'] ?></span>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="">Sale</label>
                        <input type="text" name="sale" class="form-control">
                        <?php if(isset($_GET['saleerr'])):?>
                        <span class="text-danger"><?= $_GET['saleerr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Ảnh sản phẩm</label>
                        <input type="file" name="image" class="form-control">
                        <?php if(isset($_GET['imageerr'])):?>
                        <span class="text-danger"><?= $_GET['imageerr'] ?></span>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="">Tên loại</label>
                        <select name="tenloai">
                            <?php foreach ($sectors as $c):?>
                            <option value="<?= $c['ma_loai'] ?>">
                                <?= $c['ten_loai']?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Hàng đặc biệt</label>
                        <div>
                            <label><input name="hang_db" value="0" type="radio">Bình thường</label>
                            <label><input name="hang_db" value="1" type="radio" checked>Đặc biệt</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Hàng ký gửi</label>
                        <div>
                            <label><input name="ky_gui" value="1" type="radio">Hàng bán</label>
                            <label><input name="ky_gui" value="2" type="radio" checked>Ký gửi</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày nhập</label>
                        <input type="text" name="ngay_nhap" class="form-control">
                        <?php if(isset($_GET['ngay_nhaperr'])):?>
                        <span class="text-danger"><?= $_GET['ngay_nhaperr'] ?></span>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="">Lượt xem</label>
                        <input type="text" name="luot_xem" readonly value="0" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea name="mo_ta" rows="4" cols="85"></textarea><br>
                    <?php if(isset($_GET['mo_taerr'])):?>
                    <span class="text-danger"><?= $_GET['mo_taerr'] ?></span>
                    <?php endif ?>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                &nbsp;
                <a href="<?= BASE_URL_5 ?>" class="btn btn-sm btn-danger">Hủy</a>
            </div>
        </form>
    </main>
</body>

</html>