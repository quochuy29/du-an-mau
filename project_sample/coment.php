<?php
 session_start();
 require_once "./lib/db.php";
 require_once "./lib/common.php";
 checkAuths();
 $msg = isset($_GET['msg'])?$_GET['msg']:"";
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
                
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
            <h1 style="text-align:center;color:red;"><?= $msg?></h1>
            <table class="table table-stripped">
                <thead>
                    <th>Mã sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Số bình luận</th>
                    <th>Ngày bình luận</th>
                </thead>
                <tbody>
                    <?php 
                    
                    $getCommentQuery = "select distinct id_hh from comment";
                    if($keyword !== ""){
                        $getCommentQuery .= " where id_hh = '$keyword' ";
                    }
                    
                    $connect = getDbConnect();
                    $stmt = $connect->prepare($getCommentQuery);
                    $stmt->execute();
                    $commented = $stmt->fetchAll();
                    
                    foreach ($commented as $keys => $cursor){
                        $id_hh = $cursor['id_hh'];
                        $getCommentQuery = "select * from products where ma_hh = '$id_hh'";
                    
                    $connect = getDbConnect();
                    $stmt = $connect->prepare($getCommentQuery);
                    $stmt->execute();
                    $products2 = $stmt->fetchAll();

                        foreach ($products2 as $keys => $cursorser){
                            $getCommentQuery = "select count(*) from comment where id_hh = '$id_hh'";
                    
                    $connect = getDbConnect();
                    $stmt = $connect->prepare($getCommentQuery);
                    $stmt->execute();
                    $comment2 = $stmt->fetchColumn();//trả về một cột từ hàng tiếp theo của tập kết quả
                    $getCommentQuery = "select * from comment where id_hh = '$id_hh' order by ma_b desc limit 1";
                    
                    $connect = getDbConnect();
                    $stmt = $connect->prepare($getCommentQuery);
                    $stmt->execute();
                    $commentv = $stmt->fetchAll();
                            foreach ($commentv as $keys => $cursorse){
                        ?>
                    <tr>
                        <td><?= $cursor['id_hh'] ?></td>
                        <td><img width=50 height=50 src="<?= BASE_URL . $cursorser['image'] ?>" class="img-fluid"></td>
                        <td><?= $comment2 ?></td>
                        <td><?= $cursorse['ngay_bl'] ?></td>
                        <td>
                            <a href="<?= BASE_URL?>comment/xem-chi-tiet.php?ma_hh=<?= $cursor['id_hh'] ?>"
                                class="btn btn-info btn-sm">
                                Xem chi tiết
                            </a>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>