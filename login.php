<?php
include("baglanti.php");

$username_err=$parola_err=""; 
if(isset($_POST["giris"]))
{
   //KULLANICI ADI DOGRULAMA SORGULARI
    if(empty($_POST["kullaniciadi"]))
    {
        $username_err="Kullanıcı adı boş geçilemez.";
    }
    else
    {
        $username=$_POST["kullaniciadi"];
    }
    //PAROLA DOGRULAMA SORGULARI
    if(empty($_POST["parola"]))
    {
      $parola_err="Parola boş geçilemez.";
    }
    else
    {
      $parola=$_POST["parola"];
    }

    if (isset($username) && isset($parola)) 
    {
      $secim="SELECT * FROM kullanicilar WHERE kullanici_adi='$username'";
      $calistir= mysqli_query($baglanti,$secim);
      $kayitsayisi=mysqli_num_rows($calistir);//ya 0 ya da 1

      if($kayitsayisi>0){
        $ilgilikayit=mysqli_fetch_assoc($calistir);
        $hashlisifre=$ilgilikayit["parola"];

        if(password_verify($parola,$hashlisifre))
        {
            session_start();
            $_SESSION["kullanici_adi"]=$ilgilikayit["kullanici_adi"];
            $_SESSION["email"]=$ilgilikayit["email"];
            header("location:index.php");
        }
        else{
          echo '<div class="alert alert-danger" role="alert">
          Parola Yanlış!
        </div>';
        }
      }
      else{
        echo '<div class="alert alert-danger" role="alert">
                      Kullanıcı adı yanlış!
                    </div>';
      }
     

      mysqli_close($baglanti);
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container p-5">
        <h1 class="" >Servis Takip Plus Giriş</h1>
        <div class="card p-5">
        <form action="login.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Kullanıcı Adı</label>
    <input type="text" class="form-control 
    
    <?php 
      if(!empty($username_err))
      {
        echo "is-invalid";
      }
    ?>
    
    " id="exampleInputEmail1" name="kullaniciadi" maxlength="30">
    <div class="invalid-feedback">
      <?php echo $username_err; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Parola</label>
    <input type="password" class="form-control 
    
    <?php 
    if(!empty($parola_err))
    {
      echo "is-invalid";
    }
    ?>
    
    " id="exampleInputPassword1" name="parola" maxlength="30">
    <div class="invalid-feedback">
     <?php echo $parola_err; ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="giris">GİRİŞ YAP</button>
</form>
        </div>
        <div class="kayitolbutonu">
        <p><a class="link-opacity-100" href="kayit.php">Kayıt Ol</a></p>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>