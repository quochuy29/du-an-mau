<?php
session_start();
require_once '../lib/db.php';
require_once "../lib/common.php";
checkAuth();
//lấy id trên đường dẫn xuống
$productId = isset($_GET['ma_hh']) ? $_GET['ma_hh'] : -1;
$idErr = "";
if(is_numeric($productId) == false){
    $idErr = "Mã hàng hóa hông phải kiểu chữ";
    header("location: " . BASE_URL_5 . "?msc=$idErr");
    die;
}
//kiểm tra xem ma_hh có tồn tại trong đó hay không
$connect = getDbConnect();
$getproductByIdQuery = "delete from products where ma_hh = $productId";
$stmt = $connect->prepare($getproductByIdQuery);
$stmt->execute();
$products = $stmt->fetch();
if(!$products){
    header("location: ".BASE_URL_5."?msg=Hàng hóa không tồn tại");
    die;
}else{
    header("location: ".BASE_URL_5."?msg=Xóa hàng hóa thành công");
}
?>