 <?php include "inc-files/before_content.code"; ?>
 <div id="content">
<?php
$mysqli = new mysqli('localhost', 'root', '', 'carsdata'); 
$mysqli->set_charset('utf8'); 

$result = $mysqli->query("SELECT tbl_cars.*, tbl_makes.make FROM tbl_cars join tbl_makes on tbl_cars.id_make=tbl_makes.id_make where id_car=".$_REQUEST['edit_id']);
$row = $result->fetch_assoc();

echo "<form action='exec_edit_car.php' method='post'>";
echo "<input type='hidden' value='".$_REQUEST['edit_id']."' name='id_car'>";
echo "<table border='1' align='center'>";
echo "<tr valign='top'>";
echo "<td width='33%'> марка: <b>".htmlspecialchars(stripslashes($row['make'])) . "</b><br>цена: <b><input type='text' value='".htmlspecialchars(stripslashes($row['price'])). "' name='price'></b> лв.<br><hr><textarea rows='10' cols='30' name='moreinfo'>".htmlspecialchars(stripslashes($row['moreinfo']))."</textarea><br><input type='submit' value='Запис'></td><td>".($row['picture']?"<img src='pictures/".$row['picture']."'>":"Няма снимка...")."</td>";
echo "</tr>";
echo "</table>";

echo "</form>";

$mysqli->close();
?>
 </div>
 <?php include "inc-files/after_content.code"; ?>
