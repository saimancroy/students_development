 <?php include "inc-files/before_content.code"; ?>
 <div id="content">

	<?php
	if(isset($_SESSION['error']))
	{
		echo "<span style='color:green'><b>".$_SESSION['error']."</b></span>";
		unset($_SESSION['error']);
	}
	?>
  
  <p align="center"><img src="pictures/cover.jpg" border="1"></p>
  
 </div>
 <?php include "inc-files/after_content.code"; ?>
 