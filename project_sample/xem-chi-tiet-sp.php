<?php
 session_start();
 require_once "./lib/db.php";
 require_once "./lib/common.php";
 checkAuths();
$ma_hh = $_GET['ma_hh'];
$ma_hhErr = "";
if(is_numeric($ma_hh) == false){
    $ma_hhErr = "Không phải kiểu chữ";
    header("location: " . BASE_URL_5 . "?msc=$ma_hhErr");
    die;
}
$getProductQuery ="select
                          p.*,
                          c.ten_loai as cate_loai
                    from products p 
                    join sectors c
                     on p.tenloai = c.ma_loai where ma_hh = $ma_hh";

$connect = getDbConnect();
$stmt = $connect->prepare($getProductQuery);
$stmt->execute();
$products = $stmt->fetchAll();

if(!$products){
    header("location: " . BASE_URL_5 . "?msg=Sản phẩm không tồn tại");
    die;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bình luận</title>
    <?php include_once "./_share/style.php" ?>
</head>

<body>
    <?php include_once "./_share/header.php" ?><br><br>
    <main class="container-fluid">
        <div class="container">
            <?php
                        foreach($products as $key => $cursors){
                            ?>
            <div class="sp" style="display: grid;
    grid-template-columns: 1fr 1fr;">
                <div class="image"><img width=300 src="<?= BASE_URL . $cursors['image'] ?>" class="img-fluid"></div>
                <div class="info">
                    <h2><?= $cursors['name'] ?></h2>
                    <p>Giá : <?= number_format($cursors['don_gia'])." ".'VNĐ' ?></p>
                    <p>Sale : <?= $cursors['sale'] .'%' ?></p>
                    <p>Danh mục : <?= $cursors['cate_loai'] ?></p>
                    <p>Loại hàng : <?= ($cursors['hang_db'])?"Đặc biệt":"Bình thường" ?></p>
                    <p>Hàng ký gửi : <?= ($cursors['ky_gui'])?"Ký gửi":"Hàng bán" ?></p>
                    <p>Ngày nhập : <?= datetimeConvert($cursors['ngay_nhap'], "d/m/Y")?></p>
                    <p>Số lượt xem : <?= $cursors['luot_xem'] ?></p>
                    <p>Mô tả : <?= $cursors['mo_ta'] ?></p>
                </div>
            </div>
            <div class="mission" style="float:right;">
                <a href="<?= BASE_URL?>products/sua.php?ma_hh=<?= $cursors['ma_hh'] ?>" class="btn btn-info btn-sm">
                    Sửa
                </a>
                <a onclick="return confirm('bạn có chắc muốn xóa tài khoản này?')"
                    href="<?= BASE_URL?>products/xoa.php?ma_hh=<?= $cursors['ma_hh'] ?>" class="btn btn-danger btn-sm">
                    Xóa
                </a>
            </div>
            <?php
                        }
                ?>
        </div>
    </main>
</body>

</html>