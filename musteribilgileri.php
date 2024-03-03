<?php
    session_start();
    include("baglanti.php");
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="css\bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="css\font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="css\custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

   <link href="css/style1.css" rel="stylesheet" />
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
                     <h2>MÜŞTERİ BİLGİLERİ</h2>   
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
        echo "<h5 class='hgyazisi'>Hoşgeldin ".$_SESSION["kullanici_adi"].". </h5>";
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
                    <?php
                    $bilgiler_sql = "SELECT * FROM cihaz_kayitlar";
                    $bilgiler_result = $baglanti->query($bilgiler_sql);
                    ?> 
                          
                          <div class="tablolar">
                    <input class="search" type="text" id="searchInput" onkeyup="searchTable()" placeholder="Müşteri Ara">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                <div class="cihazlar">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bayi Adı</th>
                        <th>Müşteri Adı</th>
                        <th>Adres</th>
                        <th>GSM No</th>
                        <th>Telefon</th>
                        <th>E-Mail</th>
                        <th>TC No</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Cihaz bilgilerini ekrana yazdır
                    while ($bilgiler_row = $bilgiler_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $bilgiler_row["id"] . "</td>";
                        echo "<td>" . $bilgiler_row["bayiadi"] . "</td>";
                        echo "<td>" . $bilgiler_row["musteriadi"] . "</td>";
                        echo "<td>" . $bilgiler_row["adres"] . "</td>";
                        echo "<td>" . $bilgiler_row["gsmno"] . "</td>";
                        echo "<td>" . $bilgiler_row["telefon"] . "</td>";
                        echo "<td>" . $bilgiler_row["email"] . "</td>";
                        echo "<td>" . $bilgiler_row["tcno"] . "</td>";
                        echo "</tr>";
                    }
                    
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
                     
                  
                     
    
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
      
    
            <div class="row">
                <div class="col-lg-12" >
                &copy;  2024 <a href="http://fatihkececioglu.com.tr/" >www.fatihkececioglu.com.tr</a>| Design by: Fatih KEÇECİOĞLU
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
        function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            var display = false;

            for (j = 0; j < tr[i].cells.length; j++) {
                td = tr[i].getElementsByTagName("td")[j];

                if (td) {
                    txtValue = td.textContent || td.innerText;

                    // Eğer metin içeriyorsa, satır gösterilir ve döngüden çıkılır
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        display = true;
                        break;
                    }
                }
            }

            // Eğer metin içermiyorsa ve başlık satırı değilse satır gizlenir
            if (!display && i !== 0) {
                tr[i].style.display = "none";
            } else {
                tr[i].style.display = "";
            }
        }
    }
    </script>
   
</body>
</html>
