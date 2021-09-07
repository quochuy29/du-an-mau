<?php
session_start();
require_once './lib/db.php';
require_once "./lib/common.php";
checkAuths();
//lấy id trên đường dẫn xuống
$commentId_hh = isset($_GET['ma_hh']) ? $_GET['ma_hh'] : 1;
$commentId_bl = isset($_GET['ma_b']) ? $_GET['ma_b'] : 1;


//kiểm tra xem id có tồn tại trong đó hay không
$connect = getDbConnect();
$getcommentByIdQuery = "delete from comment where ma_b = '$commentId_bl' and id_hh = '$commentId_hh' ";
$stmt = $connect->prepare($getcommentByIdQuery);
$stmt->execute();

header("location: http://localhost/php1/project_sample/chi-tiet.php?ma_hh=$commentId_hh");
?>