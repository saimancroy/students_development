   <?php
 error_reporting(E_ALL);
 //This is only displayed if they have submitted the form 
 echo "<h2>Резултати</h2><p>"; 
 $find =$_POST["find"];
 //If they did not enter a search term we give them an error 
 if ($find == "") 
 { 
 echo "<p>Не сте въвели дума за търсене.."; 
 exit; 
 } 
 // Otherwise we connect to our Database 
 mysql_connect("localhost","root","1") or die(mysql_error()); 
 mysql_query ("SET NAMES UTF8");
 mysql_select_db("project 2") or die(mysql_error()); 

 // We preform a bit of filtering 
 $find = strtoupper($find); 
 $find = strip_tags($find); 
 $find = trim ($find); 

 //Now we search for our search term, in the field the user specified 
 $data = mysql_query("SELECT * FROM students WHERE student_fname LIKE '%$find%'"); 

 //And we display the results 
  while($result = mysql_fetch_array( $data ))   
    {
    echo '<p> <strong>',$result['student_fname'], '</strong> <br> ', $result['student_lname'],'... <br> </p>';
    }

 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
 $anymatches=mysql_num_rows($data); 
 if ($anymatches == 0) 
 { 
 echo "Не намерихме нищо за вашето търсене..<br><br>"; 
 } 

 //And we remind them what they searched for 
 echo "<b>Вие търсихте за:</b> " .$find; 

?> 