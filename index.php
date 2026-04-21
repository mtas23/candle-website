<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rayiha Candles — El Yapımı Lüks</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <style>
    :root {
      --cream: #faf6f0;
      --beige: #e8dfd4;
      --sand: #d4c4b0;
      --warm-brown: #8b7355;
      --deep-brown: #3d3429;
      --accent: #c9a87c;
      --overlay: rgba(28, 22, 18, 0.72);
      --card: rgba(250, 246, 240, 0.95);
      --shadow: 0 8px 32px rgba(45, 35, 28, 0.12);
      --shadow-hover: 0 20px 48px rgba(45, 35, 28, 0.2);
      --radius: 16px;
      --radius-sm: 10px;
      --transition: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    html {
      scroll-behavior: smooth;
    }
    body {
      font-family: "Poppins", sans-serif;
      font-weight: 400;
      color: var(--deep-brown);
      background: var(--cream);
      line-height: 1.6;
      overflow-x: hidden;
    }
    .page-bg {
      position: fixed;
      inset: 0;
      z-index: -2;
      background: url("https://images.unsplash.com/photo-1602143407151-7111542de6e8?auto=format&fit=crop&w=2400&q=80") center / cover no-repeat;
    }
    .page-bg::after {
      content: "";
      position: absolute;
      inset: 0;
      background: var(--overlay);
      z-index: 1;
    }
    /* Navbar */
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      padding: 1rem 5%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: background var(--transition), box-shadow var(--transition), padding var(--transition);
    }
    .navbar.scrolled {
      background: rgba(250, 246, 240, 0.94);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: 0 4px 24px rgba(45, 35, 28, 0.08);
      padding: 0.75rem 5%;
    }
    .navbar.scrolled .logo,
    .navbar.scrolled .nav-links a {
      color: var(--deep-brown);
    }
    .logo {
      font-family: "Playfair Display", serif;
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--cream);
      letter-spacing: 0.02em;
      text-decoration: none;
      transition: color var(--transition);
    }
    .nav-links {
      display: flex;
      gap: 2rem;
      list-style: none;
    }
    .nav-links a {
      color: var(--cream);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.9rem;
      letter-spacing: 0.04em;
      transition: color var(--transition), opacity var(--transition);
    }
    .nav-links a:hover {
      color: var(--accent);
    }
    .navbar.scrolled .nav-links a:hover {
      color: var(--warm-brown);
    }
    .cart-badge-wrap {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .cart-count {
      background: var(--accent);
      color: var(--deep-brown);
      font-size: 0.75rem;
      font-weight: 600;
      min-width: 22px;
      height: 22px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transform: scale(0.8);
      transition: opacity var(--transition), transform var(--transition);
    }
    .cart-count.visible {
      opacity: 1;
      transform: scale(1);
    }
    .menu-toggle {
      display: none;
      flex-direction: column;
      gap: 5px;
      background: none;
      border: none;
      cursor: pointer;
      padding: 4px;
    }
    .menu-toggle span {
      width: 24px;
      height: 2px;
      background: currentColor;
      border-radius: 1px;
      transition: var(--transition);
    }
    .navbar:not(.scrolled) .menu-toggle {
      color: var(--cream);
    }
    .navbar.scrolled .menu-toggle {
      color: var(--deep-brown);
    }
    /* Hero */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 6rem 1.5rem 4rem;
    }
    .hero-content {
      max-width: 720px;
      animation: heroFade 1.2s ease-out forwards;
    }
    @keyframes heroFade {
      from {
        opacity: 0;
        transform: translateY(28px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .hero h1 {
      font-family: "Playfair Display", serif;
      font-size: clamp(2.5rem, 6vw, 4rem);
      font-weight: 600;
      color: var(--cream);
      line-height: 1.15;
      margin-bottom: 1rem;
      text-shadow: 0 4px 24px rgba(0, 0, 0, 0.25);
    }
    .hero p {
      font-size: clamp(1rem, 2vw, 1.25rem);
      color: rgba(250, 246, 240, 0.88);
      font-weight: 300;
      margin-bottom: 2rem;
      letter-spacing: 0.06em;
    }
    .btn {
      display: inline-block;
      padding: 0.95rem 2.25rem;
      font-family: "Poppins", sans-serif;
      font-size: 0.85rem;
      font-weight: 600;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      text-decoration: none;
      border: none;
      cursor: pointer;
      border-radius: 999px;
      transition: transform var(--transition), box-shadow var(--transition), background var(--transition);
    }
    .btn-primary {
      background: var(--cream);
      color: var(--deep-brown);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }
    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 14px 40px rgba(0, 0, 0, 0.28);
    }
    /* Sections */
    section {
      padding: 5rem 5%;
    }
    .section-light {
      background: var(--cream);
      border-radius: var(--radius) var(--radius) 0 0;
      margin-top: -2rem;
      position: relative;
      box-shadow: 0 -12px 48px rgba(0, 0, 0, 0.06);
    }
    .section-title {
      font-family: "Playfair Display", serif;
      font-size: clamp(2rem, 4vw, 2.75rem);
      text-align: center;
      color: var(--deep-brown);
      margin-bottom: 0.5rem;
    }
    .section-sub {
      text-align: center;
      color: var(--warm-brown);
      font-weight: 300;
      max-width: 520px;
      margin: 0 auto 3rem;
      font-size: 0.95rem;
    }
    /* Products */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
    }
    .product-card {
      background: var(--card);
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow);
      transition: transform var(--transition), box-shadow var(--transition);
    }
    .product-card:hover {
      transform: scale(1.03);
      box-shadow: var(--shadow-hover);
    }
    .product-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      display: block;
    }
    .product-body {
      padding: 1.5rem;
    }
    .product-body h3 {
      font-family: "Playfair Display", serif;
      font-size: 1.35rem;
      margin-bottom: 0.5rem;
      color: var(--deep-brown);
    }
    .product-body p {
      font-size: 0.88rem;
      color: #5c5348;
      margin-bottom: 1rem;
      line-height: 1.55;
    }
    .product-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
    }
    .price {
      font-weight: 600;
      font-size: 1.1rem;
      color: var(--warm-brown);
    }
    .btn-cart {
      padding: 0.6rem 1.2rem;
      font-size: 0.75rem;
      letter-spacing: 0.08em;
      background: var(--deep-brown);
      color: var(--cream);
      border-radius: var(--radius-sm);
    }
    .btn-cart:hover {
      background: var(--warm-brown);
      transform: translateY(-2px);
    }
    
    /* About Section */
    #about {
      background-color: var(--accent); /* Beyaz yazının okunması için */
    }
    #about .section-title,
    #about .about-text h2 {
      color: #0a0806; /* Başlıklar için daha koyu bir siyah/kahve tonu */
    }
    #about .section-sub,
    #about .about-text p {
      color: #ffffff; 
    }
    .about-wrap {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      max-width: 1100px;
      margin: 0 auto;
      align-items: center;
    }
    .about-img {
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow);
    }
    .about-img img {
      width: 100%;
      height: auto;
      display: block;
      object-fit: cover;
      min-height: 380px;
    }
    .about-text h2 {
      font-family: "Playfair Display", serif;
      font-size: clamp(1.75rem, 3vw, 2.25rem);
      margin-bottom: 1rem;
    }
    .about-text p {
      margin-bottom: 1rem;
      font-size: 0.95rem;
    }
    /* Contact */
    .contact-section {
      background: linear-gradient(180deg, var(--beige) 0%, var(--cream) 100%);
    }
    .contact-form {
      max-width: 520px;
      margin: 0 auto;
    }
    .form-group {
      margin-bottom: 1.25rem;
    }
    .form-group label {
      display: block;
      font-size: 0.8rem;
      font-weight: 500;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--warm-brown);
      margin-bottom: 0.45rem;
    }
    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 0.9rem 1rem;
      border: 1px solid rgba(139, 115, 85, 0.25);
      border-radius: var(--radius-sm);
      font-family: "Poppins", sans-serif;
      font-size: 0.95rem;
      background: rgba(255, 255, 255, 0.85);
      transition: border-color var(--transition), box-shadow var(--transition);
    }
    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(201, 168, 124, 0.25);
    }
    .form-group textarea {
      min-height: 140px;
      resize: vertical;
    }
    .btn-submit {
      width: 100%;
      padding: 1rem;
      background: var(--deep-brown);
      color: var(--cream);
      font-weight: 600;
      letter-spacing: 0.1em;
      border-radius: var(--radius-sm);
      margin-top: 0.5rem;
      border: none;
      cursor: pointer;
    }
    .btn-submit:hover {
      background: var(--warm-brown);
      transform: translateY(-2px);
      box-shadow: var(--shadow);
    }
    /* Footer */
    footer {
      background: var(--deep-brown);
      color: rgba(250, 246, 240, 0.85);
      padding: 3rem 5% 2rem;
      text-align: center;
    }
    .social-links {
      display: flex;
      justify-content: center;
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }
    .social-links a {
      color: var(--cream);
      display: flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      border-radius: 50%;
      border: 1px solid rgba(250, 246, 240, 0.25);
      transition: background var(--transition), transform var(--transition), border-color var(--transition);
    }
    .social-links a:hover {
      background: rgba(201, 168, 124, 0.2);
      border-color: var(--accent);
      transform: translateY(-3px);
    }
    .social-links svg {
      width: 20px;
      height: 20px;
      fill: currentColor;
    }
    .copyright {
      font-size: 0.8rem;
      opacity: 0.75;
      letter-spacing: 0.04em;
    }
    /* Mobile */
    @media (max-width: 900px) {
      .about-wrap {
        grid-template-columns: 1fr;
      }
      .about-img {
        order: -1;
      }
    }
    @media (max-width: 768px) {
      .menu-toggle {
        display: flex;
      }
      .nav-links {
        position: fixed;
        top: 0;
        right: -100%;
        width: min(280px, 85vw);
        height: 100vh;
        background: rgba(250, 246, 240, 0.98);
        flex-direction: column;
        padding: 5rem 2rem;
        gap: 1.5rem;
        box-shadow: -8px 0 32px rgba(0, 0, 0, 0.12);
        transition: right var(--transition);
      }
      .nav-links.open {
        right: 0;
      }
      .nav-links a {
        color: var(--deep-brown) !important;
      }
      .navbar.scrolled .nav-links a {
        color: var(--deep-brown);
      }
    }
  </style>
