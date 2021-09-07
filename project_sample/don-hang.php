<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
checkAuths();
// lấy dữ liệu từ trên url => keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
$msg = isset($_GET['msg'])?$_GET['msg']:"";
// query lấy danh sách user từ db

$getOrderQuery = "select * from orders_products";

if($keyword !== ""){
    $getOrderQuery .= " where ten_hh like '%$keyword%' ";
}

$connect = getDbConnect();
$stmt = $connect->prepare($getOrderQuery);
$stmt->execute();
$orders = $stmt->fetchAll();

$ma_kh = $_SESSION['auth']['ma_kh'];
$getUserQuery = "select number_phone from users where ma_kh = '$ma_kh'";

$connect = getDbConnect();
$stmt = $connect->prepare($getUserQuery);
$stmt->execute();
$user = $stmt->fetchColumn();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <?php include_once "./_share/style.php" ?>
</head>

<body>
    <?php include_once "./_share/header.php" ?>
    <main class="container-fluid">
        <!-- Hiển thị danh sách users -->
        <div class="container">
            <br>
            <form action="" method="get">
                <div class="form-group row">
                    <label for="" class="col-sm-1 col-form-label">Từ khóa</label>
                    <div class="col-sm-4">
                        <input type="text" name="keyword" class="form-control" value="<?= $keyword ?>">
                    </div>
                </div>
            </form>
            <h1 style="text-align:center;color:red;"><?= $msg?></h1>
            <table class="table table-stripped">
                <thead>
                    <th>Mã khách hàng</th>
                    <th>Tên hàng hóa</th>
                    <th width="70">Ảnh hàng hóa</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Số lượng</th>
                    <th>Yêu cầu</th>
                    <th>Tổng giá</th>
                </thead>
                <tbody>
                    <?php foreach($orders as $key => $cursor): ?>
                    <tr>
                        <td><?= $cursor['ma_kh'] ?></td>
                        <td><?= $cursor['ten_hh'] ?></td>
                        <td><img width=50 height=50 src="<?= BASE_URL . $cursor['image'] ?>" class="img-fluid"></td>
                        <td><?= $cursor['dia_chi'] ?></td>
                        <td><?= $user?></td>
                        <td><?= $cursor['so_luong'] ?></td>
                        <td><?= $cursor['yeu_cau'] ?></td>
                        <td><?= number_format($cursor['so_luong']*$cursor['gia']) ?></td>
                        <td><a onclick="return confirm('bạn có chắc muốn xóa tài khoản này?')"
                                href="<?= BASE_URL?>xoa-don-hang.php?id=<?= $cursor['id'] ?>"
                                class="btn btn-danger btn-sm">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>