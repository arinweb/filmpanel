<?php include("header.php");
$func->rank("uye");
?>

<h3 class="baslik">Üye Listesi</h3>
<div class="listDiv">
  <table>
    <tr>
      <td>Mail</td>
      <td>Son Giriş</td>
      <td>Kontrol</td>
    </tr>

    <?php

    $form = $db->query("select * from kullanici");

    foreach ($form as $row) {

      if ($row["id"] != $_SESSION["user"]["id"]) {
        ?>
        <tr>
          <td><?= $row["mail"] ?></td>
          <td><?= $row["songiris"] ?></td>
          <?php if($row["kurucu"] == 1){ ?>
          <td>Kurucu</td>
          <?php } else{ ?>
            <td style="color:red;"><a href="uyekontrol.php?id=<?= $row["id"] ?>">Düzenle</a></td>
          <?php 
          }
          ?>
        </tr>
        <?php
      }
    }
    ?>
  </table>
</div>

<?php include("footer.php"); ?>