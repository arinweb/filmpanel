<?php include("header.php");
$func->rank("sql");
?>


<h3 class="baslik">Sql Kodla</h3>

<?php
$sqlCode = strip_tags(trim($_POST["sqlCode"]));


if ($sqlCode) {
  if ($db->query($sqlCode)) {
    echo "Sql Kod Çalıştı";
  } else {
    echo "Sql Kod Hatalı";
  }
}

?>

<form method="post" enctype="multipart/form-data">
  <textarea name="sqlCode" required><?= $sqlCode; ?></textarea>
  <button type="submit">Sql Kodu Çalıştır</button>
</form>
<?php include("footer.php"); ?>