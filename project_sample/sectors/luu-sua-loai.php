<?php
session_start();
require_once '../lib/db.php';
require_once "../lib/common.php";
checkAuth();
// lấy id trên đường dẫn xuống
$sectorId = isset($_GET['ma_loai']) ? $_GET['ma_loai'] : -1;
// kiểm tra xem id có tồn tại trong db hay không 
$connect = getDbConnect();
$getSectorByIdQuery = "select * from sectors where ma_loai = $sectorId";
$stmt = $connect->prepare($getSectorByIdQuery);
$stmt->execute();
$sectors = $stmt->fetch();

// 1. Nhận dữ liệu từ request

$ten_loai = $_POST['ten_loai'];
$ten_loaiErr = "";

if($ten_loai == ""){
    $ten_loaiErr = "Hãy nhập tên loại";
}
if($ten_loaiErr === "" && (strlen($ten_loai) < 3 || strlen($ten_loai) > 50)){
    $ten_loaiErr = "Độ dài họ và tên nằm trong khoảng 3 - 50 ký tự";
}
if($ten_loaiErr != ""){
    header('location: ' . BASE_URL . "sectors/tao-loai-moi.php?ten_loaierr=$ten_loaiErr");
    die;
}
// 4. Tạo câu query để insert data
$insertQuery = "update sectors 
                    set
                        ten_loai = '$ten_loai'
                where ma_loai = $sectorId";

                    // 5. Thực thi câu query với csdl
$connect = getDbConnect();
$stmt = $connect->prepare($insertQuery); // nạp câu sql query vào trong kết nối
$stmt->execute(); // thực thi lệnh với csdl
// 6. Điều hướng về trang danh sách
header("location: " . BASE_URL_4 . "?msg=Lưu sửa loại hàng thành công");


?>