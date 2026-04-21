<?php

require_once 'baglan.php';

// Formdan isim, email ve mesaj gelmiş mi diye bakma
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    
    // Gelen verileri alıyoruz
    $isim = $_POST['name'];
    $email = $_POST['email'];
    $mesaj = $_POST['message'];

    // Mesajlar tablosuna yazdırma
    $sorgu = $db->prepare("INSERT INTO mesajlar (isim, email, mesaj) VALUES (?, ?, ?)");
    $yazildi_mi = $sorgu->execute([$isim, $email, $mesaj]);

    if($yazildi_mi) {
        echo "tamam";
    } else {
        echo "hata";
    }
}
?>
