<?php
session_start();
require_once '../lib/db.php';
require_once "../lib/common.php";
// xử lý dữ liệu để tạo ra tk trong csdl
// 1. Nhận dữ liệu từ request
$ma_hh = $_GET['ma_hh'];

$name = $_POST['name'];
$nameErr = "";

$don_gia = $_POST['don_gia'];
$don_giaErr = "";

$sale = $_POST['sale'];
$saleErr = "";

$image = $_FILES['image'];
$imageErr = "";

$tenloai = $_POST['tenloai'];

$hang_db = ($_POST['hang_db'])?$_POST['hang_db']:0;

$ngay_nhap = $_POST['ngay_nhap'];
$ngay_nhapErr = "";

$luot_xem = $_POST['luot_xem'];

$mo_ta = $_POST['mo_ta'];
$mo_taErr = "";

$ky_gui = ($_POST['ky_gui'])?$_POST['ky_gui']:0;

// 2. Kiểm tra dữ liệu (validate)
// ktra rỗng
if(strlen($name) < 3){
    $nameErr = "Hãy nhập tên sản phẩm";
}
if($nameErr === "" && (strlen($name) < 3 || strlen($name) > 50)){
    $nameErr = "Độ dài họ và tên nằm trong khoảng 3 - 50 ký tự";
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

$tmp = explode('/',$ngay_nhap);
    $tmp = array_reverse($tmp);
    $ngaynhap = implode("-",$tmp);
if($ngaynhap == ""){
    $ngay_nhapErr = "Vui lòng nhập ngày tháng !";
}elseif(strtotime($ngaynhap) && 1 === preg_match('~[0-9]~', $ngaynhap)){
    //
}else {
    $ngay_nhapErr = "Ngày tháng không hợp lệ !";
}

if($mo_ta == ""){
    $mo_taErr = "Mô tả không được để rỗng !";
}
// 3. Xử lý dữ liệu (bao gồm lưu ảnh)
$path = "";
if($image['size']<1500000){
    $filename = uniqid() . "-" . $image["name"];
    move_uploaded_file($image["tmp_name"], '../publics/uploads/' . $filename);
    $path = 'publics/uploads/' . $filename;
    $expensions= array("jpeg","jpg","png","bmp");
    $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
    if(in_array($file_ext,$expensions)=== false){
    $imageErr = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
    }
}elseif($image['size'] == 0){
    $imageErr = "Chưa chọn ảnh đại diện";
}else{
    $imageErr = "Hình ảnh phải nhỏ hơn 1.5mb";
}

if($nameErr.$don_giaErr.$saleErr.$ngay_nhapErr.$imageErr.$mo_taErr != ""){
    header('location: ' . BASE_URL . "products/tao-sp.php?nameerr=$nameErr&don_giaerr=$don_giaErr&saleerr=$saleErr&ngay_nhaperr=$ngay_nhapErr&imageerr=$imageErr&mo_taerr=$mo_taErr");
    die;
}
// 4. Tạo câu query để insert data
$insertQuery = "insert into products 
                    (name, don_gia, sale, 
                    image, tenloai, hang_db, ngay_nhap, luot_xem, mo_ta, ky_gui)
                values 
                    ('$name', '$don_gia', '$sale', '$path', 
                    '$tenloai', '$hang_db', '$ngay_nhap', '$luot_xem', '$mo_ta' , '$ky_gui')";
                    // 5. Thực thi câu query với csdl
$connect = getDbConnect();// kết nối csdl
$stmt = $connect->prepare($insertQuery); // nạp câu sql query vào trong kết nối
$stmt->execute(); // thực thi lệnh với csdl
// 6. Điều hướng về trang danh sách
header("location: " . BASE_URL_5 . "?msg=Tạo mới sản phẩm thành công");
?>