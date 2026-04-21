<?php
session_start();
require_once 'baglan.php';

$session_id = session_id();

// Veritabanından bu kullanıcının sepetindeki ürünleri çekiyoruz
$sorgu = $db->prepare("SELECT * FROM sepet WHERE session_id = ?");
$sorgu->execute([$session_id]);
$sepet_urunleri = $sorgu->fetchAll(PDO::FETCH_ASSOC);

$toplam_tutar = 0;
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sepetim - Rayiha Candles</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <style>
    /* Ana sayfadaki renk paletimiz */
    :root {
      --cream: #faf6f0;
      --beige: #e8dfd4;
      --warm-brown: #8b7355;
      --deep-brown: #3d3429;
      --accent: #c9a87c;
      --red: #a84632; 
      --card: rgba(255, 255, 255, 0.95);
      --shadow: 0 12px 40px rgba(45, 35, 28, 0.08);
      --radius: 20px;
      --transition: 0.3s ease;
    }
    
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body { 
      font-family: "Poppins", sans-serif; 
      background-color: var(--cream); 
      color: var(--deep-brown); 
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 4rem 1.5rem;
      background: linear-gradient(135deg, var(--cream) 0%, #f0e9df 100%);
    }

    .cart-container { 
      background: var(--card); 
      width: 100%;
      max-width: 850px; 
      border-radius: var(--radius); 
      box-shadow: var(--shadow); 
      padding: 3rem 4rem; 
    }

    .cart-header {
      display: flex; justify-content: space-between; align-items: center;
      border-bottom: 2px solid var(--beige); padding-bottom: 1.5rem; margin-bottom: 2rem;
    }

    .cart-header h1 { font-family: "Playfair Display", serif; font-size: 2.2rem; color: var(--deep-brown); }

    .btn-back { 
      text-decoration: none; color: var(--warm-brown); font-weight: 500; font-size: 0.95rem;
      display: flex; align-items: center; gap: 0.5rem; transition: var(--transition);
    }
    .btn-back:hover { color: var(--accent); transform: translateX(-5px); }

    .cart-table { width: 100%; border-collapse: collapse; }
    .cart-table th { 
      text-align: left; padding-bottom: 1rem; color: var(--warm-brown); 
      font-weight: 500; text-transform: uppercase; font-size: 0.8rem; border-bottom: 1px solid var(--beige);
    }
    .cart-table td { padding: 1.5rem 0; border-bottom: 1px solid rgba(232, 223, 212, 0.4); vertical-align: middle; }

    .product-name { font-family: "Playfair Display", serif; font-size: 1.25rem; color: var(--deep-brown); font-weight: 600; }
    .product-price { font-size: 1.1rem; font-weight: 600; color: var(--warm-brown); }

    /* YENİ EKLENEN SİL BUTONU STİLLERİ */
    .btn-remove {
      color: var(--red);
      text-decoration: none;
      font-size: 0.85rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      transition: var(--transition);
      display: inline-block;
      padding: 0.4rem 0.8rem;
      border: 1px solid transparent;
      border-radius: 6px;
    }
    .btn-remove:hover {
      background-color: rgba(168, 70, 50, 0.1);
      border-color: rgba(168, 70, 50, 0.2);
    }

    .cart-summary { margin-top: 3rem; display: flex; flex-direction: column; align-items: flex-end; gap: 1.5rem; }
    .total-row { font-size: 1.2rem; color: var(--warm-brown); }
    .total-amount { font-family: "Playfair Display", serif; font-size: 2rem; font-weight: 700; color: var(--deep-brown); margin-left: 1rem; }
    .btn-checkout {
      background: var(--deep-brown); color: var(--cream); padding: 1.2rem 3rem; border: none; border-radius: 999px;
      font-family: "Poppins", sans-serif; font-size: 0.95rem; font-weight: 500; cursor: pointer; transition: var(--transition);
    }
    .btn-checkout:hover { background: var(--warm-brown); transform: translateY(-3px); box-shadow: 0 10px 25px rgba(139, 115, 85, 0.3); }

    .empty-cart { text-align: center; padding: 4rem 0; }
    .empty-cart p { color: var(--warm-brown); font-size: 1.1rem; margin-bottom: 2rem; }

    @media (max-width: 768px) {
      .cart-container { padding: 2rem 1.5rem; }
      .cart-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
      .btn-back { order: -1; }
    }
  </style>
</head>
<body>

<div class="cart-container">
  <div class="cart-header">
    <h1>Alışveriş Sepeti</h1>
    <a href="index.php" class="btn-back">← Alışverişe Dön</a>
  </div>

  <?php if(count($sepet_urunleri) > 0): ?>
    <table class="cart-table">
      <thead>
        <tr>
          <th>Ürün Detayı</th>
          <th>Tutar</th>
          <th style="text-align: right;">İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($sepet_urunleri as $urun): ?>
          <tr>
            <td class="product-name"><?php echo htmlspecialchars($urun['urun_adi']); ?></td>
            <td class="product-price">₺<?php echo htmlspecialchars($urun['fiyat']); ?></td>
            <td style="text-align: right;">
              <a href="sepetten_sil.php?id=<?php echo $urun['id']; ?>" class="btn-remove">Kaldır</a>
            </td>
          </tr>
          <?php $toplam_tutar += $urun['fiyat']; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
    
    <div class="cart-summary">
      <div class="total-row">
        Ara Toplam: <span class="total-amount">₺<?php echo $toplam_tutar; ?></span>
      </div>
      <a href="odeme.php" class="btn-checkout" style="text-decoration:none; display:inline-block; text-align:center;">Siparişi Tamamla</a>
    </div>

  <?php else: ?>
    <div class="empty-cart">
      <p>Sepetinizde henüz mum bulunmuyor. Koleksiyonumuzu keşfetmek ister misiniz?</p>
      <a href="index.php#products" class="btn-checkout" style="text-decoration:none; display:inline-block;">Ürünlere Göz At</a>
    </div>
  <?php endif; ?>
</div>

</body>
</html>
