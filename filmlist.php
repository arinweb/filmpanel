<?php include("header.php");
$func->rank("filmlist");
?>
<style>
  td{
    height:100px;
    overflow:scroll;
  }
  td img{
    max-width:100%;
    max-height:100px;
  }
</style>
<div class="listDiv">
<table>

  <tr>
    <td>Film Resmi</td>
    <td>Film Adı</td>
    <td>Film Kategorisi</td>
    <td>Film Açıklaması</td>
    <td>Film Süresi</td>
    <td>Film IMDB Puanı</td>
    <td>Film Info Puanı</td>
    <td>Film Çıkış Tarihi</td>
    <td>Film Paylaşım Tarihi</td>
    <td>Film Kimliği</td>
    <td>Kontrol</td>
  </tr>

  <?php
  foreach ($db->query("select * from filmler") as $row) {
    ?>

    <tr>
      <td><img src="<?=$row["film_img_url"]?>" alt="<?=$row["film_adi"]?>"/></td>
      <td><?=$row["film_adi"]?></td>
      <td><?=$row["film_konu"]?></td>
      <td><?=substr($row["film_aciklama"],0,50)."..."?></td>
      <td><?=$row["film_time"]?></td>
      <td><?=$row["film_imdb_puan"]?></td>
      <td><?=$row["film_info_puan"]?></td>
      <td><?=$row["film_release_date"]?></td>
      <td><?=$row["film_date"]?></td>
      <td><?=$row["film_id"]?></td>
      <td><a href="filmedit.php?id=<?=$row["film_id"]?>">Düzenle</a></td>
    </tr>


    <?php
  }
  ?>
</table>
</div>
<?php include("footer.php"); ?>