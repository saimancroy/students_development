 <?php include "inc-files/before_content.code"; ?>
 <div id="content">
<?php
$errMsg="";
if (empty($_POST["price"]))
	$errMsg .="Не е въведена цена!<br>";
else
	if (!is_numeric($_POST["price"])) $errMsg .="Некоректно въведена цена!<br>";
if ($errMsg) 
{
	echo "<span style='color:green'>".$errMsg."</span><br>";
	echo "<a href='edit_car.php?edit_id=".$_POST["id_car"]."'> Корекция на данните</a>";
}
else
{
	$mysqli = new mysqli('localhost', 'root', '', 'carsdata'); 
	$mysqli->set_charset('utf8'); 

	$str_query="update tbl_cars set price=".$_POST["price"].", moreinfo='".$_POST["moreinfo"]."' where id_car=".$_POST["id_car"];
	$mysqli->query($str_query);
	echo "Данните са обновени...<br>";

	$mysqli->close();
}
?>
 </div>
 <?php include "inc-files/after_content.code"; ?>
