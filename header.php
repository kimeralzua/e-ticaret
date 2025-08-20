<?php

if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

    exit("Bu sayfaya erişim yasak");

}

error_reporting(0);
ob_start();
session_start();
include 'nedmin/netting/baglan.php';
include 'nedmin/production/fonksiyon.php';

//Belirli veriyi seçme işlemi

$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
	'id' => 0
	));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);


if (isset($_SESSION['userkullanici_mail'])) {
$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
$kullanicisor->execute(array(
  'mail' => $_SESSION['userkullanici_mail']
  ));
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['userkullanici_id'])) {
    $_SESSION['userkullanici_id']=$kullanicicek['kullanici_id'];
}

}
?>





<!doctype html>
<html class="no-js" lang="tr">
    <head>
        <meta charset="utf-8">
        <title><?php 
        if (empty($title)) {
            echo $ayarcek['ayar_title'];

        }else {
            echo $title;
        }
        ?></title>
  <meta content="<?php echo $ayarcek['ayar_description'] ?>" name="description">
  <meta content="<?php echo $ayarcek['ayar_keywords'] ?>" name="keywords">
  <meta name="author" content="<?php echo $ayarcek['ayar_author'] ?>">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img\favicon.png">

        <!-- Normalize CSS --> 
        <link rel="stylesheet" href="css\normalize.css">

        <!-- Main CSS -->         
        <link rel="stylesheet" href="css\main.css">

        <!-- Bootstrap CSS --> 
        <link rel="stylesheet" href="css\bootstrap.min.css">
        <link rel="stylesheet" href="css\select2.min.css">
        <!-- Animate CSS --> 
        <link rel="stylesheet" href="css\animate.min.css">

        <!-- Font-awesome CSS-->
        <link rel="stylesheet" href="css\font-awesome.min.css">
        
        <!-- Owl Caousel CSS -->
        <link rel="stylesheet" href="vendor\OwlCarousel\owl.carousel.min.css">
        <link rel="stylesheet" href="vendor\OwlCarousel\owl.theme.default.min.css">

        <script src="nedmin/production/ckeditor/ckeditor.js"></script>
                <!-- Main Menu CSS -->      
        <link rel="stylesheet" href="css\meanmenu.min.css">

        <!-- Datetime Picker Style CSS -->
        <link rel="stylesheet" href="css\jquery.datetimepicker.css">

         <!-- ReImageGrid CSS -->
        <link rel="stylesheet" href="css\reImageGrid.css">

        <!-- Switch Style CSS -->
        <link rel="stylesheet" href="css\hover-min.css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="style.css">

        <!-- Modernizr Js -->
        <script src="js\modernizr-2.8.3.min.js"></script>

    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <!-- Add your site or application content here -->
        <!-- Preloader Start Here -->
        <div id="preloader"></div>
        <!-- Preloader End Here -->
        <!-- Main Body Area Start Here -->
        <div id="wrapper">
            <!-- Header Area Start Here -->
            <header>                
                <div id="header2" class="header2-area right-nav-mobile">
                    <div class="header-top-bar">
                        <div class="container">
                            <div class="row">                         
                                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                                    <div class="logo-area">
                                        <a href="index.php"><img class="img-responsive" src="<?php echo $ayarcek['ayar_logo']; ?>" alt="logo"></a>
                                    </div>
                                </div> 
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <ul class="profile-notification">                                            
                                        <!--<li>
                                            <div class="notify-contact"><span>Need help?</span> Talk to an expert: +61 3 8376 6284</div>
                                        </li>-->
                                        <?php
                                        if ($_SESSION['userkullanici_mail']) {?>
                                       
                                        <li>
                                            <div class="notify-message">
                                                <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i><span> <?php 

$mesajsay=$db->prepare("SELECT COUNT(mesaj_okunma) as say FROM mesaj where mesaj_okunma=:id and kullanici_gel=:kullanici_id");
$mesajsay->execute(array(
   'id' => 0,
   'kullanici_id' => $_SESSION['userkullanici_id']
));

$saycek=$mesajsay->fetch(PDO::FETCH_ASSOC);

echo $saycek['say'];

?></span></a>
                                                <ul>



                                                <?php 

$mesajsor=$db->prepare("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id where mesaj.kullanici_gel=:id and mesaj.mesaj_okunma=:okunma order by mesaj_okunma,mesaj_zaman DESC limit 5");
$mesajsor->execute(array(

    'id' => $_SESSION['userkullanici_id'],
    'okunma' => 0

));

if ($mesajsor->rowCount()==0) {?>
<li>
    <div class="notify-message-info">
        <div style="color:black !important" class="notify-message-subject">Hiç Mesajınız Yok</div>

    </div>
</li>

<?php }

while($mesajcek=$mesajsor->fetch(PDO::FETCH_ASSOC)) {?>



<li>
    <div class="notify-message-img">
        <img class="img-responsive" src="<?php echo $mesajcek['kullanici_magazafoto']; ?>" alt="profile">
    </div>
    <div class="notify-message-info">
        <div class="notify-message-sender"><?php echo $mesajcek['kullanici_ad']." ".$mesajcek['kullanici_soyad'] ?></div>
        <div class="notify-message-subject">Mesaj Detayı</div>
        <div class="notify-message-date"><?php echo $mesajcek['mesaj_zaman'];?></div>
    </div>
    <div class="notify-message-sign">
        <a  href="mesaj-detay?mesaj_id=<?php echo $mesajcek['mesaj_id'] ?>&kullanici_gon=<?php echo $mesajcek['kullanici_gon'] ?>"><i style="color:orange !important" class="fa fa-envelope-o" aria-hidden="true"></i></a>
    </div>
</li>

<?php } ?>
                                                    
                                                </ul>
                                            </div>
                                        </li>

                                        <?php } ?>
                                        <li>
                                            
                                        </li>
                                        <?php
                                        if ($_SESSION['userkullanici_mail']) {?>
                                            
                                       
                                        <li>
                                            <div class="user-account-info">
                                                <div class="user-account-info-controler">
                                                    <div class="user-account-img">
                                                        <img style="border-radius:30px" width="32" height="32" class="img-responsive" src="<?php echo $kullanicicek['kullanici_magazafoto']?>" alt="profile">
                                                    </div>
                                                    <div class="user-account-title">
                                                        <div class="user-account-name"><?php echo $kullanicicek['kullanici_ad']." ".substr($kullanicicek['kullanici_soyad'], 0,1) ?>.</div>
                                                        <div class="user-account-balance"> <?php 
                                                        $siparissor=$db->prepare("SELECT SUM(urun_fiyat) as toplam FROM siparis_detay where kullanici_idsatici=:kullanici_id ");

                                                        $siparissor->execute(array(
                                                            'kullanici_id' => $_SESSION['userkullanici_id']
                                                        ));

                                                        $sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);

                                                        if (isset($sipariscek['toplam'])) {
                                                            echo $sipariscek['toplam']." TL";

                                                        } else {

                                                            echo "0.00 TL";
                                                        }
                                                        ?></div>
                                                    </div>
                                                    <div class="user-account-dropdown">
                                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                <ul>
                                                    <li><a href="hesabim">Hesap Bilgilerim</a></li>
                                                    <li><a href="siparislerim">Tüm Siparişlerim</a></li>
                                                    <li><a href="adres-bilgileri">Adres Bilgilerim</a></li>
                                                    <li><a href="profil-resim-guncelle">Profil Resmim</a></li>
                                                    <li><a href="sifre-guncelle">Şifre Güncelleme</a></li>

                                                </ul>
                                            </div>
                                        </li>
                                        <li><a class="apply-now-btn" href="logout.php" id="logout-button">Çıkış Yap</a></li>
                                   <?php } else {?>
                                    <li><a class="apply-now-btn hidden-on-mobile" href="login">Giriş Yap</a></li>
                                    <li><a class="apply-now-btn-color hidden-on-mobile" href="register">Kayıt Ol</a></li>
                                  <?php }
                                        ?>
                                        
                                    </ul>
                                </div>                          
                            </div>                          
                        </div>
                    </div>
                    <div class="main-menu-area bg-primaryText" id="sticker">
                        <div class="container">
                            <nav id="desktop-nav">
                                <ul>
                                    <li class="active"><a href="index.php">Ana Sayfa</a></li>
                                    <li><a href="kategoriler">Kategoriler</a></li>
                                    <?php
                                    $kategorisor=$db->prepare("SELECT * FROM kategori where kategori_onecikar=:onecikar order by kategori_sira ASC");
                                    $kategorisor->execute(array(
                                        'onecikar' => 1
                                    ));
                                    while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { $say++
                                    ?>
                                     
                                        
                                    <li><a href="kategoriler-<?=seo($kategoricek['kategori_ad'])."-".$kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></a></li>
                                   <?php } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu Area Start -->
                <div class="mobile-menu-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mobile-menu">
                                    <nav id="dropdown">
                                        <ul>
                                            <li class="active"><a href="#">Home</a>
                                                <ul>
                                                    <li><a href="index.htm">Home 1</a></li>
                                                    <li><a href="index2.htm">Home 2</a></li>
                                                </ul>   
                                            </li>
                                            <li><a href="about.htm">About</a></li>
                                            <li><a href="#">Pages</a>
                                                <ul class="mega-menu-area"> 
                                                    <li>
                                                        <a href="index.htm">Home 1</a>
                                                        <a href="index2.htm">Home 2</a>
                                                        <a href="about.htm">About</a>
                                                        <a href="product-page-grid.htm">Product Grid</a>
                                                    </li> 
                                                    <li>
                                                        <a href="product-page-list.htm">Product List</a>
                                                        <a href="product-category-grid.htm">Category Grid</a>
                                                        <a href="product-category-list.htm">Category List</a>
                                                        <a href="single-product.htm">Product Details</a>
                                                    </li>
                                                    <li>
                                                        <a href="profile.htm">Profile</a>
                                                        <a href="favourites-grid.htm">Favourites Grid</a>
                                                        <a href="favourites-list.htm">Favourites List</a>
                                                        <a href="settings.htm">Settings</a>
                                                    </li>
                                                    <li>
                                                        <a href="upload-products.htm">Upload Products</a>
                                                        <a href="sales-statement.htm">Sales Statement</a>
                                                        <a href="withdrawals.htm">Withdrawals</a>
                                                        <a href="404.htm">404</a>
                                                    </li>
                                                </ul>                                            
                                            </li>
                                            <li><a href="product-page-grid.htm">WordPress</a></li>
                                            <li><a href="product-category-grid.htm">Joomla</a></li>
                                            <li><a href="product-category-list.htm">Plugins</a></li>
                                            <li><a href="product-page-list.htm">Components</a></li>
                                            <li><a href="product-category-grid.htm">PSD</a></li>
                                            <li><a href="#">Blog</a>
                                                <ul>
                                                    <li><a href="blog.htm">Blog</a></li>
                                                    <li><a href="single-blog.htm">Blog Details</a></li> 
                                                    <li class="has-child-menu"><a href="#">Second Level</a>
                                                    <ul class="thired-level">
                                                        <li><a href="index.htm">Thired Level 1</a></li>
                                                        <li><a href="index.htm">Thired Level 2</a></li>
                                                    </ul>
                                                </li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.htm">Contact</a></li>
                                            <li><a href="help.htm">Help</a></li>
                                        </ul>
                                    </nav>
                                </div>           
                            </div>
                        </div>
                    </div>
                </div>  
                <!-- Mobile Menu Area End -->
            </header>
            <!-- Header Area End Here -->
            <!-- Main Banner 1 Area Start Here -->