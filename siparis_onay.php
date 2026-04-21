<?php
session_start();
require_once 'baglan.php';

$session_id = session_id();

// Sadece form doldurularak gelindiyse çalıştır
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Formdan gelen adres bilgilerini alma
    $ad_soyad = $_POST['ad_soyad'];
    $telefon = $_POST['telefon'];
    $adres = $_POST['adres'];

    // 1. Sepetteki ürünleri bulalım
    $sorgu = $db->prepare("SELECT * FROM sepet WHERE session_id = ?");
    $sorgu->execute([$session_id]);
    $sepet_urunleri = $sorgu->fetchAll(PDO::FETCH_ASSOC);

    // Eğer sepette ürün varsa kaydetme işlemini yap
    if(count($sepet_urunleri) > 0) {
        $urun_listesi = "";
        $toplam_tutar = 0;

        foreach($sepet_urunleri as $urun) {
            $urun_listesi .= $urun['urun_adi'] . " (₺" . $urun['fiyat'] . "), ";
            $toplam_tutar += $urun['fiyat'];
        }

        // 2. Siparişler defterine kaydet
        $siparis_kaydet = $db->prepare("INSERT INTO siparisler (ad_soyad, telefon, adres, urunler, toplam_fiyat) VALUES (?, ?, ?, ?, ?)");
        $siparis_kaydet->execute([$ad_soyad, $telefon, $adres, $urun_listesi, $toplam_tutar]);

        // 3. Sepeti tamamen boşalt
        $sepeti_bosalt = $db->prepare("DELETE FROM sepet WHERE session_id = ?");
        $sepeti_bosalt->execute([$session_id]);
    }
} else {
    // URL'ye elle siparis_onay.php yazıp girmeye çalışanları ana sayfaya at
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Sipariş Alındı - Rayiha Candles</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet" />
  <style>
    body { 
        font-family: "Poppins", sans-serif; 
        background-color: #faf6f0; 
        color: #3d3429; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        height: 100vh; 
        margin: 0; 
        text-align: center; 
    }
    .success-box { 
        background: white; 
        padding: 4rem; 
        border-radius: 20px; 
        box-shadow: 0 12px 40px rgba(0,0,0,0.05); 
        max-width: 500px; 
    }
    h1 { 
        font-family: "Playfair Display", serif; 
        color: #8b7355; 
        font-size: 2.5rem; 
        margin-bottom: 1rem; 
    }
    p { 
        margin-bottom: 2rem; 
        color: #5c5348; 
        line-height: 1.6; 
    }
    .btn { 
        background: #3d3429; 
        color: #faf6f0; 
        padding: 1rem 2rem; 
        text-decoration: none; 
        border-radius: 8px; 
        transition: 0.3s; 
        display: inline-block;
        font-weight: 500;
    }
    .btn:hover { background: #8b7355; }
  </style>
</head>
<body>

  <div class="success-box">
    <h1>Teşekkürler!</h1>
    <p>Ödemeniz başarıyla gerçekleşti ve siparişiniz alındı. Mumlarınız en kısa sürede özenle paketlenip yola çıkacaktır. Kokulu günler dileriz!</p>
    <a href="index.php" class="btn">Ana Sayfaya Dön</a>
  </div>

</body>
</html>
