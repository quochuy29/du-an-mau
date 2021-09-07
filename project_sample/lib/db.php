<?php
function getDbConnect(){
    $host = "127.0.0.1";
    $dbname = "duan1";
    $dbusername = "root";
    $dbpass = "";
    return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$dbusername,$dbpass);
}
?>