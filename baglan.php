<?php
$host = "localhost";
$dbname = "ray48acandlecom_sepet"; 
$username = "ray48acandlecom_kullanici"; 
$password = "042123Kbu*"; 

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    $db->exec("SET NAMES 'utf8mb4'");
    $db->exec("SET CHARACTER SET utf8mb4");
    
} catch(PDOException $e) {
    echo "Veritabanı bağlantı hatası: " . $e->getMessage();
}
?>
