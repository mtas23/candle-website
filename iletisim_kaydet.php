<?php
require_once 'baglan.php';

// Formdan veriler gelmiş mi?
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    
    $isim = $_POST['name'];
    $email = $_POST['email'];
    $mesaj = $_POST['message'];

    // Veritabanına kaydetmeyi dene
    $sorgu = $db->prepare("INSERT INTO mesajlar (isim, email, mesaj) VALUES (?, ?, ?)");
    $ekle = $sorgu->execute([$isim, $email, $mesaj]);

    if($ekle) {
        echo "tamam";
    } else {
        $hata = $sorgu->errorInfo();
        echo "SQL Hatası: " . $hata[2];
    }
} else {
    echo "Hata: Vitrinden gelen veri kutuları boş!";
}
?>