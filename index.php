<?php
    session_start();
    include("baglanti.php");


    if (isset($_POST["cihazikaydet"])) {
        // Müşteri Bilgileri

        $musteriAdi = $_POST["customerName"];
        $adres = $_POST["address"];
        $gsmNo = $_POST["gsm"];
        $telefon = $_POST["phone"];
        $email = $_POST["email"];
        $tcNo = $_POST["tcNo"];
    
        // Servis Bilgileri
        $servisTuru = $_POST["serviceType"];
        $gelistarihi = $_POST["arrivalDate"];
        $servisTarihi = $_POST["serviceDate"];
        $disServisBolgesi = $_POST["externalRegion"];
    
        $teknisyen = "";
    
        if ($_POST["serviceType"] === 'normal') {
            $teknisyen = $_POST["technician_normal"];
            $disServisBolgesi = "YOK";
        } elseif ($_POST["serviceType"] === 'dis') {
            $teknisyen = $_POST["technician_external"];
        }
    
        // Cihaz Bilgileri
        $cihazTuru = $_POST["devices"];
        $marka = $_POST["trademark"];
        $model = $_POST["model"];
        $seriNo = $_POST["serviceNo"];
        if (isset($_POST["servisYok"]) && $_POST["servisYok"] === "on") {
            $seriNo = "YOK";
        }
        $faturaTarihi = $_POST["faturatarihi"];
        $saticiFirma = $_POST["saticifirma"];
        $takipNo = $_POST["takipno"];
        $garantiBilgisi = isset($_POST["garantiSecenek"]) ? $_POST["garantiSecenek"] : "";
        $genelDurumArray = isset($_POST["geneldurum"]) ? $_POST["geneldurum"] : array();
        $genelDurum = is_array($genelDurumArray) ? implode(", ", $genelDurumArray) : "";
    
        $sikayetAriza = $_POST["sikayet-ariza"];
        $aksesuarlar = $_POST["aksesuarlar"];
        $fizikselHasar = $_POST["hasar"];
        $toplamUcret = $_POST["ucret-bildir"];
    
        // Veritabanı sorgusu
        $kayitSorgu = "INSERT INTO cihaz_kayitlar 
                       (bayiadi, musteriadi, adres, gsmno, telefon, email, tcno, servisturu, gelistarihi, servistarihi, teknisyen, disservisbolgesi,
                       cihazturu, marka, model, serino, faturatarihi, saticifirma, takipno, garantibilgisi, geneldurum, sikayetariza, aksesuarlar,
                       fizikselhasar, toplamucret) 
                       VALUES 
                       ('".$_POST["dealer"]."', '$musteriAdi', '$adres', '$gsmNo', '$telefon', '$email', '$tcNo',
                       '$servisTuru', '$gelistarihi', '$servisTarihi', '$teknisyen', '$disServisBolgesi',
                       '$cihazTuru', '$marka', '$model', '$seriNo', '$faturaTarihi', '$saticiFirma', '$takipNo',
                       '$garantiBilgisi', '$genelDurum', '$sikayetAriza', '$aksesuarlar', '$fizikselHasar', '$toplamUcret')";
    
        if ($baglanti->query($kayitSorgu) === TRUE) {
            echo "<script>alert('Cihaz kayıt işlemi başarılı.'); window.location.href='index.php';</script>";
        } else {
            echo "Hata: " . $kayitSorgu . "<br>" . $baglanti->error;
        }
    }
    
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cihaz Kayıt</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="css\bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="css\font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="css\custom.css" rel="stylesheet" />

    <link href="css/style1.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
     
           
          
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">
                        <img src="resimler/logo.png" />
                    </a>
                    
                </div>
              
                <span class="logout-spn" >
                <p class='hgyazisi'><a class='link-opacity-100' style="color:#fff;" href='cikis.php'>Çıkış Yap</a></p>

                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                 


                    <li class="active-link">
                        <a href="index.php" ><i class="fa fa-desktop "></i>Cihaz Kayıt</a>
                    </li>
                   

                    <li>
                        <a href="cihazsorgula.php"><i class="fa fa-table "></i>Cihaz Sorgula </a>
                    </li>
                    <li>
                        <a href="servistekicihazlar.php"><i class="fa fa-qrcode "></i>Servisteki Cihazlar </a>
                    </li>


                    <li>
                        <a href="ucretbildir.php"><i class="fa fa-edit "></i>Ücret Bildir</a>
                    </li>
                    <li>
                        <a href="musteribilgileri.php"><i class="fa fa-lightbulb-o"></i>Müşteri Bilgileri</a>
                    </li>
                    
                </ul>
                            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                     <h2>CİHAZ KAYIT</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                             <strong>
    <?php

    if(isset($_SESSION["kullanici_adi"]))
    {
        echo "<h5 class='hgyazisi'>Hoşgeldin ".$_SESSION["kullanici_adi"].".</h5>";
    }
    else
    {               
        echo "Bu sayfayı görüntüleme yetkiniz yoktur. Sayfa sizi 5 saniye içinde giriş sayfasına yönlendirecek.";

        // JavaScript ile 5 saniyelik bir bekleme ve yönlendirme
        echo '<script>
                var count = 5;
                var redirectTimer = setInterval(function() {
                    document.getElementById("countdown").innerHTML = "Yönlendiriliyor: " + count + " saniye";
                    count--;
                    if (count === 0) {
                        clearInterval(redirectTimer);
                        window.location.href = "login.php";
                    }
                }, 1000);
              </script>'; 
    }
    ?><p class="hgyazisi" id="countdown"></p></strong>
                 </div>
                       
                    </div>
                    </div>
                  <!-- /. ROW  --> 
                  <div class="customer-info">
        <h3>Müşteri Bilgileri</h3>
        <form id="customerServiceForm" action="index.php" method="post">
            <div class="customer-info-fields">
                <label for="dealer">Bayi Adı:</label>
                <select name="dealer" id="dealer" required>
                    <option value=""></option>
                    <option value="IzmitBayi">İzmit Bayi</option>
                    <option value="SekaBayi">Seka Bayi</option>
                    <option value="KorfezBayi">Körfez Bayi</option>
                    <option value="BasiskeleBayi">Başiskele Bayi</option>
                    <option value="IstanbulMaltepeBayi">Maltepe Bayi</option>
                </select>

                <label for="customerName">Müşteri Adı:</label>
                <input type="text" name="customerName" required>

                <label for="address">Adres:</label>
                <input type="text" name="address" required>

                <label for="gsm">GSM No:</label>
                <input type="tel" name="gsm" oninput="limitLength(this, 11)" required><br>

                <label for="phone">Telefon:</label>
                <input type="tel" name="phone" oninput="limitLength(this, 11)" required>

                <label for="email">E-mail:</label>
                <input type="email" name="email" required>

                <label for="tcNo">TC No:&nbsp;&nbsp;&nbsp;</label>
                <input type="number" name="tcNo" oninput="limitLength(this, 11)" required>
            </div>

            <div class="service-info-fields">
                <h3>Servis Bilgisi</h3>

                <label for="serviceType">Servis Türü:</label>
                <select name="serviceType" id="serviceType" onchange="showHideFields()">
                    <option value=""></option>
                    <option value="normal">Normal Servis</option>
                    <option value="dis">Dış Servis</option>
                </select>

                <div id="normalServiceFields">
                    <label for="arrivalDate">Geliş Tarihi:</label>
                    <input type="datetime-local" name="arrivalDate">

                    <label for="technician_normal">İlgili Teknisyen:</label>
                    <select name="technician_normal">
                        <option value=""></option>
                        <option value="OmerCakir">Ömer Çakır</option>
                        <option value="EmirFuruncu">Emir Furuncu</option>
                        <option value="BurakTutucu">Burak Tutucu</option>
                        <option value="SerkanYilmaz">Serkan Yılmaz</option>
                        <option value="FatihKececioğlu">Fatih Keçecioğlu</option>
                        <option value="Furkan">Furkan Demir</option>
                    </select>
                </div>

                <div id="externalServiceFields" style="display:none;">
                    <label for="serviceDate">Servis Tarihi:</label>
                    <input type="datetime-local" name="serviceDate" >

                    <label for="technician_external">İlgili Teknisyen:</label>
                    <select name="technician_external" >
                    <option value=""></option>
                        <option value="OmerCakir">Ömer Çakır</option>
                        <option value="EmirFuruncu">Emir Furuncu</option>
                        <option value="BurakTutucu">Burak Tutucu</option>
                        <option value="SerkanYilmaz">Serkan Yılmaz</option>
                        <option value="FatihKececioğlu">Fatih Keçecioğlu</option>
                        <option value="Furkan">Furkan Demir</option>
                    </select>

                    <label for="externalRegion">Dış Servis Bölgesi:</label>
                    <select name="externalRegion">
                        <option value=""></option>
                        <option value="Yeniyali">Yeniyalı Bölgesi</option>
                        <option value="Guney">Güney Bölgesi</option>
                        <option value="Harikalar">Harikalar Bölgesi</option>
                    </select>
                </div>
            </div>
            
         </div>  
         <div class="device-info">
             <h3>Cihaz Bilgileri</h3>
                
             <label for="devices">Cihaz Türü: </label>
                <select name="devices" id="devices" required>
                    <option value=""></option>
                    <option value="Bilgisayar">Bilgisayar</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Telefon">Telefon</option>
                    <option value="Laptop">Laptop</option>
                    <option value="AkilliSaat">Akıllı Saat</option>
                </select>
                
                <label for="trademark">Marka: </label>
                <select name="trademark" id="trademark" required>
                    <option value=""></option>
                    <option value="Samsung">Samsung</option>
                    <option value="Xiaomi">Xiaomi</option>
                    <option value="Oppo">Oppo</option>
                    <option value="iPhone">iPhone</option>
                    <option value="Huawei">Huawei</option>
                    <option value="Casper">Casper</option>
                    <option value="GeneralMobile">General Mobile</option>
                    <option value="Monster">Monster</option>
                    <option value="Asus">Asus</option>
                    <option value="Lenovo">Lenovo</option>
                    <option value="HP">HP</option>
                    <option value="MSI">MSI</option>
                    <option value="Acer">Acer</option>
                </select>    
                <label for="model">Model: </label>
                <input type="text" name="model" required>

                <label for="serviceNo">Seri Numarası:</label>
                <input type="number" id="serviceNo" name="serviceNo" required>
                              
                 
                  <label for="servisYok" class="servisyokyazisi">
                    Seri Numarası Yok
                    <input type="checkbox" id="servisYok" name="servisYok" onchange="toggleInput()" onchange="this.form.submit()">
                  </label><br>

                  <label for="faturatarihi">Fatura Tarihi:</label>
                  <input type="datetime-local" name="faturatarihi" required>
                <label for="saticifirma">Satıcı Firma:</label>
                <select name="saticifirma" id="saticifirma" required>
                    <option value=""></option>
                    <option value="MediaMarkt">Media Markt</option>
                    <option value="Teknosa">Teknosa</option>
                    <option value="Itopya">Itopya</option>
                    <option value="InceHesap">İnce Hesap</option>
                    <option value="Sinerji">Sinerji</option>
                    <option value="Casper">Casper</option>
                    <option value="Lenovo">Lenovo</option>
                </select>               
                <label for="takipno">Takip Numarası / Özel Kod:</label>
                <input type="text" id="takipno" name="takipno" required>

                <div class="garanti-bilgisi">
                    <h3>Garanti Bilgisi</h3>
                <label>
                <input type="radio" name="garantiSecenek" value="garantili"> Garantili
                </label>

                <label>
                <input type="radio" name="garantiSecenek" value="garantisiz"> Garantisiz
                </label>

                <label>
                <input type="radio" name="garantiSecenek" value="servisGarantili"> Servis Garantili
                </label>
                </div>
                <div class="geneldurum">
                    <h3>Genel Durumu</h3>
                <label>
                <input type="checkbox" name="geneldurum[]" id="yeni-cihaz" value="yeni-cihaz" onchange="checkCheckbox(this)"> Yeni Cihaz
                </label>&nbsp;&nbsp;&nbsp;
                <label>
                <input type="checkbox" name="geneldurum[]" id="eski-cihaz" value="eski-cihaz" onchange="checkCheckbox(this)"> Eski Cihaz
                </label>&nbsp;&nbsp;&nbsp;
                <label>
                <input type="checkbox" name="geneldurum[]" value="kurcalanmis-cihaz"> Kurcalanmış Cihaz
                </label>&nbsp;&nbsp;&nbsp;
                <label>
                <input type="checkbox" name="geneldurum[]" value="bilgiler-yedeklensin"> Bilgiler Yedeklensin
                </label>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="yazili-alanlar">
                <div class="sikayet-ariza">
                    <h3>Şikayet / Arıza Bilgisi</h3>
                    <label for="sikayet-ariza" >
                    <textarea id="sikayet-ariza" name="sikayet-ariza" rows="3" cols="80" maxlength="500" required></textarea>
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                </div>
                <div class="aksesuarlar">
                    <h3>Cihazla Gelen Aksesuarlar</h3>
                    <label for="aksesuarlar" >
                    <textarea id="aksesuarlar" name="aksesuarlar" rows="3" cols="80" maxlength="300" required></textarea>
                    </label>
                </div>
                </div>
                <div class="hasar-ucret" >
                <div class="hasar">
                    <h3>Fiziksel Hasar / Dış Görünüm</h3>
                    <label for="hasar" >
                    <textarea id="hasar" name="hasar" rows="3" cols="80" maxlength="300" required></textarea>
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <div class="ucret-bildir">
                    <label>Toplam Ücret:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="number" name="ucret-bildir" id="ucret-bildir" value="ucret-bildir" placeholder="TL" required>
                </div>
                </div>
                
            </div>
            <button type="submit" value="cihazi-kaydet" name="cihazikaydet">Cihazı Kaydet</button>
            
        </form>
    </div>
                  
                     

    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
      
    
            <div class="row">
                <div class="col-lg-12" >
                    &copy;  2024 <a href="http://fatihkececioglu.com.tr/" >www.fatihkececioglu.com.tr</a> | Design by: Fatih KEÇECİOĞLU
                </div>
            </div>
        </div>
          

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="js/custom.js"></script>
    <script>
        function showHideFields() {
        var serviceType = document.getElementById('serviceType');
        var normalServiceFields = document.getElementById('normalServiceFields');
        var externalServiceFields = document.getElementById('externalServiceFields');

        if (serviceType.value === 'normal') {
            normalServiceFields.style.display = 'block';
            externalServiceFields.style.display = 'none';
      } else if (serviceType.value === 'dis') {
            normalServiceFields.style.display = 'none';
            externalServiceFields.style.display = 'block';
        }
    }

    function kaydet() {
        var form = document.getElementById('customerServiceForm');
        form.submit();
    }

    function toggleInput() {
      var input = document.getElementById('serviceNo');
      var checkbox = document.getElementById('servisYok');

      if (checkbox.checked) {
        input.disabled = true;
        input.classList.add('disabled');
      } else {
        input.disabled = false;
        input.classList.remove('disabled');
      }
    }
    function checkCheckbox(checkbox) {
            // Seçilen checkbox'ın ID'sini al
            var clickedCheckboxId = checkbox.id;

            // Diğer checkbox'ı seçilen checkbox'a göre belirle
            var otherCheckboxId = (clickedCheckboxId === "yeni-cihaz") ? "eski-cihaz" : "yeni-cihaz";

            // Diğer checkbox'ı bul
            var otherCheckbox = document.getElementById(otherCheckboxId);

            // Eğer seçilen checkbox işaretli ise, diğerini işaretsiz yap
            if (checkbox.checked) {
                otherCheckbox.checked = false;
            }
        }
        function limitLength(element, maxLength) {
    if (element.value.length > maxLength) {
        element.value = element.value.slice(0, maxLength);
    }
}



    </script>
</body>
</html>
