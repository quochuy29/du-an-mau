<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
checkAuths();
// lấy dữ liệu từ trên url => keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
$msg = isset($_GET['msg'])?$_GET['msg']:"";
// query lấy danh sách user từ db
$getOrderQuery = "select distinct ten_hh from orders_products";

if($keyword !== ""){
    $getOrderQuery .= " where ten_hh like '%$keyword%'";
}
$connect = getDbConnect();
$stmt = $connect->prepare($getOrderQuery);
$stmt->execute();
$orders = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê đơn đặt hàng</title>
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
                    <th>Tên hàng hóa</th>
                    <th width="70">Ảnh hàng hóa</th>
                    <th>Số lượng</th>
                </thead>
                <tbody>
                    <?php 

                    foreach($orders as $key => $cursor){
                        $ten_hh = $cursor['ten_hh'];
                        $getOrderQuery = "select * from products where name = '$ten_hh'";

                        $connect = getDbConnect();
                        $stmt = $connect->prepare($getOrderQuery);
                        $stmt->execute();
                        $order_p = $stmt->fetchAll();
                        
                        foreach($order_p as $key => $cursors){

                        $getOrderQuery = "select count(ma_kh) from orders_products where ten_hh = '$ten_hh'";

                        $connect = getDbConnect();
                        $stmt = $connect->prepare($getOrderQuery);
                        $stmt->execute();
                        $order_ps = $stmt->fetchColumn();
                     ?>
                    <tr>
                        <td><?= $cursors['name'] ?></td>

                        <td><img width=50 height=50 src="<?= BASE_URL . $cursors['image'] ?>" class="img-fluid"></td>
                        <td><?= $order_ps ?></td>
                        <td><a onclick="return confirm('bạn có chắc muốn xóa tài khoản này?')"
                                href="<?= BASE_URL?>xoa-don-hang.php?id=<?= $cursor['id'] ?>"
                                class="btn btn-danger btn-sm">
                                Xóa
                            </a>
                            <a href="<?= BASE_URL?>xem-chi-tiet.php?name=<?= $cursors['name'] ?>"
                                class="btn btn-info btn-sm">
                                Xem chi tiết
                            </a>
                        </td>
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>