</head>
<body>
  <div class="page-bg" aria-hidden="true"></div>
  <header class="navbar" id="navbar">
    <a href="#home" class="logo">Rayiha Candles</a>
    <button type="button" class="menu-toggle" id="menuToggle" aria-label="Menüyü aç">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <nav>
      <ul class="nav-links" id="navLinks">
        <li><a href="#home">Ana Sayfa</a></li>
        <li><a href="#products">Ürünler</a></li>
        <li><a href="#about">Hakkımızda</a></li>
        <li><a href="#contact">İletişim</a></li>
        <li><a href="sepetim.php">Sepetim</a></li>
        <li class="cart-badge-wrap">
          <span class="cart-count" id="cartCount">0</span>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="hero" id="home">
      <div class="hero-content">
        <h1>Anlarınızı Aydınlatın</h1>
        <p>Sevgiyle üretilen el yapımı mumlar</p>
        <a href="#products" class="btn btn-primary">Şimdi Alışveriş Yap</a>
      </div>
    </section>
    <section class="section-light" id="products">
      <h2 class="section-title">Koleksiyonumuz</h2>
      <p class="section-sub">Sakin akşamlar ve değerli ritüeller için özenle seçilmiş doğal bal mumu, pamuk fitiller ve rahatlatıcı kokular.</p>
      <div class="products-grid">
        <article class="product-card">
          <img src="vanilyacekirdegi.jpeg" alt="Baharatlı vanilya mumu" />
          <div class="product-body">
            <h3>Baharatlı Vanilya</h3>
            <p>Zengin Madagaskar vanilyası, tarçın çubukları ve karanfil tomurcukları—sıcacık ve sarıp sarmalayan.</p>
            <div class="product-footer">
              <span class="price">₺520</span>
              <button type="button" class="btn btn-cart add-cart" data-name="Baharatlı Vanilya">Sepete Ekle</button>
            </div>
          </div>
        </article>
        <article class="product-card">
          <img src="lavantatarlalari.jpeg" alt="Lavanta rüyası silindir mum" />
          <div class="product-body">
            <h3>Lavanta Rüyası</h3>
            <p>Dinlendirici Provence lavantası ve yumuşak katmanlı mum—spa benzeri bir sakinlik.</p>
            <div class="product-footer">
              <span class="price">₺640</span>
              <button type="button" class="btn btn-cart add-cart" data-name="Lavanta Rüyası">Sepete Ekle</button>
            </div>
          </div>
        </article>
        <article class="product-card">
          <img src="sandalagacivekehribar.jpeg" alt="Ahşap kütük mumlar" />
          <div class="product-body">
            <h3>Kök Odun</h3>
            <p>Ham ahşap kütüğe dökülmüş mum, sandal ağacı ve kehribar notaları—sofistike ve dengeleyici.</p>
            <div class="product-footer">
              <span class="price">₺750</span>
              <button type="button" class="btn btn-cart add-cart" data-name="Kök Odun">Sepete Ekle</button>
            </div>
          </div>
        </article>
        <article class="product-card">
          <img src="bergamotkabugu.jpeg" alt="Hilal bahçesi kavanoz mumu" />
          <div class="product-body">
            <h3>Hilal Bahçesi</h3>
            <p>İtalyan bergamotu, beyaz çay ve kurutulmuş güller ile lavanta—parlak, ferah ve romantik.</p>
            <div class="product-footer">
              <span class="price">₺780</span>
              <button type="button" class="btn btn-cart add-cart" data-name="Hilal Bahçesi">Sepete Ekle</button>
            </div>
          </div>
        </article>
        <article class="product-card">
          <img src="samgulu.jpeg" alt="Kır çiçeği tarlası silindir mumlar" />
          <div class="product-body">
            <h3>Kır Çiçeği Tarlası</h3>
            <p>Kadifemsi kır çiçekleri ve unutmabeni çiçekleri—zamansız ve doğal.</p>
            <div class="product-footer">
              <span class="price">₺600</span>
              <button type="button" class="btn btn-cart add-cart" data-name="Kır Çiçeği Tarlası">Sepete Ekle</button>
            </div>
          </div>
        </article>
        <article class="product-card">
          <img src="sedirvecam.jpeg" alt="Toprak esintisi geniş mum" />
          <div class="product-body">
            <h3>Toprak Esintisi</h3>
            <p>Toprak terakota kasede geniş mum, kurutulmuş ayçiçekleri ve kır çiçekleri—doğal ve rustik bir enerji.</p>
            <div class="product-footer">
              <span class="price">₺520</span>
              <button type="button" class="btn btn-cart add-cart" data-name="Toprak Esintisi">Sepete Ekle</button>
            </div>
          </div>
        </article>
      </div>
    </section>
    
    <section id="about">
      <h2 class="section-title">Hikayemiz</h2>
      <p class="section-sub">"Rayiha, kalbin hatırladığı, ruhun unutmadığı bir latif esintidir.Her rayiha, bir hatıranın izidir; bazen bir dua, bazen bir huzur vesilesi..." </p>
      <div class="about-wrap">
        <div class="about-img">
          <img src="sandalagacivekehribar.jpeg" alt="Doğal ahşap kütük mumlar" />
        </div>
        <div class="about-text">
          <h2>Stüdyomuzda el yapımı</h2>
          <p>
            Rayiha, bir mutfak masasında bal mumu, uçucu yağlar ve yavaş geçen akşamlara duyulan sevgiyle başladı. Bugün hala her bir mumu doğal soya ve hindistan cevizi ağacı karışımları, kurşunsuz pamuk fitiller ve fitalat içermeyen esanslar kullanarak kendi ellerimizle döküyoruz.
          </p>
          <p>
            Kokunun bunaltıcı değil, rahatlatıcı olması gerektiğine inanıyoruz; her bir formül dengeli, sakinleştirici ve gerçek hissettirene kadar test ediliyor. İlk yakıştan son yanma saatine kadar, mumlarımız sıradan odaları yumuşak, davetkar mekanlara dönüştürmek için tasarlandı.
          </p>
        </div>
      </div>
    </section>

    <section class="contact-section" id="contact">
      <h2 class="section-title">İletişime Geçin</h2>
      <p class="section-sub">Kokular, toptan satış veya özel döküm hakkında sorularınız mı var? Sizden haber almaktan mutluluk duyarız.</p>
      <form class="contact-form" id="contactForm">
        <div class="form-group">
          <label for="name">İsim</label>
          <input type="text" id="name" name="name" required placeholder="Adınız" autocomplete="name" />
        </div>
        <div class="form-group">
          <label for="email">E-posta</label>
          <input type="email" id="email" name="email" required placeholder="siz@ornek.com" autocomplete="email" />
        </div>
        <div class="form-group">
          <label for="message">Mesaj</label>
          <textarea id="message" name="message" required placeholder="Size nasıl yardımcı olabiliriz?"></textarea>
        </div>
        <button type="submit" class="btn btn-submit">Mesaj Gönder</button>
      </form>
    </section>
  </main>
  <footer>
    <div class="social-links">
      <a href="#" aria-label="Instagram">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
      </a>
      <a href="#" aria-label="Twitter">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
      </a>
      <a href="#" aria-label="Facebook">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
      </a>
    </div>
    <p class="copyright">&copy; 2026 Rayiha Candles. Tüm hakları saklıdır.</p>
  </footer>
  <script>
    (function () {
      // 1. MENÜ VE SEPET BİLDİRİMİ AYARLARI
      var navbar = document.getElementById("navbar");
      var cartCountEl = document.getElementById("cartCount");
      var cart = 0; 
      
      function updateCartBadge() {
        cartCountEl.textContent = cart;
        cartCountEl.classList.toggle("visible", cart > 0);
      }

      // Sayfa aşağı kayınca menünün rengini değiştirme
      window.addEventListener("scroll", function () {
        if (window.scrollY > 60) {
          navbar.classList.add("scrolled");
        } else {
          navbar.classList.remove("scrolled");
        }
      });

      // Menüdeki linklere tıklayınca yumuşak kayma efekti
      document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener("click", function (e) {
          var id = anchor.getAttribute("href");
          if (id.length > 1) {
            var target = document.querySelector(id);
            if (target) {
              e.preventDefault();
              target.scrollIntoView({ behavior: "smooth", block: "start" });
              document.getElementById("navLinks").classList.remove("open");
            }
          }
        });
      });

      // Mobilde hamburger menüyü açıp kapatma
      document.getElementById("menuToggle").addEventListener("click", function () {
        document.getElementById("navLinks").classList.toggle("open");
      });

      // 2. SEPETE EKLEME İŞLEMİ
      document.querySelectorAll(".add-cart").forEach(function (btn) {
        btn.addEventListener("click", function () {
          var name = btn.getAttribute("data-name"); 
          var priceText = btn.previousElementSibling.textContent; 
          var price = priceText.replace('₺', '').trim();

          var veriler = new URLSearchParams();
          veriler.append('urun_adi', name);
          veriler.append('fiyat', price);

          fetch('sepete_ekle.php', {
              method: 'POST',
              credentials: 'include',
              body: veriler
          })
          .then(response => response.text())
          .then(cevap => {
              var temizCevap = cevap.trim();
              if(temizCevap === "tamam" || temizCevap === "basarili") {
                  cart += 1; // Sepet sayısını 1 artır
                  updateCartBadge(); // Yukarıdaki kırmızı baloncukta göster
                  alert(name + " sepete eklendi!");
              } else {
                  alert("Hata detayı: " + temizCevap);
              }
          });
        });
      });

      // 3. İLETİŞİM FORMU
      var iletisimFormu = document.getElementById("contactForm");
      if(iletisimFormu) {
          iletisimFormu.addEventListener("submit", function (e) {
            e.preventDefault(); // Sayfanın yenilenmesini engelle

            var formData = new URLSearchParams();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('message', document.getElementById('message').value);

            fetch('iletisim_kaydet.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(cevap => {
                if(cevap.trim() === "tamam") {
                    alert("Teşekkürler! Mesajınız başarıyla alındı ve kaydedildi.");
                    this.reset(); // Formu temizle
                } else {
                    alert("Mesaj gönderilirken bir hata oluştu.");
                }
            });
          });
      }
    })();
  </script>
</body>
</html>
