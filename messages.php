<?php include("header.php"); 
$func->rank("chat");
?>
<h3 class="baslik">Chat</h3>
<?php
$mesaj = strip_tags(trim($_GET["mesaj"]));
if ($mesaj) {
  $mesajsend = $db->prepare("insert into mesaj set name=?,mail=?,mesaj=?,tarih=?");
  $mesajsend->execute(array($_SESSION["user"]["name"], $_SESSION["user"]["mail"], $mesaj, date('d-m-Y H:i:s',time())));
    header("location:messages.php");
}

$delete = strip_tags(trim($_GET["delete"]));
if ($delete) {
  if($db->query("delete from mesaj where id=".$delete)){
    header("location:messages.php");
  }
}
?>
<form method="get" autocomplete="off">
  <input type="messages" name="mesaj" placeholder="Mesaj" />
  <button type="submit">Gönder</button>
</form>

<div class="chat">
  <table>
    <tr>
      <td>Mesaj</td>
      <td>Adı</td>
      <td>Tarih</td>
    </tr>
    <?php
    foreach ($db->query("select * from mesaj order by id desc limit 0,20") as $row) {
      if ($_SESSION["user"]["mail"] == $row["mail"]) {
        ?>
        <tr style="color:red;">
          <td><?= $row["mesaj"] ?></td>
          <td><?= $row["name"] ?></td>
          <td><?= $row["tarih"] ?></td>
          <td><a href="?delete=<?= $row["id"] ?>">Sil</a></td>
        </tr>
        <?php
      } else {
        ?>
        <tr>
          <td><?= $row["mesaj"] ?></td>
          <td><?= $row["name"] ?></td>
          <td><?= $row["tarih"] ?></td>
        </tr>
        <?php
      }
    }
    ?>
  </table>
</div>


<?php include("footer.php"); ?>