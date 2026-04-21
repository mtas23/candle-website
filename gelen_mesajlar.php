<?php
require_once 'baglan.php';

// Tüm mesajları tarihe göre en yeniden en eskiye doğru çekiyoruz
$sorgu = $db->prepare("SELECT * FROM mesajlar ORDER BY tarih DESC");
$sorgu->execute();
$mesajlar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Gelen Mesajlar - Patron Paneli</title>
  <style>
    body { font-family: sans-serif; background: #faf6f0; padding: 2rem; color: #3d3429; }
    .mesaj-kutusu { background: white; padding: 1.5rem; margin-bottom: 1rem; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .tarih { color: #8b7355; font-size: 0.85rem; float: right; }
    .isim-email { font-weight: bold; font-size: 1.1rem; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
  </style>
</head>
<body>
  <h1>Gelen İletişim Mesajları</h1>
  
  <?php if(count($mesajlar) > 0): ?>
      <?php foreach($mesajlar as $msj): ?>
        <div class="mesaj-kutusu">
            <div class="tarih"><?php echo $msj['tarih']; ?></div>
            <div class="isim-email"><?php echo htmlspecialchars($msj['isim']); ?> (<?php echo htmlspecialchars($msj['email']); ?>)</div>
            <p><?php echo nl2br(htmlspecialchars($msj['mesaj'])); ?></p>
        </div>
      <?php endforeach; ?>
  <?php else: ?>
      <p>Henüz gelen bir mesaj yok.</p>
  <?php endif; ?>
</body>
</html>