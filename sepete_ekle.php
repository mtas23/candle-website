<?php
session_start(); 
require_once 'baglan.php'; 

// JavaScript'ten gelen ürün adını ve fiyatı tutma
$gelen_urun = $_POST['urun_adi'];
$gelen_fiyat = $_POST['fiyat'];
$yaka_karti = session_id(); 

// Veritabanına yazdırma
$sorgu = $db->prepare("INSERT INTO sepet (session_id, urun_adi, fiyat) VALUES (?, ?, ?)");
$yazildi_mi = $sorgu->execute([$yaka_karti, $gelen_urun, $gelen_fiyat]);

if($yazildi_mi) {
    echo "tamam"; 
} else {
    echo "hata";
}
?>
