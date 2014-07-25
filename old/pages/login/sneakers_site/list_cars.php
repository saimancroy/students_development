 <?php include "inc-files/before_content.code"; ?>

<script type="text/javascript">
function removeCar(num)
{
   if (confirm("Изтриване на данни за модел!?"))
     self.location.href="exec_delete_car.php?del_id="+num;
}
</script>
 <div id="content">
<?php
$idMake=0; $prc=""; $insertText=""; $addWord=" where "; $addWordEnd="make";
if (isset($_GET["id_make"]))
{
	$idMake=$_GET['id_make']; $prc=$_GET['price'];
	if ($_GET['id_make']!=0)
		{$insertText .=$addWord."tbl_cars.id_make=".$_GET["id_make"]; $addWord=" and "; $addWordEnd="price";}
	if (!empty($_GET['price']))
		if (is_numeric($_GET['price']))
			{$insertText .=$addWord."price<=".$_GET['price']; $addWordEnd="price";}
		else $prc=$_GET['price']="";
}

$mysqli = new mysqli('localhost', 'root', '', 'carsdata'); 
$mysqli->set_charset('utf8'); 

$result = $mysqli->query("SELECT * FROM tbl_makes order by make");

echo "<form action='".$_SERVER['PHP_SELF']."' method='get'>";
echo "<p align='center'>";
echo "Марка: <select name='id_make'>";
echo "<option value='0'>Всички модели</option>";
while($row = $result->fetch_assoc())
{
echo "<option value='".htmlspecialchars(stripslashes($row['id_make'])) . "'".(($row['id_make']==$idMake)?' selected':'').">".htmlspecialchars(stripslashes($row['make'])). "</option>";
}
echo "</select>";
echo " цена до <input type='text' name='price' value='".$prc."'>лв.";
echo " <input type='submit' value='Справка'>";
echo "</p>";
echo "</form>";

$strQuery="SELECT tbl_cars.*, tbl_makes.make FROM tbl_cars join tbl_makes on tbl_cars.id_make=tbl_makes.id_make".$insertText." order by ".$addWordEnd;

$result = $mysqli->query($strQuery);

echo "<table border='1' align='center' width='600'>";
echo "<tr><th>марка</th><th>цена</th><th colspan='2'>операции</th></tr>";
while($row = $result->fetch_assoc())
{
	echo "<tr>";
	echo "<td><a href='show_car.php?show_id=".$row['id_car']."'>" .htmlspecialchars(stripslashes($row['make'])) . " </a></td><td>".htmlspecialchars(stripslashes($row['price'])). " лв.</td><td><a href='edit_car.php?edit_id=".$row['id_car']."'>редактиране</a></td><td><a href='javascript:removeCar(".$row['id_car'].")'>изтриване</a></td>";
	echo "</tr>";
}
echo "</table>";
$mysqli->close();
?>
 </div>
 <?php include "inc-files/after_content.code"; ?>
