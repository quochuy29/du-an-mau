<?php
 session_start();
 require_once "./lib/db.php";
 require_once "./lib/common.php";
 checkAuths();
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
                    
$name = $_GET['name'];

$getOrderQuery = "select * from orders_products ";

if($keyword !== ""){
    $getOrderQuery .= " where noi_dung like '%$keyword%' or ma_kh like '%$keyword%' ";
}
$connect = getDbConnect();
$stmt = $connect->prepare($getOrderQuery);
$stmt->execute();
$Order = $stmt->fetchAll();

$getOrderQuery ="select * from orders_products where ten_hh = '$name'";

$connect = getDbConnect();
$stmt = $connect->prepare($getOrderQuery);
$stmt->execute();
$Orders = $stmt->fetchAll();

if(!$Orders){
    header("location: " . BASE_URL_14 . "?msg=Đơn hàng không tồn tại");
    die;
}

$getProductQuery ="select * from products where name = '$name'";

$connect = getDbConnect();
$stmt = $connect->prepare($getProductQuery);
$stmt->execute();
$products = $stmt->fetchAll();

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
    <title>Danh sách bình luận</title>
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
            <table class="table table-stripped">
                <thead>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Số lượng</th>
                    <th>Yêu cầu</th>
                    <th>Tác vụ</th>
                </thead>
                <tbody>
                    <?php
                    foreach($Orders as $key => $cursor){
                        foreach($products as $key => $cursors){
                            ?>
                    <tr>
                        <td><?= $cursors['name'] ?></td>
                        <td><img width=50 height=50 src="<?= BASE_URL . $cursors['image'] ?>" class="img-fluid"></td>
                        <td><?= $cursor['dia_chi'] ?></td>
                        <td><?= $user ?></td>
                        <td><?= $cursor['so_luong'] ?></td>
                        <td><?= $cursor['yeu_cau'] ?></td>
                        <td>
                            <a href="<?= BASE_URL?>comment/xoa.php?ma_b=<?= $cursor['ma_b'] ?>&ma_hh=<?= $ma_hh ?>"
                                class="btn btn-info btn-sm">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>