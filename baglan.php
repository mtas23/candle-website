<?php
$host = "localhost";
$dbname = "ray48acandlecom_sepet"; 
$username = "ray48acandlecom_kullanici"; 
$password = "042123Kbu*"; 

try {
    // charset=utf8mb4 ekleyerek emniyet kemerimizi takıyoruz
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Tezgahtara "Veri alıp verirken kesinlikle Türkçe (UTF-8) kullan" diyoruz
    $db->exec("SET NAMES 'utf8mb4'");
    $db->exec("SET CHARACTER SET utf8mb4");
    
} catch(PDOException $e) {
    echo "Veritabanı bağlantı hatası: " . $e->getMessage();
}
?>