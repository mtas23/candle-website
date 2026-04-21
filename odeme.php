<?php
session_start();
require_once 'baglan.php';

$session_id = session_id();

// Sepette ürün kontrolü
$sorgu = $db->prepare("SELECT * FROM sepet WHERE session_id = ?");
$sorgu->execute([$session_id]);
$sepet_urunleri = $sorgu->fetchAll(PDO::FETCH_ASSOC);

if(count($sepet_urunleri) == 0) {
    header("Location: sepetim.php");
    exit();
}

$toplam = 0;
foreach($sepet_urunleri as $u) { $toplam += $u['fiyat']; }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Ödeme - Rayiha Candles</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    :root { --cream: #faf6f0; --beige: #e8dfd4; --warm-brown: #8b7355; --deep-brown: #3d3429; }
    body { font-family: 'Poppins', sans-serif; background: var(--cream); color: var(--deep-brown); margin: 0; padding: 20px; }
    .container { max-width: 900px; margin: 0 auto; display: grid; grid-template-columns: 1.2fr 1fr; gap: 30px; }
    .card-box { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    h2 { font-family: 'Playfair Display', serif; margin-bottom: 20px; border-bottom: 1px solid var(--beige); padding-bottom: 10px; }
    .form-group { margin-bottom: 15px; }
    label { display: block; font-size: 0.85rem; margin-bottom: 5px; color: var(--warm-brown); }
    input { width: 100%; padding: 10px; border: 1px solid var(--beige); border-radius: 8px; box-sizing: border-box; }
    
    /* Kart Görseli Stili */
    .visual-card { 
      background: linear-gradient(135deg, #3d3429 0%, #8b7355 100%);
      color: white; padding: 25px; border-radius: 15px; margin-bottom: 20px;
      position: relative; height: 160px; text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .card-number { font-size: 1.3rem; letter-spacing: 2px; margin-top: 40px; display: block; }
    .card-holder { margin-top: 20px; font-size: 0.9rem; text-transform: uppercase; }
    
    .btn-pay { 
      background: var(--deep-brown); color: white; width: 100%; padding: 15px; 
      border: none; border-radius: 10px; font-size: 1rem; cursor: pointer; transition: 0.3s;
    }
    .btn-pay:hover { background: var(--warm-brown); }
    .summary-box { background: var(--beige); padding: 20px; border-radius: 15px; height: fit-content; }

    @media (max-width: 768px) { .container { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

<div class="container">
  <form action="siparis_onay.php" method="POST" class="card-box">
    <h2>1. Teslimat Bilgileri</h2>
    <div class="form-group">
      <label>Ad Soyad</label>
      <input type="text" name="ad_soyad" required>
    </div>
    <div class="form-group">
      <label>Telefon</label>
      <input type="tel" name="telefon" required>
    </div>
    <div class="form-group">
      <label>Adres</label>
      <input type="text" name="adres" required>
    </div>

    <h2>2. Ödeme Bilgileri</h2>
    <div class="visual-card">
      <div style="font-weight: bold;">Rayiha Premium Card</div>
      <span id="cardDisplayNum" class="card-number">**** **** **** ****</span>
      <div id="cardDisplayNames" class="card-holder">AD SOYAD</div>
    </div>

    <div class="form-group">
      <label>Kart Numarası</label>
      <input type="text" maxlength="16" oninput="document.getElementById('cardDisplayNum').innerText = this.value" required>
    </div>
    <div style="display: flex; gap: 10px;">
      <div class="form-group" style="flex: 2;">
        <label>Son Kullanma</label>
        <input type="text" placeholder="AA/YY" required>
      </div>
      <div class="form-group" style="flex: 1;">
        <label>CVV</label>
        <input type="text" maxlength="3" required>
      </div>
    </div>
    
    <button type="submit" class="btn-pay">Ödemeyi Tamamla (₺<?php echo $toplam; ?>)</button>
  </form>

  <div class="summary-box">
    <h3>Sipariş Özeti</h3>
    <?php foreach($sepet_urunleri as $u): ?>
      <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
        <span><?php echo $u['urun_adi']; ?></span>
        <strong>₺<?php echo $u['fiyat']; ?></strong>
      </div>
    <?php endforeach; ?>
    <hr>
    <div style="display: flex; justify-content: space-between; font-size: 1.2rem;">
      <span>Toplam:</span>
      <strong>₺<?php echo $toplam; ?></strong>
    </div>
  </div>
</div>

</body>
</html>