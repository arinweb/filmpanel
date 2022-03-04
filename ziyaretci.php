<?php include("header.php"); ?>
<?php
$func->rank("uye");
$tiklanma = $db->query("select count(*) as tiklanma from ziyaretci");
$tiklanma = $tiklanma->fetchAll();
?>
<b>Toplam Tıklanma:</b> <span><?= $tiklanma[0][0] ?></span>
<table>
  <tr>
    <td>ID</td>
    <td>Ziyaretci IP Adresi</td>
    <td>Tarih</td>
  </tr>
<?php
$x = 0;
foreach ($db->query("select * from ziyaretci order by id desc limit 100") as $row){
  $x++;
?>

<tr>
  <td><?= $x ?></td>
  <td><?= $row["ip"] ?></td>
  <td><?= $row["date"] ?></td>
</tr>
<?php } ?>
</table>
<?php include("footer.php"); ?>