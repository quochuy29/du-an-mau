<?php
session_start();
require_once '../lib/db.php';
require_once "../lib/common.php";
// checkAuth();
// lấy id trên đường dẫn xuống
$productsId = isset($_GET['ma_hh']) ? $_GET['ma_hh'] : -1;

// kiểm tra xem id có tồn tại trong db hay không 
$connect = getDbConnect();
$getproductsByIdQuery = "select * from products where ma_hh = $productsId";
$stmt = $connect->prepare($getproductsByIdQuery);
$stmt->execute();
$products = $stmt->fetch(); 

if(!$products){
    header("location: " . BASE_URL_5 . "?msg=Sản phẩm không tồn tại");
    die;
}
// 1. Nhận dữ liệu từ request
$name = $_POST['name'];
$nameErr = "";

$don_gia = $_POST['don_gia'];
$don_giaErr = "";

$sale = $_POST['sale'];
$saleErr = "";

$image = $_FILES['image'];
$imageErr = "";
$tenloai = $_POST['tenloai'];

$hang_db = ($_POST['hang_db']);

$ngay_nhap = $_POST['ngay_nhap'];
$ngay_nhapErr = "";

$luot_xem = $_POST['luot_xem'];

$mo_ta = $_POST['mo_ta'];
$mo_taErr = "";

$ky_gui = $_POST['ky_gui'];
// 2. Kiểm tra dữ liệu (validate)
// ktra rỗng
if(strlen($name) == 0){
    $nameErr = "Hãy nhập tên sản phẩm";
}
 //ktra giá trị
if($don_gia == ""){
    $don_giaErr = "Hãy nhập vào giá";
}else if($don_gia < 0){
    $don_giaErr = "Hãy nhập lại giá";
}

if($sale == ""){
    $saleErr = "Hãy nhập đơn giá sale";
}else if($sale < 0){
    $saleErr = "Hãy nhập lại đơn giá sale";
}

if($ngay_nhap == ""){
    $ngay_nhapErr = "Vui lòng nhập ngày tháng !";
}elseif(strtotime($ngay_nhap) && 1 === preg_match('~[0-9]~', $ngay_nhap)){
    //
}else {
    $ngay_nhapErr = "Ngày tháng không hợp lệ !";
}
// 3. Xử lý dữ liệu (bao gồm lưu ảnh)
$path = $products['image'];

// 3.1 thực hiện lưu ảnh
if($image['size']<1500000 && $image['size']>0){
    $filename = uniqid() . "-" . $image["name"];
    move_uploaded_file($image["tmp_name"], '../publics/uploads/' . $filename);
    $path = 'publics/uploads/' . $filename;
    $expensions= array("jpeg","jpg","png","bmp");
    $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
    if(in_array($file_ext,$expensions)=== false){
    $imageErr = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
    }
}
if($nameErr.$don_giaErr.$saleErr.$ngay_nhapErr.$imageErr.$mo_taErr != ""){
    header('location: ' . BASE_URL . "products/sua.php?ma_hh=$productsId&nameerr=$nameErr&don_giaerr=$don_giaErr&ngay_nhaperr=$ngay_nhapErr&saleerr=$saleErr&imageerr=$imageErr&mo_taerr=$mo_taErr");
    die;
}
// 4. Tạo câu query để insert data
$updateProductsSql = "update products 
                        set 
                           name = '$name',
                           don_gia = '$don_gia',
                           sale = '$sale',
                           image = '$path',
                           tenloai = '$tenloai',
                           hang_db = '$hang_db',
                           ngay_nhap = '$ngay_nhap',
                           luot_xem = '$luot_xem',
                           mo_ta = '$mo_ta',
                           ky_gui = '$ky_gui'
                    where ma_hh = $productsId ";
                    // 5. Thực thi câu query với csdl
$stmt = $connect->prepare($updateProductsSql);
$stmt->execute();

// 6. Điều hướng về trang danh sách
header("location: " . BASE_URL_5 . "?msg=Lưu sửa sản phẩm thành công");


?>