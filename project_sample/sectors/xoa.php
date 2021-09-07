<?php
session_start();
require_once '../lib/db.php';
require_once "../lib/common.php";
checkAuth();
//lấy id trên đường dẫn xuống
$sectorId = isset($_GET['ma_loai']) ? $_GET['ma_loai'] : -1;

//kiểm tra xem id có tồn tại trong đó hay không
$connect = getDbConnect();
$getSectorByIdQuery = "delete from sectors where ma_loai = $sectorId";
$stmt = $connect->prepare($getSectorByIdQuery);
$stmt->execute();
$sectors = $stmt->fetch();
if(!$sectors){
    header("location: ".BASE_URL_4."?msg=Danh mục không tồn tại");
    die;
}else{
    header("location: ".BASE_URL_4."?msg=Xóa danh mục thành công");
}
?>