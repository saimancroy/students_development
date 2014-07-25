 <?php include "inc-files/before_content.code"; ?>
 <div id="content">
<?php
$errMsg="";
if ($_POST["id_make"]==0) $errMsg .="Не е избрана марка!<br>";
if (empty($_POST["price"]))
	$errMsg .="Не е въведена цена!<br>";
else
	if (!is_numeric($_POST["price"])) $errMsg .="Некоректно въведена цена!<br>";
if ($errMsg) 
{
	echo "<span style='color:green'>".$errMsg."</span><br>";
	echo "<a href='insert_car.php'>Ново въвеждане</a>";
}
else
{
	$mysqli = new mysqli('localhost', 'root', '', 'carsdata'); 
	$mysqli->set_charset('utf8'); 

	$str_query="INSERT INTO tbl_cars(id_make, price, moreinfo) VALUES ('".$_POST["id_make"]."','".$_POST["price"]."','".$_POST["moreinfo"]."')";
	$mysqli->query($str_query);
	echo "Данните са записани в базата...<br>";

	$fileErr=$_FILES["imgFile"]["error"]>0;
	if ($fileErr)
	  {
		echo "Не е заредена снимка.<br>";
	  }
	else
	  {
		$allowedExt = array("gif", "jpeg", "jpg", "png");
		$arrName = explode(".", $_FILES["imgFile"]["name"]);
		$ext = end($arrName);
		if (in_array($ext, $allowedExt) && ($_FILES["imgFile"]["size"] < 200000))
		{
			$idCar=$mysqli->insert_id;
			$picName="Pic".$idCar.".".$ext;
			move_uploaded_file($_FILES["imgFile"]["tmp_name"], "pictures/".$picName);
			$str_query="update tbl_cars set picture='".$picName."' where id_car=".$idCar;
			$mysqli->query($str_query);
			echo "Снимката е качена...<br>";
		}
		else
		{
			echo "Невалиден Image-файл!<br>";
		}
	  }

	$mysqli->close();
}
?>
 </div>
 <?php include "inc-files/after_content.code"; ?>
