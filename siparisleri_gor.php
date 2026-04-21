<?php
require_once 'baglan.php';
$sorgu = $db->prepare("SELECT * FROM siparisler ORDER BY tarih DESC");
$sorgu->execute();
$siparisler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sipariş Yönetimi - Rayiha Candles</title>
    <style>
        body { font-family: sans-serif; background: #faf6f0; padding: 20px; }
        .siparis-kart { background: white; padding: 20px; margin-bottom: 15px; border-left: 5px solid #8b7355; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .fiyat { font-weight: bold; color: #3d3429; font-size: 1.2rem; }
        .detay { font-size: 0.9rem; color: #666; }
    </style>
</head>
<body>
    <h1>Gelen Siparişler</h1>
    <?php foreach($siparisler as $s): ?>
        <div class="siparis-kart">
            <div><strong>Müşteri:</strong> <?php echo $s['ad_soyad']; ?> (<?php echo $s['telefon']; ?>)</div>
            <div class="detay"><strong>Adres:</strong> <?php echo $s['adres']; ?></div>
            <div class="detay"><strong>Ürünler:</strong> <?php echo $s['urunler']; ?></div>
            <div class="fiyat">Toplam: ₺<?php echo $s['toplam_fiyat']; ?></div>
            <div class="detay">Tarih: <?php echo $s['tarih']; ?></div>
        </div>
    <?php endforeach; ?>
</body>
</html>