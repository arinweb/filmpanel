<?php include("header.php");
$func->rank("uye");


$id = trim(strip_tags($_GET["id"]));

$user = array(
  "name" => strip_tags(trim($_POST["name"])),
  "mail" => strip_tags(trim($_POST["mail"])),
  "kontrol" => array(
    "ban" => ($_POST["bankontrol"] == 1)? : 0,
    "bilgilerim" => ($_POST["bilgilerimkontrol"] == 1)? : 0,
    "uye" => ($_POST["uyekontrol"] == 1)? : 0,
    "chat" => ($_POST["chatkontrol"] == 1)? : 0,
    "sql" => ($_POST["sqlkontrol"] == 1)? : 0,
    "phpmyadmin" => ($_POST["phpmyadminkontrol"] == 1)? : 0,
    "filmekle" => ($_POST["filmeklekontrol"] == 1)? : 0,
    "filmedit" => ($_POST["filmeditkontrol"] == 1)? : 0,
    "filmlist" => ($_POST["filmlistkontrol"] == 1)? : 0
  )
);

if (isset($id) and $_POST) {

  if (empty($user["name"]) or empty($user["mail"])) {
    echo "Ad ve E-Posta'yı Boş bırakma!";
  } else {
    $updateUser = $db->query("
    update kullanici set
    name='".$user["name"]."',
    mail='".$user["mail"]."',
    bankontrol=".$user["kontrol"]["ban"].",
    bilgilerimkontrol=".$user["kontrol"]["bilgilerim"].",
    uyekontrol=".$user["kontrol"]["uye"].",
    chatkontrol=".$user["kontrol"]["chat"].",
    sqlkontrol=".$user["kontrol"]["sql"].",
    phpmyadminkontrol=".$user["kontrol"]["phpmyadmin"].",
    filmeklekontrol=".$user["kontrol"]["filmekle"].",
    filmeditkontrol=".$user["kontrol"]["filmedit"].",
    filmlistkontrol=".$user["kontrol"]["filmlist"]."
    where id=".$id
    );

    if ($updateUser) {
      echo "Kaydedildi";
      exit;
    } else {
      echo "Kaydedilemedi :(";
    }
  }
}


?>

<form class="formX" method="POST">
  <?php

  if (isset($id)) {

    $uyeVeri = $db->prepare("select * from kullanici where id=?");
    $uyeVeri->execute(array($id));
    $uye = $uyeVeri->fetch(PDO::FETCH_ASSOC);
    if ($uye["kurucu"] == 1) {
      echo "Kurucu hesabını düzenleyemessin!";
    } else {
      if ($_SESSION["user"]["id"] == $uye["id"]) {
        echo "Kendi hesabını düzenleyemezsin!";
      } else {
        if ($uyeVeri->rowCount()) {
          ?>

          <ul>
            <li>Ad Soyad</li>
            <li><input name="name" type="name" value="<?= $uye["name"]; ?>" /></li>
            <li>E-Posta</li>
            <li><input name="mail" type="mail" value="<?= $uye["mail"]; ?>" /></li>

            <li><input name="bankontrol" id="bankontrol" type="checkbox" class="checkbox"  <?= ($uye["bankontrol"] == 1)? "checked":""; ?> value="1" /><label for="bankontrol">Ban Durumu</label></li>

            <li><input name="bilgilerimkontrol" id="bilgilerimkontrol" type="checkbox" class="checkbox"  <?= ($uye["bilgilerimkontrol"] == 1)? "checked":""; ?> value="1" /><label for="bilgilerimkontrol">Bilgileri Düzenleme</label></li>

            <li><input name="uyekontrol" id="uyekontrol" type="checkbox" class="checkbox"  <?= ($uye["uyekontrol"] == 1)? "checked":""; ?> value="1" /><label for="uyekontrol">Üye Kontrol</label></li>

            <li><input name="chatkontrol" id="chatkontrol" type="checkbox" class="checkbox" <?= ($uye["chatkontrol"] == 1)? "checked":""; ?> value="1" /><label for="chatkontrol">Chat Erişimi</label></li>

            <li><input name="sqlkontrol" id="sqlkontrol" type="checkbox" class="checkbox" <?= ($uye["sqlkontrol"] == 1)? "checked":""; ?> value="1" /><label for="sqlkontrol">Sql Erişimi</label></li>

            <li><input name="phpmyadminkontrol" id="phpmyadminkontrol" type="checkbox" class="checkbox" <?= ($uye["phpmyadminkontrol"] == 1)? "checked":""; ?> value="1" /><label for="sqkontrol">PhpMyAdmin Erişimi</label></li>

            <li><input name="filmlistkontrol" id="filmlistkontrol" type="checkbox" class="checkbox" <?= ($uye["filmlistkontrol"] == 1)? "checked":""; ?> value="1" /><label for="filmlistkontrol">Film Listeleme İzni</label></li>
            
            <li><input name="filmeklekontrol" id="filmeklekontrol" type="checkbox" class="checkbox" <?= ($uye["filmeklekontrol"] == 1)? "checked":""; ?> value="1" /><label for="filmeklekontrol">Film Ekleme İzni</label></li>
            
            <li><input name="filmeditkontrol" id="filmeditkontrol" type="checkbox" class="checkbox" <?= ($uye["filmeditkontrol"] == 1)? "checked":""; ?> value="1" /><label for="filmeditkontrol">Film Düzenleme İzni</label></li>

            <li><button type="submit">Kaydet</button></li>
          </ul>
            <a id="userdelete" href="uyesil.php?id=<?= $uye["id"] ?>">Üyeyi Sil</a>


          <?php
        } else {
          echo "Böyle bir kullanıcı bulunmamaktadır!";
        }
      }
    }
  }
  ?>

</form>


<script>


  $(document).ready(function() {
    $("#bankontrol").click(function() {
      $(".checkbox").not(this).prop("disabled", $(this).prop("checked"));
    });


    if ($("#bankontrol").prop("checked")) {

      $(".checkbox").not("#bankontrol").prop("disabled", "disabled");

    }
  });

</script>



<?php include("footer.php"); ?>