<?php
session_start();
require_once 'baglan.php';

// Eğer linkten bize bir 'id' numarası gönderilmişse silme işlemini başlat
if(isset($_GET['id'])) {
    
    $silinecek_id = $_GET['id'];
    $yaka_karti = session_id(); // Başkasının sepetindeki mumu silmemesi kontrol ediyoruz

   
    $sorgu = $db->prepare("DELETE FROM sepet WHERE id = ? AND session_id = ?");
    $sorgu->execute([$silinecek_id, $yaka_karti]);
}

// Silme işlemi biter bitmez müşteriyi tekrar sepetim sayfasına geri gönder
header("Location: sepetim.php");
exit();
?>
