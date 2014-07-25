 <?php include "inc-files/before_content.code"; ?>
 <div id="content">
<?php
$mysqli = new mysqli('localhost', 'root', '', 'carsdata'); 
$mysqli->set_charset('utf8'); 

$result = $mysqli->query("SELECT tbl_cars.*, tbl_makes.make FROM tbl_cars join tbl_makes on tbl_cars.id_make=tbl_makes.id_make where id_car=".$_REQUEST['show_id']);
$row = $result->fetch_assoc();

echo "<table border='1' align='center' height='300' width='800'>";
echo "<tr valign='top'>";
echo "<td width='250'> марка: <b>".htmlspecialchars(stripslashes($row['make'])) . "</b><br>цена: <b>".htmlspecialchars(stripslashes($row['price'])). "</b> лв.<br><hr><span style='font-size:16px'><pre>".htmlspecialchars(stripslashes($row['moreinfo']))."</pre></span></td><td>".($row['picture']?"<img src='pictures/".$row['picture']."'>":"Няма снимка...")."</td>";
echo "</tr>";

echo "</table>";
echo "<a href='javascript:history.back()'> Обратно към списъка</a>";

$mysqli->close();
?>
 </div>
 <?php include "inc-files/after_content.code"; ?>
