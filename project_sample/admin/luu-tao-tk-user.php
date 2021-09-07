<?php
session_start();
require_once './lib/db.php';
require_once "./lib/common.php";
// xử lý dữ liệu để tạo ra tk trong csdl
checkAuths();
// 1. Nhận dữ liệu từ request

$name = trim($_POST['name']);
$nameErr = "";

$ma_kh = $_POST['ma_kh'];
$ma_khErr = "";

$email = $_POST['email'];
$emailErr = "";

$password = $_POST['password'];
$passwordErr = "";

$cfpassword = $_POST['cfpassword'];
$cfpasswordErr = "";

$kich_hoat = ($_POST['kich_hoat'])?$_POST['kich_hoat']:0;

$avatar = $_FILES['avatar'];
$avatarErr = "";

$vai_tro = ($_POST['vai_tro'])?$_POST['vai_tro']:0;

$number_phone = $_POST['number_phone'];
$number_phoneErr = "";

$ngay_sinh = $_POST['ngay_sinh'];
$ngay_sinhErr = "";
// 2. Kiểm tra dữ liệu (validate)
// ktra rỗng
$patter = '/[!@#$%^&*(),.<>?:;"{}|]/';
$patt = "/['']/";
$pat = '/[[]/';
$pa = '/[]]/';
$patte = '/[^a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]/u';
if(strlen($name) == 0){
    $nameErr = "Hãy nhập họ và tên";
}elseif(!preg_match($patte,$name) || preg_match($patter,$name) || preg_match($patt,$name) || preg_match($pat,$name) || preg_match($pa,$name)){
    $nameErr = "Yêu cầu họ tên không có kí tự đặc biệt hoặc số";
}
// ktra số lượng ký tự
if($nameErr === "" && (strlen($name) < 4 || strlen($name) > 30)){
    $nameErr = "Độ dài họ và tên nằm trong khoảng 4 - 30 ký tự";
}
if($email == ""){
    $emailErr = "Hãy nhập email";
}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $emailErr = "Yêu cầu nhập đúng dạng email";
}
$ma_Kh = $_SESSION['auth']['ma_kh'];
if($ma_kh == ""){
    $ma_khErr = "Hãy nhập mã khách hàng";
}elseif($ma_kh == $ma_Kh){
    $ma_khErr = "Mã này đã có người sử dụng";
}
if(!preg_match("/^[a-zA-Z0-9]*$/",$ma_kh)){
    $ma_khErr = "Hãy nhập mã khách hàng không có kí tự đặc biệt";
}
if($ma_kh === "" && (strlen($ma_kh) < 4 || strlen($ma_kh) > 30)){
    $ma_khErr = "Độ dài mã khách hàng nằm trong khoảng 4 - 30 ký tự";
}
if(strlen($number_phone)>10){
    $number_phoneErr = "SĐT có độ dài 10 số !";
}
if(!preg_match('/^[0-9. ]*$/',$number_phone)){
    $number_phoneErr = "SĐT không chứa kí tự chữ";
}elseif($number_phone === "" && (strlen($number_phone) > 10 || strlen($number_phone) < 10)){
    $number_phoneErr = "SĐT có độ dài 10 số !";
}else {
    $pattern = '/032|033|034|035|036|037|038|039|056|058|059|070|076|077|078|079|081|082|083|084|085|086|088|089|090|091|092|093|094|096|097|098|099/';
    if(!preg_match($pattern,$number_phone)){
        $number_phoneErr = "SĐT không hợp lệ với Quốc Gia VN !";
    }
}
$tmp = explode('/',$ngay_sinh);
    $tmp = array_reverse($tmp);
    $ngaysinh = implode("-",$tmp);
if($ngaysinh == ""){
    $ngay_sinhErr = "Vui lòng nhập ngày tháng !";
}elseif(strtotime($ngaysinh) && 1 === preg_match('~[0-9]~', $ngaysinh)){
    //
}else {
    $ngay_sinhErr = "Ngày tháng không hợp lệ !";
}
// ít nhất 6 ký tự
// không chứa dấu cách
$removeWhiteSpacePassword = str_replace(" ", "", $password);
if(strlen($password) < 6 || (strlen($removeWhiteSpacePassword) != strlen($password))){
    $passwordErr = "Mật khẩu không thỏa mãn ";
}
// giống với xác nhận mk
if($password != $cfpassword){
    $cfpasswordErr = "Mật khẩu và xác nhận mật khẩu không khớp";
}
//Xử lý upload ảnh
$path = "";
if($avatar['size']<1500000){
    $filename = uniqid() . "-" . $avatar["name"];
    move_uploaded_file($avatar["tmp_name"], '../publics/uploads/' . $filename);
    $path = 'publics/uploads/' . $filename;
    $expensions= array("jpeg","jpg","png","bmp");
    $file_ext = strtolower(end(explode('.',$_FILES['avatar']['name'])));
    if(in_array($file_ext,$expensions)=== false){
    $avatarErr = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
    }
}elseif($avatar['size'] == 0){
    $avatarErr = "Chưa chọn ảnh đại diện";
}else{
    $avatarErr = "Hình ảnh phải nhỏ hơn 1.5mb";
}


if($ma_khErr.$nameErr.$emailErr.$passwordErr.$cfpasswordErr.$avatarErr.$number_phoneErr != ""){
    header('location: ' . BASE_URL . "tao-tk-user.php?ma_kherr=$ma_khErr&nameerr=$nameErr&emailerr=$emailErr&passworderr=$passwordErr&avatarerr=$avatarErr&number_phoneerr=$number_phoneErr");
    die;
}

// mã hóa mật khẩu
$hashPassword = password_hash($password, PASSWORD_DEFAULT);
// 4. Tạo câu query để insert data
$insertQuery = "insert into users 
                    (ma_kh, name,  
                    password, kich_hoat, email, avatar, vai_tro, ngay_sinh, number_phone)
                values 
                    ('$ma_kh', '$name' ,
                    '$hashPassword', '$kich_hoat', '$email','$path','$vai_tro' ,'$ngay_sinh','$number_phone')";
                    // 5. Thực thi câu query với csdl
$connect = getDbConnect();
$stmt = $connect->prepare($insertQuery); // nạp câu sql query vào trong kết nối
$stmt->execute(); // thực thi lệnh với csdl

// 6. Điều hướng về trang danh sách
header("location: " . BASE_URL_1);


?>