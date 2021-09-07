<?php
session_start();
require_once "../lib/db.php";
require_once "../lib/common.php";
checkAuth();
$sectorId = isset($_GET['ma_loai']) ? $_GET['ma_loai']: 0;

$connect = getDbConnect();
$getSectorByIdQuery = "select * from sectors where ma_loai = $sectorId";
$stmt = $connect->prepare($getSectorByIdQuery);
$stmt->execute();
$sectors = $stmt->fetch(); 
// fetch => tìm ra bản ghi đầu tiên thỏa mãn câu sql => [ 'id' => xxx, 'name' => 'xxx' ]
if(!$sectors){
    header("location: ".BASE_URL_4."?msg=Danh mục không tồn tại");
    die;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once "../_share/style.php" ?>
</head>

<body>
    <?php include_once "../_share/header.php" ?>
    <main class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <h3>Chỉnh sửa loại hàng</h3>
                    <form action="<?= BASE_URL ?>sectors/luu-sua-loai.php?ma_loai=<?= $sectors['ma_loai'] ?>"
                        method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Tên loại</label>
                            <input type="text" name="ten_loai" value="<?= $sectors['ten_loai'] ?>" class="form-control">
                            <?php if(isset($_GET['ten_loaierr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['ten_loaierr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                            <a href="<?= BASE_URL_4 ?>" class="btn btn-sm btn-danger">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>