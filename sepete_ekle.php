<?php
session_start(); // Müşterinin yaka kartına bakıyoruz
require_once 'baglan.php'; // Cebimizdeki anahtarla arka odadaki defteri açıyoruz

// Vitrinden (JavaScript'ten) gelen ürün adını ve fiyatı tutuyoruz
$gelen_urun = $_POST['urun_adi'];
$gelen_fiyat = $_POST['fiyat'];
$yaka_karti = session_id(); 

// Deftere (Veritabanına) yazdırıyoruz (INSERT işlemi)
$sorgu = $db->prepare("INSERT INTO sepet (session_id, urun_adi, fiyat) VALUES (?, ?, ?)");
$yazildi_mi = $sorgu->execute([$yaka_karti, $gelen_urun, $gelen_fiyat]);

if($yazildi_mi) {
    echo "tamam"; // Vitrine 'başardım' diye bağırıyor
} else {
    echo "hata";
}
?>