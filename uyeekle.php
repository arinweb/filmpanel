<?php include("header.php");
$func->rank("uye");

$user = array(
  "name" => strip_tags(trim($_POST["name"])),
  "mail" => strip_tags(trim($_POST["mail"])),
  "password" => strip_tags(trim($_POST["password"])),
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


if ($_POST) {

  if (empty($user["name"]) or empty($user["mail"]) or empty($user["password"])) {
    echo "Ad,E-Posta ve Şifreyi Boş bırakma!";
  } else {

    $updateUserKontrol = $db->prepare("select * from kullanici where mail=?");
    $updateUserKontrol->execute(array($user["mail"]));

    if ($updateUserKontrol->rowCount() == 0) {

      $updateUser = $db->query("
        insert into kullanici set
        name='".$user["name"]."',
        mail='".$user["mail"]."',
        password='".$user["password"]."',
         bankontrol=".$user["kontrol"]["ban"].",
         bilgilerimkontrol=".$user["kontrol"]["bilgilerim"].",
         uyekontrol=".$user["kontrol"]["uye"].",
         chatkontrol=".$user["kontrol"]["chat"].",
         sqlkontrol=".$user["kontrol"]["sql"].",
         phpmyadminkontrol=".$user["kontrol"]["phpmyadmin"].",
         filmlistkontrol=".$user["kontrol"]["filmlist"].",
         filmeklekontrol=".$user["kontrol"]["filmekle"].",
         filmeditkontrol=".$user["kontrol"]["filmedit"]
      );


      if ($updateUser) {
        echo "Hesap Oluşturuldu";
        exit;
      } else {
        echo "Hesap Oluşturulamadı :(";
      }
    } else {
      echo "E-posta Adresi Kullanılmaktadır";
    }
  }
}


?>

<form class="formX" method="POST">

  <ul>
    <li>Ad Soyad</li>
    <li><input name="name" type="name" value="<?= $user["name"] ?>" /></li>
    <li>E-Posta</li>
    <li><input name="mail" type="mail" value="<?= $user["mail"]; ?>" /></li>
    <li>Şifre</li>
    <li><input name="password" type="password" /></li>

    <li><input name="bankontrol" id="bankontrol" type="checkbox" class="checkbox" value="1" /><label for="bankontrol">Ban Durumu</label></li>

    <li><input name="bilgilerimkontrol" id="bilgilerimkontrol" type="checkbox" class="checkbox" value="1" checked /><label for="bilgilerimkontrol">Bilgileri Düzenleme</label></li>

    <li><input name="uyekontrol" id="uyekontrol" type="checkbox" class="checkbox" value="1" /><label for="uyekontrol">Üye Kontrol</label></li>


    <li><input name="chatkontrol" id="chatkontrol" type="checkbox" class="checkbox" value="1" checked /><label for="chatkontrol">Chat Erişimi</label></li>

    <li><input name="sqlkontrol" id="sqlkontrol" type="checkbox" class="checkbox" value="1" /><label for="sqlkontrol">Sql Erişimi</label></li>

    <li><input name="phpmyadminkontrol" id="phpmyadminkontrol" type="checkbox" class="checkbox" value="1" /><label for="phpmyadminkontrol">PhpMyAdmin Erişimi</label></li>

    <li><input name="filmlistkontrol" id="filmlistkontrol" type="checkbox" class="checkbox" value="1" /><label for="filmlistkontrol">Film Listeleme İzni</label></li>

    <li><input name="filmeditkontrol" id="filmeditkontrol" type="checkbox" class="checkbox" value="1" /><label for="filmeditkontrol">Film Düzenleme İzni</label></li>

    <li><input name="filmeklekontrol" id="filmeklekontrol" type="checkbox" class="checkbox" value="1" /><label for="filmeklekontrol">Film Ekleme İzni</label></li>

    <li><button type="submit">Kaydet</button></li>

  </ul>


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