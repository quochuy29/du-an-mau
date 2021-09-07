<?php
session_start();
require_once './lib/db.php';
require_once "./lib/common.php";
checkAuths();
// lấy id trên đường dẫn xuống
$userId = isset($_GET['ma_kh']) ? $_GET['ma_kh'] : -1;
// kiểm tra xem id có tồn tại trong db hay không 
$connect = getDbConnect();
$getUserByIdQuery = "select * from users where ma_kh = '$userId' ";
$stmt = $connect->prepare($getUserByIdQuery);
$stmt->execute();
$user = $stmt->fetch(); 

if(!$user){
    header("location: " . BASE_URL_1 . "?msg=User không tồn tại");
    die;
}
$name = trim($_POST['name']);
$nameErr = "";

$ma_kh = $_POST['ma_kh'];
$ma_khErr = "";

$email = $_POST['email'];
$emailErr = "";

$kich_hoat = ($_POST['kich_hoat'])?$_POST['kich_hoat']:0;

$avatar = $_FILES['avatar'];
$avatarErr = "";

$vai_tro = ($_POST['vai_tro'])?$_POST['vai_tro']:0;

$number_phone = $_POST['number_phone'];
$number_phoneErr = "";

if(isset($_POST['ngay_sinh'])){
    $ngay_sinh = $_POST['ngay_sinh'];
}

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
if($ma_khErr === "" && (strlen($ma_kh) < 4 || strlen($ma_kh) > 30)){
    $ma_khErr = "Độ dài mã khách hàng nằm trong khoảng 4 - 30 ký tự";
}
if(!preg_match('/^[0-9. ]*$/',$number_phone)){
    $number_phoneErr = "SĐT không chứa kí tự chữ";
}elseif(strlen($number_phone) > 10 || strlen($number_phone) < 10){
    $number_phoneErr = "SĐT có độ dài 10 số !";
}
$pattern = '/032|033|034|035|036|037|038|039|056|058|059|070|076|077|078|079|081|082|083|084|085|086|088|089|090|091|092|093|094|096|097|098|099/';
if(!preg_match($pattern,$number_phone)){
    $number_phoneErr = "SĐT không hợp lệ với Quốc Gia VN !";
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

$pattern = '/^0(1\d{9}|9\d{8})$/';
$match = preg_match($pattern, $number_phone);
$path = $user['avatar'];

if($avatar['size']<1500000 && $avatar['size']>0 ){
    $filename = uniqid() . "-" . $avatar["name"];
    move_uploaded_file($avatar["tmp_name"], './publics/uploads/' . $filename);
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
// 4. Tạo câu query để insert data
$updateUserSql = "update users 
                    set 
                        ma_kh = '$ma_kh',
                        name = '$name',
                        kich_hoat = '$kich_hoat',
                        email = '$email',
                        avatar = '$path',
                        vai_tro = '$vai_tro',
                        ngay_sinh = '$ngay_sinh',
                        number_phone = '$number_phone'
                  where ma_kh = '$userId' ";
$stmt = $connect->prepare($updateUserSql);
$stmt->execute();
header("location: " . BASE_URL_1 . "?msg=Cập nhật tài khoản thành công");

?>